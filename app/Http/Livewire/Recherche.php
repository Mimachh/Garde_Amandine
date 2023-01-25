<?php

namespace App\Http\Livewire;

use Throwable;
use App\Models\Garde;
use App\Models\Ville;
use App\Models\Annonce;
use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Http;

class Recherche extends Component
{
   
    public $q;
    public $gardes;
    public $annonces;
    public $garde;

    public function mount()
    {
        $this->annonces = Annonce::all();
        $this->gardes = Garde::all();
    }
    
    public function search()
    {

        $this->garde = request()->input("garde");
        $chats = request()->input("chats");
        $chiens = request()->input("chiens");
        $poissons = request()->input("poissons");
        $rongeurs = request()->input("rongeurs");
        $oiseaux = request()->input("oiseaux");
        $reptiles = request()->input("reptiles");
        $ferme = request()->input("ferme");
        $autre = request()->input("autre");
        

        /* GET AND VERIFY THE CODE OF THE REGION API */
  
            $region_name = request()->input('regionName');
            $region_code = request()->input('regionCode');
            //dd($region_name);
            $url_region = Http::get('https://geo.api.gouv.fr/regions?nom='.$region_name.'&fields=nom,code&format=json');
            //dd($url);
            $response_region = json_decode($url_region->getBody()->getContents());
            //dd($response_region);
            $regions = [];   
                foreach($response_region as $resp)
                {
                    array_push($regions, $resp->code);
                }
                //dd($region_name);
                //dd($regions);
                if(in_array($region_code, $regions)){
                    // dd('ok');
                }else{
                    $region_code = NULL;
                    // dd('non');
                }
  
        /* GET AND VERIFY THE CODE OF THE DEPARTEMENT API */

            $departement_code = request()->input('departementCode');
            //dd($departement_code);
            $url_departement = Http::get('https://geo.api.gouv.fr/departements?code='.$departement_code.'&fields=nom,code,codeRegion&format=json');
            $response_departement = json_decode($url_departement->getBody()->getContents());
            //dd($response_departement);
            $departements = [];   
                foreach($response_departement as $resp)
                {
                    array_push($departements, $resp->code);
                }
                //dd($departements);
                if(in_array($departement_code, $departements)){
                    $departement_name = $response_departement[0]->nom;
                    $region_code = $response_departement[0]->codeRegion;
                    //dd('ok');
                }else{
                    $departement_code = NULL;
                    //dd('non');
                }

        /* FIND COMMUNE WITH CODE POSTAL */
        $api_url = 'https://geo.api.gouv.fr/';

            $zipcode = request()->input('zipcode');
            $city_code = request()->input('city_code');
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
                //dd('non');
            }
               

        $this->validate([
            'garde' => 'required',
        ],
        [
           'garde.required' => 'La recherche n\'a pas abouti. Merci de préciser le type de garde que vous cherchez !',
        ]);
        
        try
        {
            if(request()->input('garde')){
                $g = Garde::where('id', 'like', "%$this->garde%")->pluck('id');
            }
        
            //$g = Garde::where('id', 'like', "%$garde%")->pluck('id');
            $a= Annonce::when($departement_code, function ($s) use ($departement_code){
                    return $s->where('departement_code', '=', $departement_code);})
                ->when($region_code, function ($s) use ($region_code){
                    return $s->where('region_code', '=', $region_code);})
                ->when($city_code, function ($s) use ($city_code){
                    return $s->where('ville_code', '=', $city_code);})
                ->when($g, function ($s) use ($g) {
                    return $s->where('garde_id', $g);})
                ->when($chats, function ($s) use ($chats) {
                    return $s->where('chats', $chats);})
                ->when($chiens, function ($s) use ($chiens) {
                    return $s->where('chiens', $chiens);})
                ->when($poissons, function ($s) use ($poissons) {
                    return $s->where('poissons', $poissons);})
                ->when($rongeurs, function ($s) use ($rongeurs) {
                    return $s->where('rongeurs', $rongeurs);})
                ->when($oiseaux, function ($s) use ($oiseaux) {
                    return $s->where('oiseaux', $oiseaux);})
                ->when($reptiles, function ($s) use ($reptiles) {
                        return $s->where('reptiles', $reptiles);})
                ->when($ferme, function ($s) use ($ferme) {
                        return $s->where('ferme', $ferme);})
                ->when($autre, function ($s) use ($autre) {
                        return $s->where('autre', $autre);})
                ->paginate(6);

                
                return view('annonces.search', ['annonces' => $a]);
        }
        catch (Throwable $e)
        {
            dd('Capture Throwable : Désolé un problème est survenu, veuillez réessayer plus tard');
        }catch(\Exception $e)
        {
            dd('Capture Exception :Désolé un problème est survenu, veuillez réessayer plus tard');
        }catch(\Error $e)
        {
            dd('Capture Error: Désolé un problème est survenu, veuillez réessayer plus tard');
        }catch(QueryException $e){
            dd('Capture Query Exception : Désolé un problème est survenu, veuillez réessayer plus tard');
        }     
    }

    public function render()
    {
        
        
        return view('livewire.recherche');
    }
}
