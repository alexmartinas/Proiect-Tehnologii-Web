@extends('home')

@section('copii')

    <li >
        <a href="{{ route('update') }}">
            <h4>
                {{Auth::user()->name}}
            </h4>
        </a>
    </li>

    @foreach($children as $child)
        <li>
            <a href="/child/{{ $child->id }}" title="Name:{{$child->name}} &#010Age:{{$child->age }} &#010Gender:{{ $child->gender }}" >
                <h5>
                    {{ $child->name }}
                </h5>

            </a>
        </li>
    @endforeach

@endsection

@section('harta')

    <div class="container">

        <div id="mapChildren">

        </div>

    </div>

@endsection








