@extends('layouts.app')



@section('tablestyle')
<style>
    table{
    width:60%;
    height: 10em;
    position: relative;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    margin-top: 110px;
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
    <table id="notificationsTable">
        <tr>
            <th onclick="sortTable(0)">Name</th>
            <th onclick="sortTable(1)">Notification type</th>
            <th onclick="sortTable(2)">Description</th>
            <th onclick="sortTable(3)">Date</th>
            <th onclick="sortTable(4)">Location</th>
        </tr>
        <tr>
            <td>Vlad</td>
            <td>accident</td>
            <td>Vlad s-a lovit cu degetul de mouse si a intrat in fifa</td>
            <td>2017.06.07 15:45:12</td>
            <td>Iasi, Piata Unirii, Strada X, Ap y</td>
        </tr>
        <tr>
            <td>Alex</td>
            <td>distantare</td>
            <td>Alex si-a bagat picioarele si a plecat la roman ca Vlad si Petrica nu lucreaza la TW. Cel mai aproape punct de interes este fratele lui.</td>
            <td>2017.06.07 16:45:12</td>
            <td>Roman, Piata Unirii, Strada X, Ap y</td>
        </tr>
        <tr>
            <td>Petrica</td>
            <td>accident</td>
            <td>Petrica lucreaza de rupe la tw si i-a luat foc creierul</td>
            <td>2017.06.07 00:45:12</td>
            <td>Iasi, Copou, Camin Gaudeamus, Camera 518</td>
        </tr>
    </table>


@endsection