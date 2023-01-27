<?php

namespace App\Http\Controllers;

use App\Models\Paid;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class GardeDonePDF extends Controller
{
    public $start_watch;
    public function generateGardeDonePDF(Paid $paid)
    {       
    
        $data = [
            'title' => 'Récapitulatif de la garde',
            'start_watch' => $paid->start_watch,
            'end_watch' => $paid->end_watch,
            'animal' => $paid->animal,
            'price' => $paid->price /100,
            'keeper' => $paid->keeper,
            'owner' => $paid->owner
        ];
        //view()->share('paid', $data);
        //$pdf = PDF::loadView('myPDF', $data);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('gardeDonePDF', $data);
        return $pdf->download('itsolutionstuff.pdf');

    }
}
