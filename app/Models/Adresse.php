<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;



// ================= METHODES =================

	/**
	* Return à quel user appartient l'adresses.
	*/
	public function user()
	{
		// 1 to 1
		return $this->belongsTo('App\Models\User');
	}


	// public function userAdresse()
	// {
	// 	return $this->belongsToMany('App\Models\User');
	// }


}
