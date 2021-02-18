<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{


    public function index()
    {
        //Query all categories
        $categories = Categorie::all();

        //dd($categories);
        return view('categories.list',['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.createCategorie');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        // Validate and store the category post
        try{
            $validated = $request->validate([
                'nomCategorie' =>  ['bail', 'required', 'unique:categories', 'max:25'],
            ]);
        } catch (ValidationException $e) {
            //dd($e);

            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();

            return back();
        }


        //Instacie le modele
        $categorie = new Categorie();
        //$categorie->nomCategorie = trim($request->old('nomCategorie') );
        $categorie->nomCategorie = trim($request->nomCategorie);

        //Save it into BD
        $categorie->save();

        //redirige vers la meme page avec une message de feedback
      //  return redirect('/categorie/create')->with('msg', 'Categorie crée avec succes');
        return response()->redirectToRoute('create-categorie')->with('msg', 'Categorie crée avec succes');

    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
      //Retrieving A Single Row / Column From A Table
      $categorie = DB::table('categories')->where('id_categorie', $id)->first();
      //dd($categorie);
      return view('categories.edit',['categorie'=> $categorie]);
    }


    public function update(Request $request, $id)
    {
        //dd($request->all());
        // Validate and store the category post
        try{
            $validated = $request->validate([
                'nomCategorie' =>  ['bail', 'required', 'unique:categories', 'max:25'],
            ]);
        } catch (ValidationException $e) {
            //dd($e);

            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();

            return back();
        }

      //Retrieving A Single Row / Column From A Table
      $categorie = DB::table('categories')->where('id_categorie', $id)->first();
       //Set new date
        $categorie->update($request->all() );
       //$categorie->nomCategorie = $request->nomCategorie;

       // dd($inputCategorie);
        //return view('categories.list',['categorie'=>$categorie,'$inputCategorie' => $ $inputCategorie]);
        return redirect('categories.list')->with('msg', 'Categorie editée avec succes');

    }


    public function destroy($id)
    {

    
    }
}
