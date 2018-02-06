<!-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{$fullname}}</h1>
    <p>
        <a href="http://www.{{$website}}">{{$website}}</a>
    </p>

</body>
</html> -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-defult">
                <div class="panel-heading">เกี่ยวกับเรา
                </div>
                    <div class="panel-body">
                        <h3>{{$fullname}}</h3>
                        <P>{{$website}}</P>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection