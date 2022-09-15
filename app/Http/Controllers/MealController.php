<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class MealController extends Controller{


    public function searchByName(Request $request){   
        $validation = $request->validate([
            'name' => ['required'],
        ]);

        //$response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $response = Http::get('https://www.themealdb.com/api/json/v1/1/search.php', [
            's' => $request->name
        ]);

        return response()->json($response->json(),200);
    
    }

    public function randomMeal(Request $request){

        $response = Http::get('www.themealdb.com/api/json/v1/1/random.php');
        return response()->json($response->json(),200);
    }

    public function filterByCategory(Request $request){

        $validation = $request->validate([
            'category' => ['required'],
        ]);

        $response = Http::get("www.themealdb.com/api/json/v1/1/filter.php", [
            'c' => $request->category
        ]);
        return response()->json($response->json(),200);
    }
    
}
