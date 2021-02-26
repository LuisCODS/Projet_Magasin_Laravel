<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Adresse;
use Illuminate\Support\Facades\DB;


class AdresseController extends Controller
{


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
        // __________________ VALIDATION  __________________
        //dd($request->all());
        try{
            // Validate input filds
            $validData = $request->validate([
               'nbCivic'        => "required|regex:/^[0-9]{1,8}$/",//Only numbers 1 à 8 caractères
                'rue'           => "bail|required|max:100| regex:/^[A-Za-z\s]+$/",  //Only strings + space
                'quartie'       => "bail|required|max:100| regex:/^[A-Za-z\s]+$/",  //Only strings + space
                'pays'          => "bail|required|max:50|  regex:/^[A-Za-z\s]+$/",  //Only strings + space
                "codePostal"    => 'bail|required|max:7|   regex:/^[A-Za-z]\d[A-Za-z][-]\d[A-Za-z]\d/', //H2E-1X2
                "ville"         => "bail|required|max:50|  regex:/^[A-Za-z\s]+$/",  //Only strings + space
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

        // __________________ CREATE INSTANCE __________________
        $adresse = new Adresse();
        $adresse->nbCivic          = trim($request->get('nbCivic'));
        $adresse->rue              = trim($request->get('rue'));
        $adresse->quartie          = trim($request->get('quartie'));
        $adresse->pays             = trim($request->get('pays'));
        $adresse->codePostal       = trim($request->get('codePostal'));
        $adresse->ville            = trim($request->get('ville'));

        // get courent user
        $user = auth()->user();
        // user wants set a main adress
        if ($request->get('defaulAdresse') == "checked" ) {

            //Chek if aready exist a default adress
            //query type Eloquent: https://laravel.com/docs/8.x/eloquent#inserting-and-updating-models
            $trouve = DB::table('adresses')
                                ->where('fk_id_user','=', $user->id)
                                ->where('defaulAdresse','=', 1)
                                ->get();
            //dd(count($trouve));

            // switch adress...
            if (count($trouve) != 0) {
                // get the old
                $adressOld = Adresse::findOrFail($trouve[0]->id);
                $adressOld->defaulAdresse  = "0";
                $adressOld->save();
                // put the new
                $adresse->defaulAdresse  = "1";
            }else {
              $adresse->defaulAdresse  = "1";
            }
        } else{
            // user dont wants put a main adress
             $adresse->defaulAdresse  = "0"; //not main
        }
        // attache relation between user and adress: set FK
        $adresse->fk_id_user = $user->id;
        // save new adress
        $adresse->save();
        // dd($adresse);
        return response()->redirectToRoute('save-adresse',['adresse' => $adresse])->with('msg', 'Adresse a été bien ajouté!');

    }// fin methode


    // Retourne une vue avec tous les informations courrantes de l'Adresse à editer
     public function edit($id)
     {
        $adresse = Adresse::findOrFail($id);
        return view('adresses.edit',['adresse' => $adresse]);
     }

    // Recoit les nouveaux donnés à mettre à jous
    public function update(Request $request, $id)
    {
        // __________________ VALIDATION  __________________
        //dd($request->all());
        try{
            // Validate input filds
            $validData = $request->validate([
               'nbCivic'        => "required|regex:/^[0-9]{1,8}$/",//Only numbers 1 à 8 caractères
                'rue'           => "bail|required|max:100| regex:/^[A-Za-z\s]+$/",  //Only strings + space
                'quartie'       => "bail|required|max:100| regex:/^[A-Za-z\s]+$/",  //Only strings + space
                'pays'          => "bail|required|max:50|  regex:/^[A-Za-z\s]+$/",  //Only strings + space
                "codePostal"    => 'bail|required|max:7|   regex:/^[A-Za-z]\d[A-Za-z][-]\d[A-Za-z]\d/', //H2E-1X2
                "ville"         => "bail|required|max:50|  regex:/^[A-Za-z\s]+$/",  //Only strings + space
            ]);
            //dd($validData);
        }catch(ValidationException $e){

            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();
            return back();
            // return response()->redirectToRoute('admin.brokers.index');
        }

        // get adress by ID
        $adresse = Adresse::findOrFail($id);
        // update dates...
        $adresse->nbCivic     = trim($request->get('nbCivic'));
        $adresse->rue         = trim($request->get('rue'));
        $adresse->quartie     = trim($request->get('quartie'));
        $adresse->pays        = trim($request->get('pays'));
        $adresse->codePostal  = trim($request->get('codePostal'));
        $adresse->ville       = trim($request->get('ville'));


        // user wants set a main adress
        if ($request->get('defaulAdresse') == "checked" ) {

            // get courent user
            $user = auth()->user();

            //Chek if aready exist a default adress
            //query type Eloquent: https://laravel.com/docs/8.x/eloquent#inserting-and-updating-models
            $trouve = DB::table('adresses')
                                ->where('fk_id_user','=', $user->id)
                                ->where('defaulAdresse','=', 1)
                                ->get();
            //dd(count($trouve));

            // switch adress...
            if (count($trouve) != 0) {
                // get the old
                $oldAdress = Adresse::findOrFail($trouve[0]->id);
                $oldAdress->defaulAdresse  = "0";
                $oldAdress->save();
                // put the new
                $adresse->defaulAdresse  = "1";
            }else {
                // set as default adress
              $adresse->defaulAdresse  = "1";
            }
        } else{
            // user dont wants set a main adress
             $adresse->defaulAdresse  = "0"; //not main
        }

        $adresse->save();
         //return view('adresses.list', ['adresses' => $adresses])->with('msg','Adresse a été bien edité!');
        return response()->redirectToRoute('list-adresse')->with('msg', 'Adresse edité avec sucess!');
    }

    public function list()
    {
        // Get auth user
        $user = auth()->user();
        $adresses = DB::table('adresses')
                            ->where('fk_id_user', '=', $user->id)
                            ->get();
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
      //  return view('adresses.list', ['adresses' => $adresses])->with('msg', 'Adresse supprimée avec succes');
        return response()->redirectToRoute('list-adresse',['adresses' => $adresses])->with('msg', 'Adresse supprimée avec succes');

    }
}
