<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
</head>
<body>
<button><a href="{{ url('/user_form') }}" style="text-decoration: none">Add User</a></button>
<h2>Список пользователей. Все пользователи.</h2>

<ul>
    @foreach ($users as $user)
        <li>
            {{ $user->name }} {{ $user->surname }} ({{ $user->email }})
            - <a href="{{ url('/user/'.$user->id) }}">Подробнее</a>
            - <a href="{{ url('/user/'.$user->id.'/pdf') }}">Скачать PDF</a>
        </li>
    @endforeach
</ul>
</body>
</html>
