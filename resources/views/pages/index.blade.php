@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome to MY CITY</h1>
    <div id="map"></div>

    <script>

        // initialize the map

        var map = L.map('map',{
            center: [52.006946, 4.735629],
            zoom: 13
        });

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    </script>
        @foreach($posts as $post)
        <script>
            var marker = L.marker([{{$post->latitude}}, {{$post->longitude}}]).addTo(map)
                .bindPopup('{{$post->device->device_id}}')
                .openPopup();
        </script>
@endforeach

@endsection