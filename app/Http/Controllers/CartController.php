<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;//Added
use App\Models\Produit;
use App\Models\Achat;
use App\Models\Achat_Produit;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\User;
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
        // feedback message to user
        $msnFeedBack = "";
        //Get id from input
        $id_produit = $validData['id_produit'];
        //FACADES Query - Cherche un produit par son id.
        $produit = Produit::findOrFail($id_produit);
        //First time session is null: vector not exists yet
        $cart = session()->get('panier');
        //dd($cart);
        // if true, a vector aready exist
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

        return redirect()->route('list-all')->with(['cart'=>$cart, 'msg'=> $msnFeedBack]);
        //return redirect()->route('list-cart',['cart'=>session()->get('panier')])->with('msg',  $msnFeedBack);

        //https://laravel.com/docs/8.x/session#flash-data
    }

    //Add more item to cart
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
        return redirect()->route('list-cart')->with(['cart'=>session()->get('panier')]);
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
    }

    /**
     * Display a cart table
     *
     * @return a view passing the cart
     */
    public function list()
    {
        $cart = session()->get('panier');
        return view('carts.list',['cart'=> $cart]);
    }

    /**
     * Clean all cart
     * @return a view passing the null cart
     */
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
        unset($cart[$id_produit]);
        // Update session
        session()->put('panier',$cart);

         return redirect()
                ->route('list-cart',['cart'=>session()->get('panier')])
                ->with('msg', 'Item supprimé avec sucess!');
    }

    public function checkout()
    {
        $cart = session()->get('panier');

        $user = auth()->user();

        $sous_total = 0;
        $grand_total = 0;
        $total = 0;
        $tvq = 0;
        $tps = 0;
        foreach ($cart as $id_produit => $value){
            $sous_total =  $sous_total + $value['qtde'] * $value['prix']  ;
        }
        $tvq = ($sous_total * 9.975) / 100;
        $tps = ($sous_total * 5) / 100;
        $grandTotal = $sous_total + $tvq + $tps;
        //echo $grandTotal."<br>";
        /* TODO:
        1 - Save Achat
        2 - save Achat_produit
        3 - save Facture
        4 - Save Paiement.
        */
        //1

        $achat = New Achat();
        $achat->tps=$tps;
        $achat->tvq=$tvq;
        $achat->fk_id_user = $user->id;
        $achat->sousTotal=$sous_total;
        $achat->save();
        //$achatId = DB::getPdo()->lastInsertId();
        $achatId = $achat->id_achat;

        //2
        foreach ($cart as $id_produit => $value) {
            $achat_produit = new Achat_Produit();
            $achat_produit->fk_id_achat = $achatId;
            $achat_produit->fk_id_produit = $id_produit;
            $achat_produit->quantite = $value['qtde'];
            $achat_produit->prixProduit = $value['prix'];
            $achat_produit->save();
        }

        //3
        $facture = new Facture();
        $facture->fk_id_achat = $achatId;
        $facture->totalFinal = $grandTotal;
        $facture->save();
        $factureId = $facture->id_facture;
        //4
/**
 * https://developer.paypal.com/docs/checkout/reference/server-integration/setup-sdk/
 */

        //dd("Test");
        // Fait appel à l'API
        return view('paypal', ['grandTotal'=> $grandTotal, 'factureId'=>$factureId]);

    }

    public function paiementCompleted(Request $request){

        $factureId=$request->get('factureId');

        $facture = Facture::findOrFail($factureId);

        //4
        // CREER LE PAYEMEN EST L'ATACHE À LA FACTURE
        $paiement = new Paiement();
        $paiement->fk_id_facture = $factureId;
        $paiement->montant = $facture->totalFinal;
        $paiement->modePaiement = 'PayPal';
        $paiement->status = 'COMPLETED';
        $paiement->save();
        //dd($facture);
        session()->pull('panier', null); //Clean cart
        return view('completed');


    }


}//end class


