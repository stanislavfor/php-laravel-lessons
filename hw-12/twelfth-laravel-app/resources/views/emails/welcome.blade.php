{{-- resources/views/emails/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добро пожаловать</title>
</head>
<body>
<p>Добрый день, {{ $user->name }},</p>
<p>Спасибо за регистрацию.</p><br>
<p>Команда laravel App.</p>
</body>
</html>

