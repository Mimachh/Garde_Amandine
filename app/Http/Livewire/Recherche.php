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

    public function mount()
    {
        $this->annonces = Annonce::all();
        $this->gardes = Garde::all();
    }
    
    public function search()
    {
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
                dd('ok');
            }else{
                $departement_code = NULL;
                dd('non');
            }

        try
        {
            $ville = request()->input("ville");
            $garde = request()->input("garde");
            $chats = request()->input("chats");
            $chiens = request()->input("chiens");
            $poissons = request()->input("poissons");
            $rongeurs = request()->input("rongeurs");
            $oiseaux = request()->input("oiseaux");
            $reptiles = request()->input("reptiles");
            $ferme = request()->input("ferme");
            $autre = request()->input("autre");
            
            if(request()->input("ville")){
                
                $v= Ville::where('id', 'like', $ville)->pluck('id');
            }else{
                //$ville = 'Le mans';
                $rand = rand(1,2);
                $v= Ville::where('id', 'like', $rand)->pluck('id')->all();
            }

            if(request()->input('garde')){
                $g = Garde::where('id', 'like', "%$garde%")->pluck('id');
            }else{
                $g = rand(1,2);
            }
        
            //$g = Garde::where('id', 'like', "%$garde%")->pluck('id');
            $a= Annonce::when($v, function ($s) use ($v) {
                    return $s->where('ville_id', 'like', $v);})
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

                
                return view('annonces.search', [
                'annonces' => $a,
            ]);
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
