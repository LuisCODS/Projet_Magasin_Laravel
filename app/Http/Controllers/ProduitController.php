<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Get form input fild
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
     * Show the form for create  a new product.
     *
     * @return:  form view  and an array of category
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
     * @param  $request send all input filds from form
     * @return  a message succes
     */
    public function store(Request $request)
    {

           //dd($request->all());
        try{
            // Validate and store the product post
            $request->validate([
                'nomProduit' => 'required|unique:Produits|max:45',
                'img'        => 'required|max:100',
                "prix"       => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                "totalStock" => "required|numeric|between:1,999999",
                "nomCategorie" => 'required|min:1',
                "description" => 'required',
            ]);

        }catch(ValidationException $e){
            //dd($e);

            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();

            return back();
            // return response()->redirectToRoute('admin.brokers.index');
        }

        $produit = new Produit();

        $produit->nomProduit = trim($request->get('nomProduit'));
        $produit->description = trim($request->get('description'));
        $produit->prix = $request->get('prix');
        $produit->totalStock = $request->get('totalStock');
        //Attache the relation (Set the FK).
        $produit->fk_id_categorie = $request->get('nomCategorie');
        //pochette="default.png";

        //----------------------- Image Upload -----------------------

        if ( $request->hasFile('img') && $request->file('img')->isValid() )
         {
            //The image
            $requestImage = $request->img;
            //The extention
            $extension = $requestImage->extension();
            //Create a hash
            $imageName = sha1($requestImage->getClientOriginalName() . strtotime('now')). "." . $extension;
            //Image path
            $requestImage->move(public_path('img/produits'),$imageName);
            //$pochette = $imageName;
            $produit->img = $imageName;
        }

        //Set the image
        //$produit->img = $pochette;
        //dd('produt',$produit);
        // ----------------------- end Image Upload -----------------------

        //Save event in BD
         $produit->save();

         //redirige vers la page de tous le produits avec une message de feedback
         return redirect('/produits')->with('msg', 'Produit crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id du produit
     * @return un produit
     */
    public function show($id)
    {
        //Cherche un produit par son id.
        $produit = Produit::findOrFail($id);

        return view('produits.show',['produit' => $produit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($produit);
        //Query all category
        $categories = Categorie::all();
        $produit = Produit::findOrFail($id);
         return view('produits.edit',['produit'=> $produit,'categories' => $categories]);
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
        //Produit::findOrFail($id)->update($request->all());

        //Begin validation
       try{
            $request->validate([
                'nomProduit' => 'required|unique:Produits|max:45',
                'img'        => 'required|max:100',
                "prix"       => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                "totalStock" => "required|numeric|between:1,999999",
                "nomCategorie" => 'required|min:1',
                "description" => 'required',
            ]);

        }catch(ValidationException $e){    
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
            // return response()->redirectToRoute('admin.brokers.index');
        }

        //End of validation

        //Get all inputs
        $data = $request->all();

        //dd($data);
        //----------------------- Image Upload -----------------------

        if ( $request->hasFile('img') && $request->file('img')->isValid() )
         {
            //The image
            $requestImage = $request->img;
            //The extention
            $extension = $requestImage->extension();
            //Create a hash
            $imageName = sha1($requestImage->getClientOriginalName() . strtotime('now')). "." . $extension;
            //Image path
            $requestImage->move(public_path('img/produits'),$imageName); 
            //Change image path       
            $data['img'] = $imageName;
        }

        //dd('produt',$produit);
        // ----------------------- end Image Upload -----------------------

        //Get product to be updated
        $produit = Produit::findOrFail($id);

        $produit->nomProduit = trim($request->get('nomProduit'));
        $produit->description = trim($request->get('description'));
        $produit->prix = $request->get('prix');
        $produit->totalStock = $request->get('totalStock');
        //Attache the relation (Set the FK).
        $produit->fk_id_categorie = $request->get('nomCategorie');
        $produit->save();

         //redirige vers la page de tous le produits avec une message de feedback
         return redirect('{/produits/list}')->with('msg', 'Produit edité avec succes');
    }


    /**
     * Display all product in a table.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //Query all produits
        $produits = Produit::all();

        //Send back to view all produits in table
        return view('produits.list',['produits'=> $produits]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Cherche un produit par son id.
        //$produit = Produit::findOrFail($id);
       // $produit->delete();

        Produit::findOrFail($id)->delete();

        return view('produit.list')->with('msg', 'produit supprimée avec succes');

    }
}
