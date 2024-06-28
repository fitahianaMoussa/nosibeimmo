<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['categorie_id', 'nom'];
    use HasFactory;
    

    public function category()
    {
        return $this->belongsTo(Category::class,'categorie_id');
    }

    public function immobiliers()
    {
        return $this->hasMany(Immobilier::class);
    }
}
