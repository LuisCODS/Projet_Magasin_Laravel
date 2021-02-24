<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Adresse;
use DB;

class AdresseController extends Controller
{

    public function index()
    {
    //   // Get auth user
    //     $user = auth()->user();
    //     // get all user adresses from model
    //     $adresses = $user->adresses;
    //     // pass the addres to view
    //     return view('adresses.dashboard', ['adresses' => $adresses]);
    }


    public function create()
    {
        return view('adresses.create');
    }

    /**
     * Store adresse in to BD
     *
     * @param  all inputs from form
     * @return view
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try{
            // Validate input filds
            $validData = $request->validate([
               'nbCivic'        => "required|regex:/^[0-9]{3,8}$/",//Only numbers 5 à 10 caractères
                'rue'           => "required|max:70',regex:/^[-'A-zÀ-ÿ ]+$",//Only strings & accents & space
                'quartie'       => "required|max:50',regex:/^[-'A-zÀ-ÿ ]+$",
                'pays'          => "required|max:30',regex:/^[-'A-zÀ-ÿ ]+$",
                "codePostal"    => 'required|regex:/[A-Za-z]\d[A-Za-z]?\d[A-Za-z]\d/', //H2E1X2
                "ville"         => "required|max:30',regex:/^[-'A-zÀ-ÿ ]+$",
                "defaulAdresse" => "",
            ]);
            //dd($validData);
        }catch(ValidationException $e){

            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
            // return response()->redirectToRoute('admin.brokers.index');
        }

        // __________________ CREATE ADRESSE __________________

        $adresse = new Adresse();
        // Set objet with inputs  values from form request
        $adresse->nbCivic          = trim($request->get('nbCivic'));
        $adresse->rue              = trim($request->get('rue'));
        $adresse->quartie          = trim($request->get('quartie'));
        $adresse->pays             = trim($request->get('pays'));
        $adresse->codePostal       = trim($request->get('codePostal'));
        $adresse->ville            = trim($request->get('ville'));

        if (trim($request->get('defaulAdresse')) == "checked") {
            $adresse->defaulAdresse  = "Oui";
        } else{
             $adresse->defaulAdresse  = "Non";
        }
       // dd($adresse);
        // __________________ ATTACHE REALTION BETWEEN USER __________________

        // Get auth user
        $user = auth()->user();
        // Set FK
        $adresse->fk_id_user = $user->id;
        // save
        $adresse->save();

        // pass the addres to view
        return view('adresses.show', ['adresse' => $adresse])->with('msg','Adresse ajouté avec sucess! ');
         //return redirect('adresse/show')->with('msg', 'Produit crée avec succes');
    }


    public function show($id)
    {
        $adresse = Adresse::findOrFail($id);
        dd($adresse);
        return view('adresses.show',['adresse' => $adresse]);
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


    public function update(Request $request, $id)
    {
        //
    }

    public function list()
    {
        // $adresses = Adresse::all();
        // return view('adresses.list',['adresses'=> $adresses]);
        // Get auth user
        $user = auth()->user();
        $adresses = DB::table('adresses')
                            ->where('fk_id_user', '=', $user->id)
                            ->get();


        // get all user adresses
        //$adresses = $user->adresses;

        //dd($adresses);
        // pass the addres to view
        return view('adresses.list', ['adresses' => $adresses]);
    }

    public function destroy($id)
    {
        //
    }
}
