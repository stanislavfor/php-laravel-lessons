<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>

    </style>
</head>
<body>
@include('components.header')
@include('components.menu')
<div class="container">
    <h2>Список книг</h2>
    <table>
        <thead>
        <tr>
            <th>Заглавие</th>
            <th>Автор</th>
            <th>Жанр</th>
            <th>Описание</th>
            <th>Год публикации</th>
            <th>Издательство</th>
            <th>Количество страниц</th>
            <th>Обложка</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->publication_year }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->pages }}</td>
                <td>
                    @if ($book->cover)
                        <img src="{{ $book->cover }}" alt="{{ $book->title }} Cover" style="max-width: 100px;">
                    @else
                        No Cover
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('components.footer')
</body>
</html>
