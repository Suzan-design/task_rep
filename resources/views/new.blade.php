<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
</head>
<body>
    <form action="{{route('new.post')}}">
        @csrf
        <input type="text" placeholder="Please enter the article title" />
        <textarea name="description" placeholder="Please enter the article description"></textarea>
        <button type="submit">Submit</button>
    </form>

    <h1>{{$Article->title}}</h1>
    <p>{{$Article->description}}</p>
</body>
</html>
