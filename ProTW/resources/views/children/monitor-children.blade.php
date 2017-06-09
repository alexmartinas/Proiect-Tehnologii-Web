@extends('layouts.app')

@section('content')
    <div class="col-sm-9 col-md-12 affix-content">
        <div class="page-header">
            <h3><span class="glyphicon glyphicon-map-marker"></span>&#160Search for location
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                <select class="selectpicker" multiple>
                    @foreach($children as $child)
                        <option value="{{$child->id}}"> {{$child->name}}</option>

                    @endforeach
                </select>&#160&#160&#160
                <button onclick="
                          var el = document.getElementsByTagName('select')[0];
                         alert(getSelectValues(el));">Save point
                </button>
            </h3>
        </div>

        <div class="col-sm-9 col-md-12" id="mapAddPoints">

        </div>

    </div>

@endsection
