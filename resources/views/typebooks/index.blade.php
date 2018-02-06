@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">แสดงข้อมูลประเภทหนังสือ [ทั้ง หมด {{ $count }} รายการ]</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <th>รหัส</th>
                                <th>ประเภทหนังสือ</th>
                                <th>เครื่งองมือ</th>
                            </tr>
                            @foreach ($typebooks as $typebook)
                            <tr>
                                <td>{{ $typebook->id }}</td>
                                <td>{{ $typebook->name }}</td>
                                <td><a href="{{ url('/typebooks/destroy/'.$typebook->id) }}">ลบ</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection