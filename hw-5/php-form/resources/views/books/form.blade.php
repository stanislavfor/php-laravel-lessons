<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Form</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style></style>
</head>
<body>
@include('components.header')
@include('components.menu')
<div class="container">
    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="add-books__form-wrapper">
        <form name="add-new-book" id="add-new-book" method="post" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-section">
                <label for="title">Заглавие</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-section">
                <label for="author">Автор</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-section">
                <label for="genre">Выберите жанр:</label>
                <select name="genre" id="genre" required>
                    <option value="fantasy">Fantasy</option>
                    <option value="sci-fi">Sci-Fi</option>
                    <option value="mystery">Mystery</option>
                    <option value="drama">Drama</option>
                    <option value="romance">Romance</option>
                    <option value="thriller">Thriller</option>
                    <option value="non-fiction">Non-Fiction</option>
                    <option value="fiction">Fiction</option>
                    <option value="classics">Classics</option>
                    <option value="novel">Novel</option>
                </select>
            </div>
            <div class="form-section">
                <label for="description">Описание</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-section">
                <label for="publication_year">Год публикации</label>
                <input type="number" id="publication_year" name="publication_year" required>
            </div>
            <div class="form-section">
                <label for="publisher">Издательство</label>
                <input type="text" id="publisher" name="publisher" required>
            </div>
            <div class="form-section">
                <label for="pages">Количество страниц</label>
                <input type="number" id="pages" name="pages" required>
            </div>
            <div class="form-section">
                <label for="cover">Обложка книги</label>
                <input type="file" id="cover" name="cover" accept="image/*">
            </div>
            <button type="submit" class="btn-primary">Submit</button>
        </form>
    </div>
</div>
@include('components.footer')
</body>
</html>
