@extends('layouts.app')



@section('tablestyle')
    <style>

        .wrapper{
            width:75%;
            margin: 0 auto;
        }
        .panel, .panel-heading {
            border-top-left-radius: 0;
        }
        button {
            margin-left: -4px;
            border: none;
            padding: 5px;
            background: #3174af;
            color: #fff;
        }
        button:first-child {
            margin-left: 0;
            border-top-left-radius: 4px;
        }
        .wrapper button:nth-child(4) {
            border-top-right-radius: 4px;
        }

    </style>

    <script type="text/javascript">

        var getPHP;
        var time;
        getPHP = {!!  json_encode($x) !!};
        time = getPHP.date;
        window.setInterval(function LoadData() {
            $.get("/listnotifications",
                function (data) {
                    $.each(data, function(index, value){
                        if(time<value['happened_at'])
                        {
                            if( value['dynamic_added'] < 1) {
                                $('#notificationsTable').find('tbody')
                                    .prepend($('<tr><td>' + value['name'] +
                                        '</td><td>' + value['type'] +
                                        '</td><td> <img src="http://s3.amazonaws.com/vnn-aws-sites/10592/files/2016/09/3570ff01409ea2fe-new-480x338.jpg" style="width:50px;height:20px;"> </td><td>'
                                        + value['description'] + '</td><td>' + value['happened_at'] + '</td><td>' +
                                        ' <img src={{asset('images/googleicon.png') }} style="width:20px;height:20px;"> </td>'));
                            }
                        }
                        $.get("/setDynamic");
                    })
                });
        },3000);

    </script>
@endsection

@section('content')
    <div class="wrapper">
        <button onclick="myFunction(1)">Accidents</button>
        <button onclick="myFunction(2)">OutOfRange</button>
        <button onclick="myFunction(3)">Interactions</button>
        <button onclick="myFunction(4)">All</button>

        <section class="panel panel-primary">
            <div class="panel-heading">
                <b>Notifications Table</b>
            </div>
            <table id="notificationsTable" class="table table-hovered">
                <thead>
                <tr>
                    <th onclick="sortTable(0)">Name</th>
                    <th>Notification type</th>
                    <th>Importance</th>
                    <th onclick="sortTable(3)">Description</th>
                    <th onclick="sortTable(4)">Date</th>
                    <th>Location</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{!! $page->name !!}</td>
                        <td>{!! $page->type !!}</td>
                        <td>

                            @if (  $page->accident_type  === "1" )
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