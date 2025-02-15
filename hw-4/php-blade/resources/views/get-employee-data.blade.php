<!DOCTYPE html>
<html>

<head>
    <title>Employee Form</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>

<body>
    <div class="container">
        <h2>Заполнить данные для сотрудника</h2>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ url('store-form') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Имя (Имя Отчество)</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input type="text" id="surname" name="surname" class="form-control" value="{{ old('surname') }}" required>
            </div>
            <div class="form-group">
                <label for="position">Должность</label>
                <input type="text" id="position" name="position" class="form-control" value="{{ old('position') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Номер телефона</label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="birthdate">Дата рождения</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ old('birthdate') }}">
            </div>
            <div class="form-group">
                <label for="address">Адрес</label>
                <textarea id="address" name="address" class="form-control" required>{{ old('address') }}</textarea>
                <small>Введите адрес в текстовом формате.</small>
            </div>
            <div class="form-group">
                <label for="workData">Дополнительные данные</label>
                <textarea id="workData" name="workData" class="form-control" required>{{ old('workData') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button><a href="{{ url('store-form') }}" class="btn btn-secondary">Список</a></button>
        </form>
    </div>
</body>

</html>
