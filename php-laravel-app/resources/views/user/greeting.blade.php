<!DOCTYPE html>
<html>
<head>
    <title>Greeting</title>
</head>
<body>
    <h1>Привет, {{ $firstName }}!</h1>
    <p>Мы получили ваши данные :</p>
    <ul>
        <li>Имя : {{ $firstName }}</li>
        <li>Фамилия : {{ $lastName }}</li>
        <li>Email : {{ $email }}</li>
    </ul>
</body>
</html>
