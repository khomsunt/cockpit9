
@extends('layouts.app')

@section('content')
        <!-- Main Application (Can be VueJS or other JS framework) -->
        <div class="app">
            <center>
                {!! $chart->html() !!}
                <hr>
                {!! $chart_donut->html() !!}
                <hr>
                {!! $chart2->html() !!}
                <hr>
                {!! $chart_line->html() !!}
                <hr>
                {!! $areaspline->html() !!}
                <hr>
                {!! $chart_mul->render() !!}
            </center>
        </div>
        <!-- End Of Main Application -->
        {!! Charts::scripts() !!}
        {!! $chart->script() !!}
        {!! $chart_donut->script() !!}
        {!! $chart2->script() !!}
        {!! $areaspline->script() !!}
        {!! $chart_line->script() !!}
@endsection