<!DOCTYPE html>
<html>
<head>
    <title>User Form page</title>
</head>
<body>
    <h2>Форма для получения информации пользователя</h2>
    <h4>Пожалуйста, укажите необходимые данные для отправки формы</h4>
    <form action="/store_form" method="POST">
        @csrf
        <div>
            <label for="first_name">Имя :</label>
            <input type="text" id="first_name" name="first_name" required>
        </div><br>
        <div>
            <label for="last_name">Фамилия :</label>
            <input type="text" id="last_name" name="last_name" required>
        </div><br>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div><br>
        <div>
            <button type="submit">Submit * </button>
            <p>* нажать submit для отправки формы</p>
        </div>
    </form>
</body>
</html>
