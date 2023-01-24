<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  

        DB::table('especes')->insert([
 
            ['espece' => 'Chat',
            'id' => '1'],
            ['espece' => 'Chien',
            'id' => '2'],
            ['espece' => 'Poisson',
            'id' => '3'],
            ['espece' => 'Rongeur',
            'id' => '4'],
            ['espece' => 'Oiseau',
            'id' => '5'],
            ['espece' => 'Reptile',
            'id' => '6'],
            ['espece' => 'Animaux de la ferme',
            'id' => '7'],
            ['espece' => 'Autre',
            'id' => '8'],
            ['espece' => 'Tous les animaux',
            'id' => '9'],
           
        ]);
        
        DB::table('gardes')->insert([
 
            ['id'=>'1', 'garde' => 'Chez le Pet-Sitter'],
            ['id'=>'2', 'garde' => 'Visite à domicile'],
            ['id'=>'3', 'garde' => 'Chez le Pet-Sitter / En visite '],
            
        ]);

         

        DB::table('races')->insert([
 
            ['race_animal' => 'Chat de gouttière',
             'espece_id' => '1'],
            ['race_animal' => 'Chat de race',
            'espece_id' => '1'],

            ['race_animal' => 'Beagle',
            'espece_id' => '2'],
            ['race_animal' => 'Berger Allemand',
            'espece_id' => '2'],
            ['race_animal' => 'Berger Australien',
            'espece_id' => '2'],
            ['race_animal' => 'Berger des Shetland',
            'espece_id' => '2'],
            ['race_animal' => 'Bichon',
            'espece_id' => '2'],
            ['race_animal' => 'Border Collie',
            'espece_id' => '2'],
            ['race_animal' => 'Bouledogue Français',
            'espece_id' => '2'],
            ['race_animal' => 'Bouvier Bernois',
            'espece_id' => '2'],
            ['race_animal' => 'Caniche',
            'espece_id' => '2'],
            ['race_animal' => 'Cairn Terrier',
            'espece_id' => '2'],
            ['race_animal' => 'Carlin',
            'espece_id' => '2'],
            ['race_animal' => 'Cavalier King Charles Spaniel',
            'espece_id' => '2'],
            ['race_animal' => 'Chien de ferme Dano-Suéduois',
            'espece_id' => '2'],
            ['race_animal' => 'Finnois de Laponie',
            'espece_id' => '2'],
            ['race_animal' => 'Chihuahua',
            'espece_id' => '2'],
            ['race_animal' => 'Colley à poil long',
            'espece_id' => '2'],
            ['race_animal' => 'Coton de Tuléar',
            'espece_id' => '2'],
            ['race_animal' => 'Dalmatien',
            'espece_id' => '2'],
            ['race_animal' => 'Golden Retriever',
            'espece_id' => '2'],
            ['race_animal' => 'Husky de Sibérie',
            'espece_id' => '2'],
            ['race_animal' => 'Jack Russell',
            'espece_id' => '2'],
            ['race_animal' => 'Labrador Retriever',
            'espece_id' => '2'],
            ['race_animal' => 'Loulou de Poméranie',
            'espece_id' => '2'],
            ['race_animal' => 'Retriever',
            'espece_id' => '2'],
            ['race_animal' => 'Rhodesian Ridgeback',
            'espece_id' => '2'],
            ['race_animal' => 'Rottweiler',
            'espece_id' => '2'],
            ['race_animal' => 'Samoyède',
            'espece_id' => '2'],
            ['race_animal' => 'Setter Anglais',
            'espece_id' => '2'],
            ['race_animal' => 'Shih Tzu',
            'espece_id' => '2'],
            ['race_animal' => 'Staffordshire Bull Terrier',
            'espece_id' => '2'],
            ['race_animal' => 'Teckel',
            'espece_id' => '2'],
            ['race_animal' => 'Whippet/Levrier',
            'espece_id' => '2'],
            ['race_animal' => 'Yorkshire Terrier',
            'espece_id' => '2'],

            ['race_animal' => 'Poisson',
            'espece_id' => '3'],

            ['race_animal' => 'Lapin',
            'espece_id' => '4'],
            ['race_animal' => 'Hamster',
            'espece_id' => '4'],
            ['race_animal' => 'Gerbille',
            'espece_id' => '4'],
            ['race_animal' => 'Souris/Rat',
            'espece_id' => '4'],
            ['race_animal' => 'Chincilla',
            'espece_id' => '4'],
            ['race_animal' => 'Furet',
            'espece_id' => '4'],


            ['race_animal' => 'Perruche',
            'espece_id' => '5'],
            ['race_animal' => 'Perroquet',
            'espece_id' => '5'],
            ['race_animal' => 'Cacatoès',
            'espece_id' => '5'],
            ['race_animal' => 'Canaris',
            'espece_id' => '5'],
            ['race_animal' => 'Colombe',
            'espece_id' => '5'],
            ['race_animal' => 'Tourterelle',
            'espece_id' => '5'],

            ['race_animal' => 'Serpent',
            'espece_id' => '6'],
            ['race_animal' => 'Caméléon',
            'espece_id' => '6'],
            ['race_animal' => 'Tortue',
            'espece_id' => '6'],
            ['race_animal' => 'Gecko',
            'espece_id' => '6'],
            ['race_animal' => 'Lézard',
            'espece_id' => '6'],

            ['race_animal' => 'Cheval',
            'espece_id' => '7'],
            ['race_animal' => 'Âne',
            'espece_id' => '7'],
            ['race_animal' => 'Poule/Oie',
            'espece_id' => '7'],
            ['race_animal' => 'Vache/Veau/Taureau',
            'espece_id' => '7'],

   
        ]);

        DB::table('habitations')->insert([
            ['id' => '1', 'hab' => "Appartement"],
            ['id' => '2', 'hab' => "Maison"],
            ['id' => '3', 'hab' => "Non concerné"],            
        ]);

        DB::table('exterieurs')->insert([
            ['id' => '1', 'ext' => "Avec jardin/cour"],
            ['id' => '2', 'ext' => "Sans extérieur"],
            ['id' => '3', 'ext' => "Non concerné"],            
        ]);

        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Utilisateur']
        ]);

        DB::table('users')->insert([
            ['id' => '1', 'name' => 'Karl', 'email' => 'karl.m@gmail.com', 
            'password' => '$2y$10$ZaUzuL/yWyVcl8bCxhQ64OyOA/GrLJpfP9eThY7dfco29sZvgw.fK'],
            ['id' => '2', 'name' => 'Amandine', 'email' => 'karl@gmail.com', 
            'password' => '$2y$10$ZaUzuL/yWyVcl8bCxhQ64OyOA/GrLJpfP9eThY7dfco29sZvgw.fK']
        ]);
        
        DB::table('villes')->insert([
            ['id' => 1, 'ville_nom' => 'Le Mans']
        ]);


        DB::table('annonces')->insert([
            ['id' => '1', 'garde_id' => '2', 'habitation_id'=> '1', 'exterieur_id' =>'2', 'name'=>'Karl', 'ville_code' =>72028, 'description' => 'je suis un chameau', 'chats' => '1', 'chiens' => '2', 'price' => 1200, 'user_id' => 1],
            ['id' => '2', 'garde_id' => '1', 'habitation_id'=> '2','exterieur_id' =>'2', 'name'=>'Karl', 'ville_code' =>72028, 'description' => 'je suis un chameau', 'chats' => '1', 'chiens' => '2', 'price' => 2100, 'user_id' => 1],
            ['id' => '3', 'garde_id' => '2', 'habitation_id'=> '2','exterieur_id' =>'2', 'name'=>'Karl', 'ville_code' =>72028, 'description' => 'je suis un chameau', 'chats' => '1', 'chiens' => '2', 'price' => 2500, 'user_id' => 1]
        ]);

        DB::table('ages')->insert([
            ['id' => '1', 'age' => "Moins d'un an"],
            ['id' => '2', 'age' => "Entre 1 et 2 ans"],
            ['id' => '3', 'age' => "Plus de 2 ans"],
            
        ]);
     
       

        DB::table('animals')->insert([
            ['id' => '1', 'animal_name' => "Bunny"],         
        ]);
     
    }

}
