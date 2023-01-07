<?php

namespace App\Http\Livewire;

use App\Models\Demande;
use Livewire\Component;
use App\View\Components\Flash;

class CreateDemande extends Component
{
    use Flash;
    
    protected $rules = [

        'content' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'garde_id' => 'required',
        'first_animal_id' => 'required',
        'second_animal_id' => 'nullable',
        'third_animal_id' => 'nullable',
        'number_visit' => 'nullable',
        'phone' => 'nullable',
        'mail' => 'required',

    ];

    public  $content, $annonce, $first_animal_id, 
            $second_animal_id, $third_animal_id,
            $start_date, $end_date, $garde_id, $number_visit,
            $phone, $mail, $user_id, $prix, $i, $price, $prix_date;

    public function store()
    {
        /* Contenu par défaut */

            $this->content = 'Bonjour '. $this->annonce->name . " acceptes-tu de garder : ";
       
        
        /* Boucle pour calculer le nombre d'animaux */
            for($i = 0; $i < 1; $i++)
            {
                if($this->first_animal_id != null)
                {
                    $this->i++;
                };
                if($this->second_animal_id != null)
                {
                    $this->i++;
                };
                if($this->third_animal_id != null)
                {
                    $this->i++;
                };
                    $result = $this->i;   
            }
  
        /* Calcul pour le nombre de jours de garde */

            /* $start_dates =  date('d/m/Y', strtotime($this->start_date)); */

            $timestamp_start = strtotime($this->start_date);
            $timestamp_end = strtotime($this->end_date);

            $timestamp_left = $timestamp_end - $timestamp_start;
            $days = ($timestamp_left / 86400) + 1;

        /* Calcul des prix */
            $price_animals = ($this->annonce->price * $this->i) / 100;
            $prix_date = ($price_animals * $days);
            $prix_commission = $prix_date * 2;

        /* Validation du formulaire */   
            $this->user_id = auth()->user()->id;
            $this->validate(
            [
                'content' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'garde_id' => 'required|date',
                'first_animal_id' => 'required|integer',
                'second_animal_id' => 'nullable|integer',
                'third_animal_id' => 'nullable|integer',
                'number_visit' => 'nullable|integer',
                'phone' => 'nullable|string',
                'mail' => 'required',
            ],
            [

            ]
            );
       
            $demande = Demande::create([
                'content' => $this->content,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'garde_id' => $this->garde_id,
                'phone' => $this->phone,
                'mail' => $this->mail,
                'first_animal_id' => $this->first_animal_id,
                'second_animal_id' => $this->second_animal_id,
                'third_animal_id' => $this->second_animal_id,
                'number_visit' => $this->number_visit,
                'user_id' => $this->user_id,
            ]);

            self::message('success', 'Ta demande est transmise au Pet-Sitter ! Il te répondra au plus vite. ');
            return redirect()->route('annonces.index');
    }
    
    public function render()
    {
        return view('livewire.create-demande');
    }
}

