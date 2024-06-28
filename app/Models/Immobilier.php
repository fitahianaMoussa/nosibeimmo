<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Immobilier extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_id',
        'categorie_id',
        'titre',
        'prix',
        'surface',
        'reference',
        'description',
        'images_couverture',
        'electricite',
        'eau',
        'situation_juridique',
        'vue_sur_la_mer',
        'plage'
    ];

   
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    
}
