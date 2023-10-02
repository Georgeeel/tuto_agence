<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Signatures\SignatureFactory;

class ImageController extends Controller
{
    public function show(Request $request, string $path)
    {   
        //function Glide / je cherche l'index key dans le fichier glide et valider la requete
        SignatureFactory::create(config('glide.key'))->validateRequest($request->path(), $request->all());
        // function ServerFactory propre a Glide 
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory($request),
            // driver ou il trouve l'images
            'source' => Storage::disk('public')->getDriver(),
            // driver ou il sauvgarder l'images une fois redimensionée
            'cache' => Storage::disk('public')->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'images'
        ]);
        return $server->getImageResponse($path, $request->all());
    }
}
