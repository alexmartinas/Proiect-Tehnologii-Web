@extends('home')

@section('copii')

    <li>
        <a name="idCopil" id="{{$child->id}}" href="#" onclick="init()" >
            <h3>
                &#160&#160&#160&#160Points of interest
            </h3>
        </a>
    </li>
    @foreach($points as $point)
        <li id="{{$point->id}}" style="visibility: visible" >
            <a href="#" title="{{$point->name}}" >
                <h5 >&#160<span class="glyphicon glyphicon-remove-circle" onclick="deletePoint({{$point->id}})"></span>
                    &#160&#160&#160 {{ $point->name }}
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

@section('geofence')
    &#160&#160&#160<select class="selectpicker" multiple>
        @foreach($points as $point)
            <option value="{{$point->id}}"> {{$point->name}}</option>

        @endforeach
    </select>&#160&#160
    &#160&#160&#160<input id="distanta" type="number"  min="0" placeholder="Insert area size in meters" >&#160&#160&#160
    <button onclick="
                          var el = document.getElementsByTagName('select')[0];
                         alert(geofences(el));">Set geofence
    </button>

@endsection

<style type="text/css">
    .panel.panel-default {
        background-color: rgba(255, 255, 255, 0.7)
    }
    @media (min-width:769px) {
        #app #mapAddPoints {
            width: 100%;
            height: 586px;
        }
    }
</style>