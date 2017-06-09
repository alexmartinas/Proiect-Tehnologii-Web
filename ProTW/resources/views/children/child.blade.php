@extends('home')

@section('copii')

    <a name="idCopil" id="{{$child->id}}" link="#" onclick="init()" >
        <h3>
            &#160&#160&#160&#160&#160Points of interest
        </h3>

    </a>

    @foreach($points as $point)
        <li>
            <a href="#">
                <h5>
                    {{ $point->name }}
                </h5>

            </a>
        </li>
    @endforeach

@endsection

@section('harta')

    <div class="container">

        <div id="mapPoints">

        </div>

    </div>

@endsection
