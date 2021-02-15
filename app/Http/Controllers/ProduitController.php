<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;

class ProduitController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Get from form input fild
         $search = request('search');

         //Si le champs recherche à été remplis
        if ($search) {

            /*Cherche un registre avec le nom demandé*/
            $produits = Produit::where([
                ['nomProduit','like','%'.$search.'%']
            ])->get();
        }
        else{
            //Query all produits
            $produits = Produit::all();
        }
        //Send back to view all produits as array
        return view('produits.produits',['produits' => $produits, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return: form view to create a product
     */
    public function create()
    {
        //Query all category
        $categories = Categorie::all();

         //Send back to view all category as array
        return view('produits.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request get all input filds from form
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Instacie le modele
        $produit = new Produit();
        $produit->nomProduit = trim($request->nomProduit);
        $produit->description = trim($request->description);
        $produit->img = $request->img;
        $produit->prix = $request->prix;
        $produit->totalStock = $request->totalStock;

        $pochette="default.png";

        /* Si une photo est envoyée, on fait l'Upload de l'image dans la pochette.
        Si pas de photp, une photo est fournie par default dans la pochette.*/

        //----------------------- Image Upload -----------------------

        if ( $request->hasFile('image') && $request->file('image')->isValid() )
         {
            //The image
            $requestImage = $request->image;
            //The extention
            $extension = $requestImage->extension();
            //Create a hash
            $imageName = sha1($requestImage->getClientOriginalName() . strtotime('now')). "." . $extension;
            //Save the imageName in a new folder
            $requestImage->move(public_path('img/produits'),$imageName);
            $pochette = $imageName;
            //Save the image into BD
            $produit->image = $pochette;
        }

        //Set the image
        $produit->image = $pochette;

        // ----------------------- end Image Upload -----------------------


        //Attache cet evenemnt à une categorie(Set the FK).

        //Save event in BD
         $produit->save();

         //redirige vers la page de tous le sproduits avec une message de feedback
         return redirect('/produits')->with('msg', 'Produit crée avec succes');

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
