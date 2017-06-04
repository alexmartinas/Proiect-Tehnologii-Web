@extends('home')

@section('copii')

    @foreach($children as $child)
        <li>
            <a>
                {{ $child->name }}
            </a>
        </li>
    @endforeach

@endsection

@section('harta')

    <div class="container">

        <div id="map">

        </div>

    </div>

@endsection








