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
