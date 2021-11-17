<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    function store(CategoryStoreRequest $request){

        try{

            $slug = str_replace(" ", "-", $request->name);
            $slug = str_replace( "/", "-", $slug);

            if(Category::where("slug", $slug)->count() > 0){
                $slug = $slug."-".uniqid();
            }

            $category = new Category;
            $category->name = $request->name;
            $category->slug = $slug;
            $category->order = $request->order;
            $category->save();

            return response()->json(["success" => true, "msg" => "Categoría creada"]);

        }catch(\Exception $e){

            return response()->json(["success" => true, "msg" => "Ha ocurrido un problema", "err" => $e->getMessage()]);

        }

    }

    function update(CategoryStoreRequest $request){

        try{

            $slug = str_replace(" ", "-", $request->name);
            $slug = str_replace( "/", "-", $slug);

            if(Category::where("slug", $slug)->where("id", "<>", $request->id)->count() > 0){
                $slug = $slug."-".uniqid();
            }

            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->slug = $slug;
            $category->order = $request->order;
            $category->update();

            return response()->json(["success" => true, "msg" => "Categoría actualizada"]);

        }catch(\Exception $e){

            return response()->json(["success" => true, "msg" => "Ha ocurrido un problema"]);

        }

    }

    function delete(Request $request){

        try{

            $category = Category::find($request->id);
            $category->delete();

            return response()->json(["success" => true, "msg" => "Categoría eliminada"]);

        }catch(\Exception $e){

            return response()->json(["success" => true, "msg" => "Ha ocurrido un problema"]);

        }

    }

    function fetch(){

        $categories = Category::all();
        return response()->json($categories);

    }

}
