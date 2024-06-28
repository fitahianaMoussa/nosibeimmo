<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['immobilier_id', 'image_path'];
    use HasFactory;
    
    public function immobilier()
    {
        return $this->belongsTo(Immobilier::class);
    }
}
