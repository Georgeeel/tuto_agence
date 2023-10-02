<div class="card">
    @if($property->getPicture())
        <img src="{{ $property->getPicture()->getImageUrl(360,230) }}" alt="" class="w-100">
        @else
        <img src="/empty.jpg" alt="" class="w-100">
    @endif
    <div class="card-body">
        <h5 class="card-title">
            <!-- slug automatique avec id -->
            <a href="{{ route ('property.show', ['slug' => $property->getSlug(), 'property' => $property])}}">{{ $property->title }}</a>
        </h5>
        <p class="card-text">{{ $property->surface }} m² - {{ $property->city }} ({{$property->postal_code}})</p>
        <div class="text-primary fw-bold">
            {{ number_format($property->price, thousands_separator: ' ')}} €
        </div>
    </div>
</div>  