<x-mail::message>
    <!-- titre -->
# Nouvelle demande de contact
    <!-- contenu avec le lien vers le bien -->
Une nouvelle demande de contact a été fait pour le bien <a href="{{ route('property.show', [
    'slug' => $property->getSlug(), 'property' => $property]) }}">{{ $property->title }}</a>

<!-- info utilisateur/ info defini on a validé la requete-->
-Prénom : {{ $data['lastname']}}
-Nom : {{ $data['firstname'] }}
-Email : {{ $data['email'] }}
-Téléphone : {{ $data['phone'] }}

**Message** <br>
{{ $data['message'] }}

</x-mail::message>
