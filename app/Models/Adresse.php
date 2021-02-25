<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $guarded = [];


	/**
	* Return à qui appartient l'adresse.
	*/
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
