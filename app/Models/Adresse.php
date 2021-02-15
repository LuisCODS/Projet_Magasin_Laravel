<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;



// ================= METHODES =================

	/**
	* Return à qui appartient l'adresses.
	*	(Un adresse appartient à un utilisateur)
	*/
	// public function user()
	// {
	// 	// 1 to 1
	// 	return $this->belongsTo('App\Models\User');
	// }


}
