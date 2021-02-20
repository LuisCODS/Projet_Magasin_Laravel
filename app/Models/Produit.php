<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;

class Produit extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produit';
//
    // atributos podem ser atribuídos em massa,
    protected $guarded = [];


    public function getFormatPrice()
    {
    	$prix = $this->prix;
    	return number_format($prix,2, ',', ' ')." $";
    }

    public function getCategories()
    {
        //1 to N
        return $this->hasMany(Categorie::class);
    }


}
