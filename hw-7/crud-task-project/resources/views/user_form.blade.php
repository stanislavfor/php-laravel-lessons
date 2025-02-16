<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
<button><a href="{{ url('/users') }}" style="text-decoration: none">to Users List</a></button>
<h2>Добавить пользователя</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form action="{{ url('/store-user') }}" method="POST">
    @csrf
    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" required maxlength="50"><br>

    <label for="surname">Фамилия:</label>
    <input type="text" id="surname" name="surname" required maxlength="50"><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <br>
    <button type="submit">Добавить</button>
</form>
</body>
</html>

