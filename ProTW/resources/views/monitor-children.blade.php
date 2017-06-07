@extends('home')

@section('copii')

    <li >
        <a href="{{ route('update') }}">
            <h3>
                {{ Auth::user()->name }}
            </h3>
        </a>
    </li>

    @foreach($children as $child)
        <li>
            <a title="Name:{{$child->name}} &#010Age:{{$child->age }} &#010Gender:{{ $child->gender }}" >
                <h5>
                    {{ $child->name }}
                </h5>
            </a>
        </li>
    @endforeach

@endsection

@section('harta')

    <div class="container">

        <div id="map2">

        </div>

    </div>

@endsection








