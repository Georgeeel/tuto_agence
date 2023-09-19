<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable =  [
            'title',
            'description',
            'surface',
            'rooms',
            'bedrooms',
            'floor',
            'price',
            'city',
            'address',
            'postal_code',
            'sold',
    ];

    // ça appartient à plusieurs options
    public function options():BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    // function pour génerer un slug à partir du titre
    public function getSlug():string 
    {
        return Str::slug($this->title);
    }
}
