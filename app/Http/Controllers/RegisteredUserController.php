<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisteredUser;

class RegisteredUserController extends Controller
{
    
    function fetch(Request $request){

        $users = RegisteredUser::orderBy("id", "desc")->paginate(20);
        return response()->json($users);

    }

}
