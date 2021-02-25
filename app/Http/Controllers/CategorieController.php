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
                'nomCategorie'   => "required|max:200|required|regex:/^[-'A-zÀ-ÿ ]+$/",//Only strings & accents & space

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
          // FACADES Query -Retrieving A Single Row  From A Table
          //$categorie = Categorie::findOrFail($id); //Ne marche pas! ?????????
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

        //FACADES - Query: Get category to be updated
       // $cat = Categorie::findOrFail($id)->update($request->nomCategorie);
       //Retornará um arrayde resultados.
       // $cat = DB::table('categories')->where('id_categorie', $id)->first();
        //$catTrouve = Categorie::findOrFail($cat->id_categorie);
        //$catTrouve =  Categorie::where('id_categorie',$id)->get();// Illuminate\Database\Eloquent\Collection
       //$catTrouve =  Categorie::where('id_categorie',$id)->firstOrFail();//App\Models\Categorie
       //dd($catTrouve->nomCategorie); // get attributs

       // $catTrouve = DB::table('categories')->where('id_categorie', $id)->first();
        //$catTrouve->nomCategorie = $validated['nomCategorie'];

        //$cat->update($request->all());

        //$catTrouve->save();
        //dd($ff);

        //Query all
        $categories = Categorie::all();

        return view('categories.list',['categories'=>$categories])->with('msg', 'Categorie editée avec succes');
       // return redirect('categories.list')->with('msg', 'Categorie editée avec succes');
        //return response()->redirectToRoute('list-adresse',['adresses' => $adresses])->with('msg', 'Adresse supprimée avec succes');


    }//end method


    public function destroy($id)
    {
        // get category
       $trouve = Categorie::findOrFail($id);

        //Chek produit table if category already has a relation
        $hasRelation = DB::table('produits')
                    ->where('fk_id_categorie','=', $id)
                    ->get();

        if (count($hasRelation) != 0) {
            return response()->redirectToRoute('list-categories')->with('msg', 'Cette Categorie est déjà associée à un produit!');
        }else {
            //We can delete
           $trouve->delete();
        }
        return response()->redirectToRoute('list-categories')->with('msg', 'Categorie supprimée avec succes');

    }//end method



}//end class
