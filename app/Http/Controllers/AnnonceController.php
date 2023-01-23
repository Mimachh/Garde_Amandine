<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('a.create');
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
            $client = Http::get($api_url.'communes?codePostal='.$zipcode.'&code='.$city_code.'&fields=nom,codeRegion&format=json');
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
                $region_code = $response[0]->codeRegion;
                //dd('ok');
            }
            else{
                $ville_name = NULL;
                $ville_code = NULL;
                $region_code = NULL;
                //dd('non');
            }

            // TEST FOR GET NAME FROM CODE
            $test = Http::get('https://geo.api.gouv.fr/communes?code='.$city_code.'&fields=nom');
            $responsetest = json_decode($test->getBody()->getContents());
            //dd($responsetest[0]->nom);
           
        }
       dd($ville_name, $ville_code, $region_code);

        $validate = $request->validate([
            'name' => 'string',
        ]);

        $create = Annonce::create([
            'ville_name' => $ville_name,
            'ville_code' => $ville_code,
            'region_code' => $region_code,
            'user_id' => 2,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        //
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
        //
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
