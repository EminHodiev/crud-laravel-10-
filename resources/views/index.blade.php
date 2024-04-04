<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <title>Document</title>
</head>
<body>
{{--//{{$all_news}}//--}}
<table class="table table-bordered border-primary">
    <tr>
    <th>#</th>
    <th>Title</th>
    <th>Text</th>
    <th>image</th>
    </tr>
    @foreach($all_news as $news)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$news->title}}</td>
            <td>{{$news->text}}</td>
            <td>{{$news->image}}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
