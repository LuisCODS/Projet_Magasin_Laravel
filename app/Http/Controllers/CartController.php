<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;//Added

class CartController extends Controller
{

    //has: a sessao existe e tem valor
    //exists: sessao null
    public function session(Request $request, $id_produit)
    {
        try{
            // Validate input filds
            $validData = $request->validate(["qnt" => "required|regex:/^[0-9]{1,2}+$/"]);
            //dd($validData);
        }catch(ValidationException $e){
            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
        }

        //Clean session
       //Session::forget([$id_produit,'qnt']);


        // Produc has been added
        if (Session::has('cart_porduct', $id_produit)) {

            //Session::put(['cart_porduct' => $id_produit, 'qnt' => Session::get('qnt') + $value  ]);
            Session::put('qnt',  $request->qnt );
             echo "cart_porduct ".Session::get('cart_porduct')." has QNT =".Session::get('qnt');

        //First time add product
        }else {
           // Session::put('cart_porduct' => $id_produit );
            Session::put(['cart_porduct'=> $id_produit, 'qnt'=>  $request->qnt ]);
            echo "cart_porduct ".Session::get('cart_porduct')." has QNT =".Session::get('qnt');
        }
         dd(Session::all());
        return redirect('/produits')->with('msg', 'Produit ajouté!');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show( $id_produit)
    {

    }

    public function edit($id_produit)
    {
        //
    }

    public function update(Request $request, $id_produit)
    {
        //
    }

    public function destroy($id_produit)
    {
        //
    }
}
