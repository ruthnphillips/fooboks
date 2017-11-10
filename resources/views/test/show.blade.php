<!DOCTYPE html>
<html>
<head>
    <title>
        Display Countries
    </title>
</head>
<body>
    @foreach ($countries as $name)
        <ul>
            <li>{{$name}} </li>
        </ul>
    @endforeach
</body>
</html>
