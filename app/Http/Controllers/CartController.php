<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;//Added
use App\Models\Produit;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{

    //has: a sessao existe e tem valor
    //exists: sessao null
    public function store(Request $request)
    {
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

        //Clean session
       //Session::forget([$id_produit,'qnt']);

        $id_produit = $validData['id_produit'];
        //session()->push('panier',null);
        //dd('limpar');
        // Produc has been added
        $cart = session()->get('panier');// array /vetor

        if(is_array($cart)){
            //echo "é vetor";
            //print_r($cart);
            if(array_key_exists($id_produit, $cart)){// https://www.php.net/manual/pt_BR/function.array-key-exists.php

                $cart[$id_produit]['qtde'] = $cart[$id_produit]['qtde']+1;
            }else{
                //dd('no',$id_produit,$cart);
                $cart[$id_produit]=['qtde'=>1];
            }
            //$cart[]=['id_produit'=>$id_produit,'qtde'=>1];
            //dd('meio',$cart);
            session()->put('panier',$cart);

        }else{

            $cart[$id_produit]=['qtde'=>1];

            session()->put('panier',$cart);
            //echo "vazio";
        }


        return redirect()->route('list-all')->with('msg', 'Produit ajouté!');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $cart = session()->get('panier');// array /vetor
        $produits = Produit::all();
       // $produits = Produit::where([['nomProduit','like','%'.$search.'%']])->get();

        //$list = Produit::all()->where('id_produit','in',[1,5,9,6])
        //Send back to view all produits in table
        return view('carts.list',['produits'=> $produits, 'cart'=> $cart]);
    }

    public function create()
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
