@extends('layouts.app')

@section('content')
    <div class="row affix-row">
        <div class="col-sm-3 col-md-2 affix-sidebar">
            <div class="sidebar-nav">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="visible-xs navbar-brand"></span>
                    </div>
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <ul class="nav navbar-nav" id="sidenav01">

                            @yield('copii')

                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-10 affix-content">
            <div class="container">
                <div class="page-header">
                    <h3><span class="glyphicon glyphicon-map-marker"></span> Location
                    </h3>
                </div>
            </div>

            @yield('harta')

        </div>
    </div>
@endsection
