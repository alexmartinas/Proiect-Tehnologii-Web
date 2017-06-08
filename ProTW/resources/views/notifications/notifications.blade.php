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
            <th onclick="sortTable(2)">Description</th>
            <th onclick="sortTable(3)">Date</th>
            <th onclick="sortTable(4)">Location</th>
        </tr>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>{!! $page->name !!}</td>
                    <td>{!! $page->type !!}</td>
                    <td>{!! $page->description !!}</td>
                    <td>{!! $page->happened_at !!}</td>
                    {{--<td>{!! $page->location !!}</td>--}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <HR>
    {!! $pages->render() !!}
    </section>
    </div>

@endsection