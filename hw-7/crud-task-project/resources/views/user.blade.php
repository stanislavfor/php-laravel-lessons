<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
</head>
<body>
<button><a href="{{ url('/users') }}" style="text-decoration: none">to Users List</a></button>
<h2>Сведения о пользователе с id {{ $user->id }}</h2>
<p><strong>Имя:</strong> {{ $user->name }}</p>
<p><strong>Фамилия:</strong> {{ $user->surname }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<br>
<button><a href="{{ url('/user/'.$user->id.'/pdf') }}" style="text-decoration: none">Скачать PDF</a></button>
</body>
</html>
