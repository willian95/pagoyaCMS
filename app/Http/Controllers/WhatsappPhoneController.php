<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhatsappPhoneNumber;

class WhatsappPhoneController extends Controller
{
    
    function update(Request $request){

        $this->delete();

        $phone = new WhatsappPhoneNumber;
        $phone->number = $request->number;
        $phone->save();

        return response()->json(["success" => true, "msg" => "Teléfono de whatsapp actualizado"]);

    }

    function delete(){

        $numbers = WhatsappPhoneNumber::all();
        foreach($numbers as $number){
            $number->delete();
        }

    }

}
