<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Adresse;
use DB;

class AdresseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new adresse.
     *
     * @return
     */
    public function create()
    {
        return view('adresses.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //dd($request->all());
        try{
            // Validate input filds
            $validData = $request->validate([
                'nbCivic'       => "required|regex:/^[0-9]+$/",//Only numbers
                'rue'           => "required|max:70', regex:/^ [a-zA-Z] + $/",//Only strings
                'quartie'       => 'required|max:50',
                'pays'          => 'required|max:20',
                "codePostal"    => 'required|regex:/[A-Za-z]\d[A-Za-z]?\d[A-Za-z]\d/', //H2E1X2
                "ville"         => 'required|max:20',
                //"defaulAdresse" => 'required',//|max:20',
            ]);
            //dd($validData);
        }catch(ValidationException $e){
            //dd($e);

            session()->put('errors', $e->validator->getMessageBag());
            session()->put('old', $request->input());
            session()->save();

            //return back();
            // return response()->redirectToRoute('admin.brokers.index');
        }


        $adresse = new Adresse();
        $adresse->nbCivic = trim($request->get('nbCivic'));
        $adresse->rue = trim($request->get('rue'));
        $adresse->quartie = $request->get('quartie');
        $adresse->pays = $request->get('pays');
        $adresse->codePostal = $request->get('codePostal');
        $adresse->ville = $request->get('ville');
        // $adresse->defaulAdresse = $request->get('defaulAdresse');
        //dd($adresse);
        //Get authenticated user
        $user = auth()->user();
        // $userAdresses = DB::table('adresses')
        //         ->where('fk_id_user', '=', $user->id)
        //         ->get();

        // dd(count($userAdresses));

        //Attache  relation between address and user (Set the FK)
        $adresse->fk_id_user = $user->id;

         //Save
         $adresse->save();

         //Redirect to the same page with feedback messege
         return redirect('/adresse/create')->with('msg', 'Adresse ajouté avec succes!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
