<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Query all user
        $users = User::all();
        //dd($users);
        return view('users.list',['users' => $users]);
    }



    // public function destroy($id)
    // {
    //     Auth::user()->delete($statusId);
    // }



}
