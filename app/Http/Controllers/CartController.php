<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;//Added
use App\Models\Produit;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    //Create a session cart
    public function store(Request $request)
    {

       // ================================= VALIDATION ============================
       // dd($request->all());
        try{
            // Validate input filds
            $validData = $request->validate(["id_produit" => "required|integer"]);
            //dd($validData);
        }catch(ValidationException $e){
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
        }

        // ================================= SESSION CART ============================

        $id_produit = $validData['id_produit'];
        //FACADES Query - Cherche un produit par son id.
        $produit = Produit::findOrFail($id_produit);

        //First time session is null: not exist yet
        $cart = session()->get('panier');

        //dd($cart);
        // if session aready exist
        if(is_array($cart))
        {
            //Checks if product has been aready added
            if(array_key_exists($id_produit, $cart)){

                //For the same product: increases quantity
                $cart[$id_produit]=['qtde'=> $cart[$id_produit]['qtde'] + 1,
                                    'nomProduit'=>$produit->nomProduit,
                                    'description'=>$produit->description,
                                    'prix'=>($produit->prix * $cart[$id_produit]['qtde']),
                                    'img'=>$produit->img];
            }else{
                //For the new product: set default quantity
                $cart[$id_produit]=['qtde'=> 1,
                                    'nomProduit'=>$produit->nomProduit,
                                    'description'=>$produit->description,
                                    'prix'=>$produit->prix,
                                    'img'=>$produit->img];
            }
            // Store vector in the session...
            session()->put('panier',$cart);

        }else{
            //Set data into vector
            $cart[$id_produit]=['qtde'=> 1,
                                'nomProduit'=>$produit->nomProduit,
                                'description'=>$produit->description,
                                'prix'=>$produit->prix,
                                'img'=>$produit->img];

            //Create a session and put the vector inside
            session()->put('panier',$cart);
            //dd($cart);//STEP 1
        }
         //dd($cart);
        //dd(session()->all());
        return redirect()->route('list-all',['cart'=>session()->get('panier')])->with('msg', 'Produit ajouté!');
    }

    //Add more item into cart
    public function addItemQuantity(Request $request)
    {

       // ================================= VALIDATION ============================
       // dd($request->all());
        try{
            // Validate input filds
            $validData = $request->validate(["id_produit" => "required|integer"]);
            //dd($validData);
        }catch(ValidationException $e){
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
        }

        // ================================= SESSION CART ============================

        $id_produit = $validData['id_produit'];
        //FACADES Query - Cherche un produit par son id.
        $produit = Produit::findOrFail($id_produit);

        //First time session is null: not exist yet
        $cart = session()->get('panier');

        //dd($cart);
        // if session aready exist
        if(is_array($cart))
        {
            //Checks if product has been aready added
            if(array_key_exists($id_produit, $cart)){

                //For the same product: increases quantity
                $cart[$id_produit]=['qtde'=> $cart[$id_produit]['qtde'] + 1,
                                    'nomProduit'=>$produit->nomProduit,
                                    'description'=>$produit->description,
                                    'prix'=>($produit->prix * $cart[$id_produit]['qtde']),
                                    'img'=>$produit->img];
            }else{


            }
            // Store vector in the session...
            session()->put('panier',$cart);

        }else{

        }
         //dd($cart);
        //dd(session()->all());
        // direcionar de volta para a página do cart listagem
        return redirect()->route('list-all',['cart'=>session()->get('panier')])->with('msg', 'Produit ajouté!');
    }

    //Remove items from cart
    public function removeItemQuantity(Request $request)
    {

       // ================================= VALIDATION ============================
        try{
            // Validate input filds
            $validData = $request->validate(["id_produit" => "required|integer"]);
            //dd($validData);
        }catch(ValidationException $e){
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
        }

        // ================================= SESSION CART ============================

        $id_produit = $validData['id_produit'];
        //FACADES Query - Cherche un produit par son id.
        $produit = Produit::findOrFail($id_produit);

        //First time session is null: not exist yet
        $cart = session()->get('panier');

        //dd($cart);
        // if session aready exist
        if(is_array($cart))
        {
            //Checks if product has been aready added
            if(array_key_exists($id_produit, $cart)){

                //For the same product: increases quantity
                $cart[$id_produit]=['qtde'=> $cart[$id_produit]['qtde'] - 1,
                                    'nomProduit'=>$produit->nomProduit,
                                    'description'=>$produit->description,
                                    'prix'=>($produit->prix * $cart[$id_produit]['qtde']),
                                    'img'=>$produit->img];
            }else{

            }
            // Store vector in the session...
            session()->put('panier',$cart);

        }else{

        }
        return redirect()->route('list-all',['cart'=>session()->get('panier')])->with('msg', 'Produit ajouté!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $cart = session()->get('panier');// array /vetor
        return view('carts.list',['cart'=> $cart]);
    }

    //Delete a session
    public function destroy()
    {
        session()->pull('panier',null);
        return view('carts.list',['cart'=> []]);
    }
}
