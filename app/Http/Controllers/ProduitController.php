<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{


    /**
     * Display all prdouits
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
            //Facades-Query all produits
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
        //Facades-Query all category
        $categories = Categorie::all();
         //Send back to view all category as array
        return view('produits.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param bail:interromper a execução de regras de validação em um atributo após a primeira falha de *validação.
     * @return  a message succes
     */
    public function store(Request $request)
    {
        //dd($request->all());  'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        //----------------------- VALIDATION -----------------------
        try{
            // Validate and store the product
            $validated = $request->validate([
                'nomProduit' => ['bail','required','unique:Produits','max:45','regex:/[a-zA-Z]+/'],
                'img'        => ['required','max:100'],
                "prix"       => ['bail','required','regex:/^[0-9]+(\.[0-9]{2}?)?$/'],
                "totalStock" => ['bail','required','numeric', 'between:1,999999'],
                "nomCategorie" => ['bail','required','min:1'],
                "description" => ['bail','required'],
            ]);

        }catch(ValidationException $e){
            //dd($e);
            //validar e armazenar quaisquer mensagens de erro em um pacote de erro nomeado
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();

            return back();
            // return response()->redirectToRoute('admin.brokers.index');
        }

        $produit = new Produit();

        $produit->nomProduit = trim($validated['nomProduit']);
        $produit->description = trim($validated['description']);
        $produit->prix = $validated['prix'];
        $produit->totalStock = $validated['totalStock'];
        //Attache the relation (Set the FK).
        $produit->fk_id_categorie = $validated['nomCategorie'];
       // dd($produit->fk_id_categorie )

        //----------------------- Image Upload -----------------------

        if ( $request->hasFile('img') && $request->file('img')->isValid() )
         {
            //The image
            $requestImage = $request->img;
            //The extention
            $extension = $requestImage->extension();
            //Create a hash
            $imageName = 'img/produits/'.sha1($requestImage->getClientOriginalName() . strtotime('now')). "." . $extension;
            //Image path
            $requestImage->move(public_path('img/produits/'),$imageName);
           // $requestImage->move(public_path('/'),$imageName);
            $produit->img = $imageName;
        }

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
        //FACADES Query - Cherche un produit par son id.
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
        //FACADES- Query all category
        $categories = Categorie::all();
        $produit = Produit::findOrFail($id);
         return view('produits.edit',['produit'=> $produit,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int    'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // _____________________ Begin validation _____________________
       try{
            $request->validate([

                'nomProduit' => 'required|unique:Produits|max:45',
                'img'        => 'required|max:100',
                "prix"       => ['bail','required','regex:/^[0-9]+(\.[0-9]{2}?)?$/'],
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
        // _____________________ End validation _____________________

        //FACADES - Query Get product to be updated
        $produit = Produit::findOrFail($id);
        $produit->nomProduit = trim($request->get('nomProduit'));
        $produit->description = trim($request->get('description'));
        $produit->prix = $request->get('prix');
        $produit->totalStock = $request->get('totalStock');
        //Attache the relation (Set the FK).
        $produit->fk_id_categorie = $request->get('nomCategorie');

        //----------------------- Image Upload -----------------------

        if ( $request->hasFile('img') && $request->file('img')->isValid() ) {
            //Get old picture
            $oldImg = public_path('/').'/'.$produit->img;
            //dd($oldImg)

            // if( ! $oldImg == 'avatar.png' )
            // {
            //        unlink($oldImg);
            // }
            //Delete image
            unlink($oldImg);
            //The image
            $requestImage = $request->img;
            //The extention
            $extension = $requestImage->extension();
            //Create a hash
            $imageName = 'img/produits/'.sha1($requestImage->getClientOriginalName() . strtotime('now')). "." . $extension;
            //Image path
            $requestImage->move(public_path('img/produits/'),$imageName);
            //Set image name + path
            $produit->img = $imageName;
        }
        // ----------------------- end Image Upload -----------------------
        $produit->update();
         //redirige vers la page de tous le produits avec une message de feedback
         return response()->redirectToRoute('list-produit')->with('msg', 'Produit edité avec succes');
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
        //Query all category
        $categories = Categorie::all();
        //Send back to view all produits in table
        return view('produits.list',['produits'=> $produits, 'categories'=>$categories]);
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
        $produit = Produit::findOrFail($id); // dd($produit);
        //$produit->delete();
        //Get image name
        $oldImg = public_path('/').'/'.$produit->img;
        //Delete image
        $produit->delete();
        //Si l'image existe, on delete
        if(file_exists($oldImg))   unlink($oldImg);
        //Query all produits
        $produits = Produit::all();
        //Query all category
        $categories = Categorie::all();
        //Send back to view all produits in table
        //return redirect('/produits')->with('msg', 'Produit supprimée avec succes');
        return response()->redirectToRoute('list-produit')->with('msg', 'Produit supprimée avec succes');

    }



}//END CLASS
