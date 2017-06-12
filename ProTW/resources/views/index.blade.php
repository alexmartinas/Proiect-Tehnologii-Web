@extends('home')

@section('copii')

    <li >
        <a href="{{ route('update') }}">
            <h4>
                &#160&#160&#160&#160&#160&#160&#160Children list
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

<style type="text/css">
    #sidenav01 h4 {
        font-weight: 900;
    }
    #sidenav01 li:first-child {
        border-bottom: 1px solid #ccc;
    }
    iframe {
        width: 100%;
        height: 100%;
    }
    @media (min-width: 768px) {
        #app .affix-content {
            /*height: 530px;*/
            height: initial;
            padding: 0;
            padding-bottom: 20px;
            overflow: hidden;
            border-left: 1px solid #ccc;
        }

        #app #mapChildren {
            height: 574px;
            width: 100%;
        }

        .sidebar-nav .navbar li a {
            transition: background-color .3s ease-in-out, color .3s ease-in-out;
        }

        .navbar.navbar-default {
            height: 682px !important;
        }
    }

</style>







