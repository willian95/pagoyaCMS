<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prospect;
use App\Exports\ProspectExport;
use Maatwebsite\Excel\Facades\Excel;

class ProspectController extends Controller
{
    function fetch(Request $request){

        $users = Prospect::orderBy("id", "desc")->paginate(20);
        return response()->json($users);

    }

    function downloadCSV (){

        return Excel::download(new ProspectExport, 'prospectos.csv');

    }
}
