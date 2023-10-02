<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request)
    {
        $query = Property::query()->with('pictures')->with('options');
        // si sur la requete j'ai un prix je modifie query si le prix est inferieur ou egal à mon budget demandé
        if($request->validated('price')){
            $query = $query->where('price', '<=', $request->validated('price'));
        }
        // si nous avons une surface, je souhaite une surface supérieur ou egal 
        if($surface = $request->validated('surface')){
            $query = $query->where('surface', '>=', $surface);
        }
        if($request->validated('rooms')){
            $query = $query->where('rooms', '>=', $request->input('rooms'));
        }
        if($request->validated('title')){
            $query = $query->where('title', 'like', "%{$request->input('title')}%");
        }
        return view('property.index', [
            'properties' => $query->paginate(16),
            // afficher les informations validé
            'input' => $request->validated()
        ]);
    }
    //system model binding pour pouvoir récupérer le bien
    public function show(string $slug, Property $property)
    {
        if($slug !== $property->getSlug()){
            return to_route('property.show', [
                'slug' => $property->getSlug(), 'property' => $property
            ]);
        }
        return view('property.show', [
            'property' => $property
        ]);
    }

    public function contact(Property $property, PropertyContactRequest $request)
    {
        Mail::send(new PropertyContactMail($property, $request->validated()));
        return back()->with('success', 'Votre demande de contact a bien été envoyé');
    }
}
