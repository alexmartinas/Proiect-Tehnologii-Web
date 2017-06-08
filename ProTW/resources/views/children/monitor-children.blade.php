@extends('layouts.app')

@section('content')
    <div class="col-sm-9 col-md-12 affix-content">
        <div class="page-header">
            <h3><span class="glyphicon glyphicon-map-marker"></span>&#160Search for location
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">
            </h3>
        </div>

        <div class="col-sm-9 col-md-12" id="map2">

        </div>

    </div>

@endsection
