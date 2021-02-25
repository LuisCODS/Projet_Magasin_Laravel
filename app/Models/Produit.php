<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;

class Produit extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_produit';

    // allow mass assignment
    protected $guarded = [];


    public function getFormatPrice()
    {
    	$prix = $this->prix;
    	return number_format($prix,2,'.',' ');
    }

    public function getCategories()
    {
        //1 to N
        return $this->hasMany(Categorie::class);
    }


}
