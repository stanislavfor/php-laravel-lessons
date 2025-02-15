<!DOCTYPE html>
<html>

<head>
    <title>Updated Data</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>

<body>
    <div class="container">
        <h2>Updated Data</h2>
        <ul>
            @foreach($data as $key => $value)
            <li><strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</li>
            @endforeach
        </ul>
        <a href="{{ url('get-employee-data') }}" class="btn btn-primary">Go Back</a>
    </div>
</body>

</html>
