@extends('home')

@section('copii')

    <li >
        <h3>
            &#160&#160&#160&#160&#160Points of interest
        </h3>

    </li>

    @foreach($points as $point)
        <li>
            <a href="" >
                <h5>
                    {{ $point->name }}
                </h5>

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
