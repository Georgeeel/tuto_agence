<?php

namespace App\Models;

use PhpParser\BuilderFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\Glide\Urls\UrlBuilderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];

    // supprimer l'image dossier storage
    protected static function booted():void
    {
        static::deleting(function(Picture $picture){
            Storage::disk('public')->delete($picture->filename);
        });
    }

    // function pour récuperer l'url d'image comme param largeur et hauteur null par default
    public function getImageUrl(?int $width = null, ?int $height = null): string
    {
        // si l'image est null => l'image original
        if($width == null) {
            return Storage::disk('public')->url($this->filename);
        }
        // urlbuilderFactory class propre à Glide pour generer une url
        $urlBuilder = UrlBuilderFactory::create('/images/', config('glide.key'));
        return $urlBuilder->getUrl($this->filename, ['w' => $width, 'h' => $height, 'fit' => 'crop']);
    }

   
}
