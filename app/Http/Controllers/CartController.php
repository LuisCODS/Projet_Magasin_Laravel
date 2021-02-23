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
            $validData = $request->validate(

                [ "id_produit" => "required|integer"]
            );

        }catch(ValidationException $e){

            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
        }

        // ================================= SESSION CART ============================

        $msnFeedBack = "";
        //Get id from input
        $id_produit = $validData['id_produit'];
        //FACADES Query - Cherche un produit par son id.
        $produit = Produit::findOrFail($id_produit);
        //First time session is null: vector not exist yet
        $cart = session()->get('panier');
        //dd($cart);
        // if true, an vector aready exist
        if(is_array($cart)){
            //Checks if product has been aready added
            if(array_key_exists($id_produit, $cart)){

                // the same product: increases quantity
                $cart[$id_produit]=[
                                    'qtde'        => $cart[$id_produit]['qtde'] + 1,
                                    'nomProduit'  => $produit->nomProduit,
                                    'description' => $produit->description,
                                    'prix'        => $cart[$id_produit]['prix'],
                                    'img'         => $produit->img
                                   ];
                $msnFeedBack = "Ce produit a été déjà ajouté ".$cart[$id_produit]['qtde']." fois";

        //dd($cart);//STEP 2

            }else{
                // a new product: set default quantity
                $cart[$id_produit]=[
                                    'qtde'          => 1,
                                    'nomProduit'    => $produit->nomProduit,
                                    'description'   => $produit->description,
                                    'prix'          => $produit->prix,
                                    'img'           => $produit->img
                                  ];
                                    $msnFeedBack = "Le produit a été bien ajouté !";
            }
            // Store vector in the session...
            session()->put('panier',$cart);

        }else{
            //Set data into vector
            $cart[$id_produit]=[
                                'qtde'          => 1,
                                'nomProduit'    => $produit->nomProduit,
                                'description'   => $produit->description,
                                'prix'          => $produit->prix,
                                'img'           => $produit->img
                              ];
            $msnFeedBack = "Le produit a été bien ajouté!";

            //Create a session and put the vector inside
            session()->put('panier',$cart);
            //dd($cart);//STEP 1
        }
       //  dd($cart);
        //dd(session()->all());
        return redirect()->route('list-all',['cart'=>session()->get('panier')])->with('msg',  $msnFeedBack);
      //return redirect()->route('list-cart',['cart'=>session()->get('panier')])->with('msg',  $msnFeedBack);
    }

    //Add more item into cart
    public function addQuantity($id_produit)
    {
        $cart = session()->get('panier');

        $cart[$id_produit]=[
                            'qtde'         => $cart[$id_produit]['qtde'] + 1,
                            'nomProduit'   => $cart[$id_produit]['nomProduit'],
                            'description'  => $cart[$id_produit]['description'],
                            'prix'         => $cart[$id_produit]['prix'],
                            'img'          => $cart[$id_produit]['img']
                           ];
        session()->put('panier',$cart);
        //dd($cart);
        return redirect()->route('list-cart',['cart'=>session()->get('panier')]);
    }

    //Remove items from cart
    public function removeQuantity($id_produit)
    {

        $cart = session()->get('panier');

        if ($cart[$id_produit]['qtde'] == 1) {
            return redirect()->route('list-cart',['cart'=>session()->get('panier')])->with('msg', 'Limite max de redution!');
        }else {
            $cart[$id_produit]=[
                    'qtde'         => $cart[$id_produit]['qtde'] - 1,
                    'nomProduit'   => $cart[$id_produit]['nomProduit'],
                    'description'  => $cart[$id_produit]['description'],
                    'prix'         => $cart[$id_produit]['prix'],
                    'img'          => $cart[$id_produit]['img']
                    ];
            session()->put('panier',$cart);
            return redirect()->route('list-cart',['cart'=>session()->get('panier')]);
        }
        //dd($cart);
       // return redirect()->route('list-cart',['cart'=>session()->get('panier')])->with('msg', 'Limite max de redution!');
    }

    /**
     * Display a cart table
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $cart = session()->get('panier');
        return view('carts.list',['cart'=> $cart]);
    }

    //Vide le panier
    public function destroy()
    {
        session()->pull('panier',null); //Clean cart
        return view('carts.list',['cart'=> []]);
    }

    //Remove one item from cart
    public function removeItem($id_produit)
    {
        // get cart from session
         $cart = session()->get('panier');

        // Set indice a null
       // $cart->deleteAt($id_produit);
        unset($cart[$id_produit]);
        // Update session
        session()->put('panier',$cart);

//dd($cart);

        // Forget a single key...
        //session()->forget($id_produit);
        //session()->pull('panier',$id_produit); //Clean cart
        //
        // session()->pull('panier',null); //Clean cart
        // return view('carts.list',['cart'=> []]);
         return redirect()->route('list-cart',['cart'=>session()->get('panier')])->with('msg', 'Item supprimé avec sucess!');

    }


}//end class


