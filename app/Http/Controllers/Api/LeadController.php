<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use App\Mail\NewContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request) {
        // Con questo dd puoi verificare con postman che effettivamente i valori inseriti come key passino.
        // dd($request->all());

        // Prelevo i dati
        $data = $request->all();

        // Faccio i controlli
            // Per fare la validazione il metodo validate non può essere usato in questo caso: va fatto in modo manuale.
        $validator= Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        // comportamento validator personalizzato
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Salvo il nuovo lead nel db
        $lead = new Lead();
        $lead->fill($data);
        $lead->save();
        
        // Invio la mail all'admin
        Mail::to('admin@boolpress.it')->send(new NewContactRequest($lead));

        // Se il controllo va a buon fine, mandiamo success true.
        return response()->json([
            'success' => true
        ]);
    }
}
