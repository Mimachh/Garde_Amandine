<?php

namespace App\Http\Livewire;

use App\Models\Garde;
use App\Models\Annonce;
use App\Models\Demande;


use Livewire\Component;

use App\Models\Proposal;
use App\Notifications\ProposalRecieved;
use App\View\Components\Flash;
use Illuminate\Support\Facades\Request;

class Demandes extends Component
{
    use Flash;

    public function index()
    {
        //
    }

  
    public function create(Annonce $annonce)
    {
        return view('demandes.create', compact('annonce'));
    }

    
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
    ];


    public  $content, $annonce, $first_animal_id, 
            $second_animal_id, $third_animal_id,
            $start_date, $end_date, $garde_id, $number_visit,
            $phone, $mail, $user_id, $prix, $i, $price, $prix_date, $gardes, $proposal;


    public function mount()
    {
        $this->gardes = Garde::all();

    }
        
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

            $price_animals = ($this->annonce->price * $this->i);
            $prix_date = ($price_animals * $days);
            $prix_final = $prix_date * 2;

        /* Validation du formulaire */   

        
            $this->user_id = auth()->user()->id;

            $this->validate();
       
            $proposal = Proposal::create([
                'annonce_id' => $this->annonce->id,
                'validated' => 2,
            ]);

            

            $demande = Demande::create([

                'content' => $this->content,

                'start_date' => $this->start_date,

                'end_date' => $this->end_date,

                'garde_id' => $this->garde_id,

                'phone' => $this->phone,

                'first_animal_id' => $this->first_animal_id,

                'second_animal_id' => $this->second_animal_id,

                'third_animal_id' => $this->third_animal_id,

                'number_visit' => $this->number_visit,

                'proposal_id' => $proposal->id,

                'prix_final' => $prix_final,
        
            ]);
            
            $proposal->annonce->user->notify(new ProposalRecieved($proposal));
           

            self::message('success', 'Ta demande est transmise au Pet-Sitter ! Il te répondra au plus vite. ');
            
            return redirect()->route('annonces.index');
     

    }

    


    
    public function show(Demande $demande)
    {
        //
    }

    
    public function edit(Demande $demande)
    {
        //
    }

    public function update(Request $request, Demande $demande)
    {
        //
    }

    
    public function destroy(Demande $demande)
    {
        //
    }

    public function render()
    {
        return view('livewire.demandes');
    }
}

