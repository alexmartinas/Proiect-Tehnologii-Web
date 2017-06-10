@extends('layouts.app')



@section('tablestyle')
    <style>

        .wrapper{
            width:75%;
            margin: 0 auto;
        }

    </style>
@endsection

@section('content')
    <div class="wrapper">
        <section class="panel panel-primary">
            <div class="panel-heading">
                <b>Notifications Table</b>
            </div>
            <table id="notificationsTable" class="table table-hoverd">
                <tr>
                    <th onclick="sortTable(0)">Name</th>
                    <th onclick="sortTable(1)">Notification type</th>
                    <th>Importance</th>
                    <th onclick="sortTable(2)">Description</th>
                    <th onclick="sortTable(3)">Date</th>
                    <th onclick="sortTable(4)">Location</th>
                </tr>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{!! $page->name !!}</td>
                        <td>{!! $page->type !!}</td>
                        <td>

                            @if (  $page->accident_type  == "1" )
                                <img src={{asset('images/warning.jpg') }} style="width:25px;height:25px;">
                            @elseif ( $page->accident_type === "2" )
                                <img src={{asset('images/warningyellow.jpg') }} style="width:20px;height:20px;">
                            @else
                                <img src={{asset('images/notification.png') }} style="width:20px;height:20px;">
                            @endif

                        </td>
                        <td>{!! $page->description !!}</td>
                        <td>{!! $page->happened_at !!}</td>
                        <td>
                            <a href="#"
                               onClick="window.open('http://www.google.com/maps/place/{{ $page->location_x }},{{ $page->location_y }}','Accident Location','resizable,height=500,width=500')"
                            >
                                <img src={{asset('images/googleicon.png') }} style="width:20px;height:20px;">
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <HR>
            {!! $pages->render() !!}
        </section>
    </div>

@endsection