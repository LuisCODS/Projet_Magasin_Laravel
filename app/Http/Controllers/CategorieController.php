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
        //_______________________ VALIDATION __________________________
        //dd($request->all());
        try{
            $validated = $request->validate([
                // 'nomCategorie' =>  ['bail', 'required', 'unique:categories', 'max:25'],
                'nomCategorie'   => "required|unique:categories|max:200|required|regex:/^[-'A-zÀ-ÿ ]+$/",//Only strings & accents & space

            ]);
        } catch (ValidationException $e) {
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
        }
        // Add [_token] to fillable property to allow mass assignment on [App\Models\Categorie].
        Categorie::create($request->all());
        return response()->redirectToRoute('list-categories')->with('msg', 'Categorie crée avec succes');
    }

    //Show form to modifie input
    public function edit($id)
    {
          // HELPERS Query -Retrieving A Single Row  From A Table
           $categorie = DB::table('categories')->where('id_categorie', $id)->first();
           return view('categories.edit',['categorie'=> $categorie]);
    }



    //Update in data base
    public function update(Request $request, $id)
    {
        //_______________________ VALIDATION __________________________
        try{
            $validated = $request->validate([
                'nomCategorie' =>  ['bail', 'required', 'unique:categories', 'max:100','regex:/[a-zA-Z]+/'],
            ]);
        } catch (ValidationException $e) {
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
        }

        // get category
        $catTrouve = Categorie::findOrFail($id);
        $catTrouve->nomCategorie = $validated['nomCategorie'];
        $catTrouve->update();

        //Query all
        $categories = Categorie::all();

        return view('categories.list',['categories'=>$categories])->with('msg', 'Categorie editée avec succes');

    }//end method


    public function destroy($id)
    {
        // get category
       $trouve = Categorie::findOrFail($id);

        //Chek product table if category already has a relation
        $hasRelation = DB::table('produits')
                    ->where('fk_id_categorie','=', $id)
                    ->get();

        if (count($hasRelation) != 0) {
            return redirect()->route('list-categories')->with('info', 'Veuillez supprimer une categorie qui nest pas associée à un produit !');

        }else {
            //We can delete
           $trouve->delete();
        }
        return response()->redirectToRoute('list-categories')->with('msg', 'Categorie supprimée avec succes');

    }//end method



}//end class
