<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;//ORM do Laravel

class Categorie extends Model
{
    use HasFactory;

    // allow mass assignment
    protected $guarded = [];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_categorie';


    // public $timestamps = false; //allow to be update


    //    protected $fillable = [
    //     'nomCategorie'
    // ];
}
