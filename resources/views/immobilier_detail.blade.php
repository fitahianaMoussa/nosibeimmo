@extends('filament::layouts.app')

@section('content') 
    <div>
        <h1>{{ $record->titre }}</h1>
        <p>Prix: {{ $record->prix }}</p>
        <p>Surface: {{ $record->surface }}</p>
        <p>Description: {!! $record->description !!}</p>
        <p>Electricité: {{ $record->electricite ? 'Oui' : 'Non' }}</p>
        <p>Eau: {{ $record->eau ? 'Oui' : 'Non' }}</p>
        <p>Situation Juridique: {{ $record->situation_juridique }}</p>
        <p>Vue sur la Mer: {{ $record->vue_sur_la_mer ? 'Oui' : 'Non' }}</p>
        <p>Plage: {{ $record->plage ? 'Oui' : 'Non' }}</p>

        <h2>Images de Couverture:</h2>
        @foreach($record->images_couverture as $image)
            <img src="{{ asset($image->image_path) }}" alt="Image de couverture">
        @endforeach

        <h2>Autres Images:</h2>
        @foreach($record->images as $image)
            <img src="{{ asset($image->image_path) }}" alt="Image">
        @endforeach
    </div>
@endsection
