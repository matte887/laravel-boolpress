<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request) {
        // Con questo dd puoi verificare con postman che effettivamente i valori inseriti come key passino.
        // dd($request->all());

        // Salvo il nuovo lead nel db
        $data = $request->all();
        $lead = new Lead();
        $lead->fill($data);
        $lead->save();
        
        // Invio la mail all'admin
        
    }
}
