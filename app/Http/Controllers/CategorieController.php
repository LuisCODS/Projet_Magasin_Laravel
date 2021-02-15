<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;


class CategorieController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for create  a new category.
     *
     * @return form view 
     */
    public function create()
    {
        return view('categories.createCategorie');

    }

    /**
     * Store a newly created category in storage.
     *
     * @param  $request send all input filds from form
     * @return  a message succes
     */
    public function store(Request $request)
    {
        //Instacie le modele
        $categorie = new Categorie();
        $categorie->nomCategorie = trim($request->nomCategorie);

        //Save it into BD
         $categorie->save();

         //redirige vers la meme page avec une message de feedback
         return redirect('/categorie/create')->with('msg', 'Categorie crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
