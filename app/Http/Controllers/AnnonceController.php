<?php

namespace App\Http\Controllers;

use App\Models\Garde;
use App\Models\Animal;
use App\Models\Espece;
use App\Models\Annonce;
use App\Models\Exterieur;
use App\Models\Habitation;
use Illuminate\Http\Request;
use App\View\Components\Flash;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{
    use Flash;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gardes = Garde::all();
        $habitations = Habitation::all();
        $exterieurs = Exterieur::all();
        
        return view('annonces.create', [
            'habitations' => $habitations,
            'exterieurs' => $exterieurs,
            'gardes' => $gardes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $api_url = 'https://geo.api.gouv.fr/';
        if(!empty($_POST['zipcode']) && !empty($_POST['city_code']))
        {
            $zipcode = $request->input('zipcode');
            $city_code = $request->input('city_code');
            $client = Http::get($api_url.'communes?codePostal='.$zipcode.'&code='.$city_code.'&fields=nom,codeDepartement,codeRegion&format=json');
            $response = json_decode($client->getBody()->getContents());
            //dd($response);
            $cities = [];

            foreach($response as $resp)
            {
                array_push($cities, $resp->code);
            }

            if(in_array($city_code, $cities)){
                $ville_name = $response[0]->nom;
                $ville_code = $response[0]->code;
                $departement_code = $response[0]->codeDepartement;
                $region_code = $response[0]->codeRegion;
                //dd('ok');
            }
            else{
                $ville_name = NULL;
                $ville_code = NULL;
                $region_code = NULL;
                $departement_code = NULL;
                //dd('non');
            }
            // GET REGION AND DEPARTEMENT FROM API
            $departement_nom_request = Http::get('https://geo.api.gouv.fr/departements?code='.$departement_code.'&fields=nom');
            $response_departement_nom = json_decode($departement_nom_request->getBody()->getContents());
            $departement_nom = $response_departement_nom[0]->nom;
            //dd($response_departement_nom[0]->nom);
            $region_nom_request = Http::get('https://geo.api.gouv.fr/regions?code='.$region_code.'&fields=nom');
            $response_region_nom = json_decode($region_nom_request->getBody()->getContents());
            $region_nom = $response_region_nom[0]->nom;
            //dd($response_region_nom[0]->nom);
        }
       //dd($ville_name, $ville_code, $region_code);
        $user_id = auth()->user()->id;

        $validate = $request->validate([
            'city_code' => 'required|string',
            'description' => 'required|max:60',
            'garde_id' => 'required|integer',
            'habitation_id' => 'required|integer',
            'exterieur_id' => 'required|integer',
            'photo' => 'required|image|max:2048|mimes:jpg,jpeg,png',
            'start_watch' => 'nullable|date',
            'end_watch' => 'nullable|date',
            'chats' => 'nullable|integer',
            'chiens' => 'nullable|integer',
            'poissons' => 'nullable|integer',
            'rongeurs' => 'nullable|integer',
            'oiseaux' => 'nullable|integer',
            'reptiles' => 'nullable|integer',
            'ferme' => 'nullable|integer',
            'autre' => 'nullable|integer',
            'price' => 'required|integer',
        ],[
            'description.max' => 'La description ne doit pas dépasser 60 caractères !',
            'description.required' => 'La description est obligatoire !',
            'garde_id.required' => 'Un type de garde est obligatoire !',
            'garde_id.integer' => 'La valeur renseignée n\'est pas bonne !',
            'habitation_id.required' => 'Un type d\'habitation est obligatoire !',
            'habitation_id.integer' => 'La valeur renseignée n\'est pas bonne !',
            'exterieur_id.required' => 'Un extérieur est obligatoire !',
            'exterieur_id.integer' => 'La valeur renseignée n\'est pas bonne !',
            'photo.required' => 'Une photo est obligatoire !',
            'photo.image' => 'Le format du fichier photo n\'est pas accepté',
            'photo.max' => 'La photo est trop lourde !',
            'photo.mimes' => 'Le type du fichier photo n\'est pas accepté !',
            'start_watch.date' => 'La date de début doit être une date !',
            'end_watch.date' => 'La date de fin doit être une date !',
            'chats.integer' => 'La valeur du champs chats n\'est pas acceptée !',
            'chiens.integer' => 'La valeur du champs chats n\'est pas acceptée !',
            'poissons.integer' => 'La valeur du champs chiens n\'est pas acceptée !', 
            'rongeurs.integer' => 'La valeur du champs rongeurs n\'est pas acceptée !',
            'oiseaux.integer' => 'La valeur du champs oiseaux n\'est pas acceptée !',
            'reptiles.integer' => 'La valeur du champs reptiles n\'est pas acceptée !', 
            'ferme.integer' => 'La valeur du champs ferme n\'est pas acceptée !', 
            'autre.integer' => 'La valeur du champs autre n\'est pas acceptée !',
            'price.integer' => 'La valeur du champs prix n\'est pas acceptée !',
            'price.required' => 'Le prix est obligatoire !',
            'city_code.required' => 'La commune ne correspond à aucune donnée, veuillez réessayer !',
            'city_code.string' => 'La commune ne correspond à aucune donnée, veuillez réessayer !',
        ]);
        /* Image */
            $prix = $request->price * 100;
            $name_file = md5($request->photo . microtime()).'.'.$request->photo->extension();
            $request->photo->storeAs('annonces_photos', $name_file);
            $img = Image::make(public_path("/storage/annonces_photos/{$name_file}"))->fit(1795, 1200);
            $img->save();

        $complete_locate = $region_nom.'/'.$departement_nom.'/'.$ville_name;
        $annonce = Annonce::create([
            'ville_code' => $ville_code,
            'ville_name' => $complete_locate,
            'region_code' => $region_code,
            'departement_code' => $departement_code,
            'code_postal' => $zipcode,
            'photo' => $name_file,
            'habitation_id' => $request->habitation_id,
            'exterieur_id' => $request->exterieur_id,
            'start_watch' => $request->start_watch,
            'end_watch' => $request->end_watch,
            'garde_id' => $request->garde_id,
            'chats' => $request->chats,
            'chiens' => $request->chiens,
            'poissons' => $request->poissons,
            'rongeurs' => $request->rongeurs,
            'oiseaux' => $request->oiseaux,
            'reptiles' => $request->reptiles,
            'ferme' => $request->ferme,
            'autre' => $request->autre,
            'description' => $request->description,
            'price' => $prix,
            'user_id' => auth()->user()->id,
        ]);
        self::message('success', 'Ton annonce est bien enregistrée !.');
        return redirect()->route('annonces.show', $annonce->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {   
        $animal = Animal::where('user_id', $annonce->user_id)->get();
        $cat= Espece::select('espece')->where('id', $annonce->chats)->get();
        $dog = Espece::select('espece')->where('id', $annonce->chiens)->get();
        $fish = Espece::select('espece')->where('id', $annonce->poissons)->get();
        $rabbit = Espece::select('espece')->where('id', $annonce->rongeurs)->get(); 
        $bird = Espece::select('espece')->where('id', $annonce->oiseaux)->get();
        $rept = Espece::select('espece')->where('id', $annonce->reptiles)->get();
        $farm = Espece::select('espece')->where('id', $annonce->ferme)->get();
        $other = Espece::select('espece')->where('id', $annonce->autre)->get();
    
        $all_garde = [$cat, $dog, $fish, $rabbit, $bird, $rept, $farm, $other];
        $ville_code = $annonce->ville_code;
        return view('annonces.show', [
            'annonce' => $annonce, 
            'watches'=>$all_garde, 
            'animals' => $animal,
            'ville_code' => $ville_code,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        $this->authorize('update', $annonce);
        $gardes = Garde::all();
        $habitations = Habitation::all();
        $exterieurs = Exterieur::all();
        $price = $annonce->price / 100;
        return view('annonces.edit', [
            'annonce' => $annonce,
            'price' => $price,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        $this->authorize('update', $annonce);
        $api_url = 'https://geo.api.gouv.fr/';
        if(!empty($_POST['zipcode']) && !empty($_POST['city_code']))
        {
            $zipcode = $request->input('zipcode');
            $city_code = $request->input('city_code');
            $client = Http::get($api_url.'communes?codePostal='.$zipcode.'&code='.$city_code.'&fields=nom,codeDepartement,codeRegion&format=json');
            $response = json_decode($client->getBody()->getContents());
            //dd($response);
            $cities = [];
           
            foreach($response as $resp)
            {
                array_push($cities, $resp->code);
            }

            if(in_array($city_code, $cities)){
                $ville_name = $response[0]->nom;
                $ville_code = $response[0]->code;
                $departement_code = $response[0]->codeDepartement;
                $region_code = $response[0]->codeRegion;
                //dd('ok');
            }
            else{
                $ville_name = NULL;
                $ville_code = NULL;
                $region_code = NULL;
                $departement_code = NULL;
                //dd('non');
            }

            // TEST FOR GET NAME FROM CODE
            $test = Http::get('https://geo.api.gouv.fr/communes?code='.$city_code.'&fields=nom');
            $responsetest = json_decode($test->getBody()->getContents());
            //dd($responsetest[0]->nom);
           
        }
       //dd($ville_name, $ville_code, $region_code);

        $validate = $request->validate([
            'city_code' => 'required|string',
            'description' => 'required|max:60',
            'garde_id' => 'required|integer',
            'habitation_id' => 'required|integer',
            'exterieur_id' => 'required|integer',
            'photo' => 'required|image|max:2048|mimes:jpg,jpeg,png',
            'start_watch' => 'nullable|date',
            'end_watch' => 'nullable|date',
            'chats' => 'nullable|integer',
            'chiens' => 'nullable|integer',
            'poissons' => 'nullable|integer',
            'rongeurs' => 'nullable|integer',
            'oiseaux' => 'nullable|integer',
            'reptiles' => 'nullable|integer',
            'ferme' => 'nullable|integer',
            'autre' => 'nullable|integer',
            'price' => 'required|integer',
        ],[
            'description.max' => 'La description ne doit pas dépasser 60 caractères !',
            'description.required' => 'La description est obligatoire !',
            'garde_id.required' => 'Un type de garde est obligatoire !',
            'garde_id.integer' => 'La valeur renseignée n\'est pas bonne !',
            'habitation_id.required' => 'Un type d\'habitation est obligatoire !',
            'habitation_id.integer' => 'La valeur renseignée n\'est pas bonne !',
            'exterieur_id.required' => 'Un extérieur est obligatoire !',
            'exterieur_id.integer' => 'La valeur renseignée n\'est pas bonne !',
            'photo.required' => 'Une photo est obligatoire !',
            'photo.image' => 'Le format du fichier photo n\'est pas accepté',
            'photo.max' => 'La photo est trop lourde !',
            'photo.mimes' => 'Le type du fichier photo n\'est pas accepté !',
            'start_watch.date' => 'La date de début doit être une date !',
            'end_watch.date' => 'La date de fin doit être une date !',
            'chats.integer' => 'La valeur du champs chats n\'est pas acceptée !',
            'chiens.integer' => 'La valeur du champs chats n\'est pas acceptée !',
            'poissons.integer' => 'La valeur du champs chiens n\'est pas acceptée !', 
            'rongeurs.integer' => 'La valeur du champs rongeurs n\'est pas acceptée !',
            'oiseaux.integer' => 'La valeur du champs oiseaux n\'est pas acceptée !',
            'reptiles.integer' => 'La valeur du champs reptiles n\'est pas acceptée !', 
            'ferme.integer' => 'La valeur du champs ferme n\'est pas acceptée !', 
            'autre.integer' => 'La valeur du champs autre n\'est pas acceptée !',
            'price.integer' => 'La valeur du champs prix n\'est pas acceptée !',
            'price.required' => 'Le prix est obligatoire !',
            'city_code.required' => 'La commune ne correspond à aucune donnée, veuillez réessayer !',
            'city_code.string' => 'La commune ne correspond à aucune donnée, veuillez réessayer !',
        ]);

        /* Image */
            $prix = $request->price * 100;
            if(isset($request->photo))
            {
                Storage::delete('annonces_photos/' . $request->annonce->photo);
                $name_file = md5($request->photo . microtime()).'.'.$request->photo->extension();
                $request->photo->storeAs('annonces_photos', $name_file);
                $img = Image::make(public_path("/storage/annonces_photos/{$name_file}"))->fit(1795, 1200);
                $img->save();
            }else 
            {
                $name_file = $request->annonce->photo;
            }
            

        $annonce->update([
            'ville_code' => $ville_code,
            'ville_name' => $ville_name,
            'region_code' => $region_code,
            'departement_code' => $departement_code,
            'code_postal' => $zipcode,
            'photo' => $name_file,
            'habitation_id' => $request->habitation_id,
            'exterieur_id' => $request->exterieur_id,
            'start_watch' => $request->start_watch,
            'end_watch' => $request->end_watch,
            'garde_id' => $request->garde_id,
            'chats' => $request->chats,
            'chiens' => $request->chiens,
            'poissons' => $request->poissons,
            'rongeurs' => $request->rongeurs,
            'oiseaux' => $request->oiseaux,
            'reptiles' => $request->reptiles,
            'ferme' => $request->ferme,
            'autre' => $request->autre,
            'description' => $request->description,
            'price' => $prix,
        ]);
        self::message('success', 'Ton annonce a bien été modifiée !.');
        return redirect()->route('annonces.show', $annonce->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
