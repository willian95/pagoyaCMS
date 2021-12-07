<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prospect;

class ProspectController extends Controller
{
    function fetch(Request $request){

        $users = Prospect::orderBy("id", "desc")->paginate(20);
        return response()->json($users);

    }
}
