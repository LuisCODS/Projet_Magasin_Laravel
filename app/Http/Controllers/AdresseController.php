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
    //     return view('adresses.list', ['adresses' => $adresses]);
    }

    // Send form to create adress
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
               'nbCivic'        => "required|regex:/^[0-9]{3,8}$/",//Only numbers 5 à 10 caractères ^[-'A-zÀ-ÿ ]+$
                'rue'           => "required|max:70',regex:/^[-'A-zÀ-ÿ ]+$/",//Only strings & accents & space
                'quartie'       => "required|max:50',regex:/^[-'A-zÀ-ÿ ]+$/",
                'pays'          => "required|max:30',regex:/^[-'A-zÀ-ÿ ]+$/",
                "codePostal"    => 'required|regex:/[A-Za-z]\d[A-Za-z]?\d[A-Za-z]\d/', //H2E1X2
                "ville"         => "required|max:30',regex:/^[-'A-zÀ-ÿ ]+$/",
                // "defaulAdresse" => "",
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

        if ($request->get('defaulAdresse') == "checked") {
            $adresse->defaulAdresse  = "1";
        } else{
             $adresse->defaulAdresse  = "0";
        }
        // Get auth user
        $user = auth()->user();
        // attache relation between user and adress: set FK
        $adresse->fk_id_user = $user->id;
        // save
        $adresse->save();

        return response()->redirectToRoute('save-adresse',['adresse' => $adresse])->with('msg', 'Adresse a été bien ajouté!');
    }


    // public function show($id)
    // {
    //     $adresse = Adresse::findOrFail($id);
    //     //dd($adresse);
    //     return view('adresses.show',['adresse' => $adresse]);
    // }

    // Retourne une vue avec tous les informations courrantes de l'Adresse à editer
     public function edit($id)
     {
        $adresse = Adresse::findOrFail($id);
        return view('adresses.edit',['adresse' => $adresse]);
     }

    // Recoit les nouveaux donnés à mettre à jous
    public function update(Request $request, $id)
    {
        // get adress by ID
        $adresse = Adresse::findOrFail($id);
        // update dates...
        $adresse->nbCivic     = trim($request->get('nbCivic'));
        $adresse->rue         = trim($request->get('rue'));
        $adresse->quartie     = trim($request->get('quartie'));
        $adresse->pays        = trim($request->get('pays'));
        $adresse->codePostal  = trim($request->get('codePostal'));
        $adresse->ville       = trim($request->get('ville'));

        // user wants change main adress
        if ($request->get('defaulAdresse') == "checked" ) {

            //Chek if aready exist one default
            $user = auth()->user();
            $trouve = DB::table('adresses')
                            ->where('fk_id_user', '=', $user->id)
                            ->where('defaulAdresse', '=', 1)
                            ->get();
             // dd($trouve);
            // switch adress
            $trouve->defaulAdresse  = "0";
            $trouve->save();

            $adresse->defaulAdresse  = "1";
            $adresse->save();

        } else{
            // user dont wants put as main adress
             $adresse->defaulAdresse  = "0";
             $adresse->save();
        }
         //return view('adresses.list', ['adresses' => $adresses])->with('msg','Adresse a été bien edité!');
        return response()->redirectToRoute('list-adresse')->with('msg', 'Adresse edité!');

        //dd($adresse);
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
        //Cherche un produit par son id.
        $adresse = Adresse::findOrFail($id);
        $adresse->delete();

        $user = auth()->user();
        $adresses = DB::table('adresses')
                            ->where('fk_id_user', '=', $user->id)
                            ->get();
        return view('adresses.list', ['adresses' => $adresses])->with('msg', 'Adresse supprimée avec succes');
    }
}
