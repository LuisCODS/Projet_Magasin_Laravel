<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_facture';
}
