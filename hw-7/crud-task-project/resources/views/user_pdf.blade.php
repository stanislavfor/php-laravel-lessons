<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF User</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; } /* Поддержка кириллицы */
    </style>
</head>
<body>
<h2>Данные пользователя</h2>
<p><strong>Имя:</strong> {{ $user->name }}</p>
<p><strong>Фамилия:</strong> {{ $user->surname }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
</body>
</html>
