<!DOCTYPE html>
<html>

<head>
    <title>Stored Data</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>

<body>
    <div class="container">
        <button style="margin-left: 19px"><a href="{{ url('get-employee-data') }}" class="btn btn-secondary">Go Back</a></button>
        <h2>Список сотрудников</h2>
        <form>
            <ul> @foreach($employees as $employee)
                <li> <strong>ID:</strong> {{ $employee['id'] }}
                    <br> <strong>Ф.И.О.:</strong> {{ $employee['name'] }} {{ $employee['surname'] }}
                    <br> <strong>Должность:</strong> {{ $employee['position'] }}
                    <br> <strong>Email:</strong> {{ $employee['email'] }}
                    <br> <strong>Номер телефона:</strong> {{ $employee['phone'] }}
                    <br> <strong>Адрес:</strong> {{ $employee['address']['fullAddress'] }}
                    <br> <strong>Дата рождения:</strong> {{ $employee['birthdate'] }}
                    <br> <strong>Дополнительные данные:</strong> {{ $employee['workData'] }}
                </li>
                <hr> @endforeach
            </ul>
            <button><a href="{{ url('get-employee-data') }}" class="btn btn-secondary">Go Back</a></button>
        </form>
        <br>
    </div>
</body>

</html>
