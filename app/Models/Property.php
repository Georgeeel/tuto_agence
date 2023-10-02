<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // relation entre biens et images
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }
    // upload image
    /** @param UploadedFile[]  $files */
    public function attachFilles(array $files)
    {
        foreach($files as $file){
            // si le fichier n'est pas bon je continuu
            if($file->getError()){ 
                continue;
            }
            // sinon sauvgarder l'image
            $filename = $file->store('properties/' . $this->id, 'public');
            $pictures[] = [
                "filename" => $filename
            ];
        }
        // si j'ai plusieurs image creation d'un ensemble d'image
        if(count($pictures) > 0){
            $this->pictures()->createMany($pictures);
        }
    }
    // premier image
    public function getPicture(): ?Picture
    {
        return $this->pictures[0] ?? null;
    }
}
