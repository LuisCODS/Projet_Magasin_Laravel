<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Support\Facades\DB;// Base de donnes
use Illuminate\Http\Request;//Éloquent


class CategorieController extends Controller
{

    //Display all category
    public function index()
    {
        //Facades-Query all categories
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

        $categorie = new Categorie();
        //$categorie->nomCategorie = trim($request->old('nomCategorie') );
        $categorie->nomCategorie = trim($request->nomCategorie);

        //Save it into BD
        $categorie->save();

        //return response()->redirectToRoute('create-categorie')->with('msg', 'Categorie crée avec succes');
       // return response()->redirectToRoute('list-categorie',['adresses' => $adresses])->with('msg', 'Categorie crée avec succes');
        return response()->redirectToRoute('list-categories')->with('msg', 'Categorie crée avec succes');

    }


    //Show form to modifie input
    public function edit($id)
    {
          // HELPERS Query -Retrieving A Single Row  From A Table
           $categorie = DB::table('categories')->where('id_categorie', $id)->first();
          // FACADES Query -Retrieving A Single Row  From A Table
          //$categorie = Categorie::findOrFail($id); //Ne marche pas! ?????????
           return view('categories.edit',['categorie'=> $categorie]);
    }

    //Update in data base
    public function update(Request $request, $id)
    {
        //dd($id);
        // --------------------- Validate --------------------
        try{
            $validated = $request->validate([
                'nomCategorie' =>  ['bail', 'required', 'unique:categories', 'max:25'],
            ]);
        } catch (ValidationException $e) {
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
        }

        //FACADES - Query: Get category to be updated
       // $cat = Categorie::findOrFail($id)->update($request->nomCategorie);
       //Retornará um arrayde resultados.
       // $cat = DB::table('categories')->where('id_categorie', $id)->first();
        //$catTrouve = Categorie::findOrFail($cat->id_categorie);
        //$catTrouve =  Categorie::where('id_categorie',$id)->get();// Illuminate\Database\Eloquent\Collection
       // $catTrouve =  Categorie::where('id_categorie',$id)->firstOrFail();//App\Models\Categorie
       //dd($catTrouve->nomCategorie); // get attributs

        $catTrouve = DB::table('categories')->where('id_categorie', $id)->first();
        $catTrouve->nomCategorie = $validated['nomCategorie'];

        //$ff = Categorie::findOrFail($catTrouve->id_categorie);
        //$catTrouve->save();
        //dd($ff);

        //Query all
        $categories = Categorie::all();

        return view('categories.list',['categories'=>$categories])->with('msg', 'Categorie editée avec succes');
       // return redirect('categories.list')->with('msg', 'Categorie editée avec succes');
        //return response()->redirectToRoute('list-adresse',['adresses' => $adresses])->with('msg', 'Adresse supprimée avec succes');


    }


}//end class
