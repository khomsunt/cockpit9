@extends('layouts.app')

@section('content')

    <table>
        <tr>
            <td>ID</td>
            <td>NAME</td>
            <td>SHORTNAME</td>
            <td>CALCULATE</td>
            <td>SOURCE</td>
        </tr>
        @foreach ($kpis as $kpi)
        <tr>
            <td>{{ $kpi->id }}</td>
            <td>{{ $kpi->name }}</td>
            <td>{{ $kpi->name_short }}</td>
            <td>{{ $kpi->kpi_calculate_id }}</td>
            <td>{{ $kpi->kpi_source_id }}</td>
        </tr>
        @endforeach
    </table>
    @endsection
