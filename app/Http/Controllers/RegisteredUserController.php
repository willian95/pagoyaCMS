<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisteredUser;
use App\Exports\RegisteredUserExport;
use Maatwebsite\Excel\Facades\Excel;

class RegisteredUserController extends Controller
{
    
    function fetch(Request $request){

        $users = RegisteredUser::orderBy("id", "desc")->paginate(20);
        return response()->json($users);

    }

    function downloadCSV (){

        return Excel::download(new RegisteredUserExport, 'usuariosregistrados.csv');

    }

}
