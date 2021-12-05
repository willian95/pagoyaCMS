<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Docs\DocStoreRequest;
use App\Http\Requests\Docs\DocUpdateRequest;
use App\Models\Doc;

class DocController extends Controller
{
    
    function store(DocStoreRequest $request){

        try{

            $doc = new Doc;
            $doc->category_id = $request->category;
            $doc->description = $request->description;
            $doc->title = $request->title;
            $doc->order = $request->order;
            $doc->save();

            return response()->json(["success" => true, "msg" => "Documentación creada"]);

        }catch(\Exception $e){

            return response()->json(["success" => true, "msg" => "Ha ocurrido un problema"]);

        }

    }

    function update(DocUpdateRequest $request){

        try{

            $doc = Doc::find($request->id);
            $doc->category_id = $request->category;
            $doc->description = $request->description;
            $doc->title = $request->title;
            $doc->order = $request->order;
            $doc->update();

            return response()->json(["success" => true, "msg" => "Documentación actualizada"]);

        }catch(\Exception $e){

            return response()->json(["success" => true, "msg" => "Ha ocurrido un problema"]);

        }

    }

    function fetch(Request $request){

        $docs = Doc::with("category")->paginate(20);

        return response()->json($docs);

    }

    function edit($id){

        $doc = Doc::find($id);

        return view("docs.edit.index", ["doc" => $doc]);

    }

}
