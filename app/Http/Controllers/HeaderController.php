<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Header;

class HeaderController extends Controller
{
    
    function store(Request $request){

        $header = new Header;
        $header->image = $request->image;
        $header->type = $request->type;
        $header->save();

        return response()->json(["success" => true, "msg" => "Banner actualizado"]);

    }

}
