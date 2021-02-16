<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class HomeController extends Controller
{
    /**
     * Display home page.
     *
     * @return Home page
     */
    public function welcome()
    {
        //Get auth user
        // $user = auth()->user();

        // /*get its id*/
        // $users = User::where([
        //     ['id','like',$user->id]
        // ])->get();

        //dd($user);

       // return view('welcome',['user'=>$user]);
        return view('welcome');
    }

    /**
     * Display caontac page.
     *
     * @return contact page
     */
    public function contact()
    {
        return view('contact');
    }

}
