@extends('layouts.app')

@section('content')
    <br/>
    <h1>Post {{$post->id}}</h1>
        <ul>
            <li>Device: {{$post->device->device_id}}</li>
            <li>Made at {{$post->created_at}}</li>
            <li>Where latitude {{$post->latitude}}, Longitude {{$post->longitude}}, altitude {{$post->altitude}}</li>
        </ul>
        <h2>Data</h2>
        <ul>
            @foreach ($post->payload as $item)
                <li>{{ $item->field_name }}:  {{ $item->field_value }}</li>
            @endforeach
        </ul>
        <br />

    <h2>Map</h2>
        <div id="map"></div>

            <script>

            // initialize the map

            var map = L.map('map',{
                center: [{{$post->latitude}}, {{$post->longitude}}],
                zoom: 14
            });

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                //eerst latitude dan longitude
                var marker = L.marker([{{$post->latitude}}, {{$post->longitude}}]).addTo(map);

            </script>
    <br />
@endsection