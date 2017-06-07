@extends('layouts.app')



@section('tablestyle')
<style>
    table {
    width:60%;
    height: 10em;
    position: absolute;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
    }
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
    th, td {
    padding: 5px;
    text-align: left;
    }
    table tr:nth-child(even) {
    background-color: #eee;
    }
    table tr:nth-child(odd) {
    background-color:#fff;
    }
    table th {
    background-color: black;
    color: white;
    }
</style>
@endsection

@section('content')
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Notification type</th>
            <th>Date</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Smith</td>
            <td>accident</td>
            <td>2017.01.01 22:45:12</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jackson</td>
            <td>atac</td>
            <td>2017.01.01</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Doe</td>
            <td>accident</td>
            <td>2017.01.01</td>
        </tr>
    </table>

@endsection