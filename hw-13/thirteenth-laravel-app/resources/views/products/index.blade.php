{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

{{-- Заголовок страницы (если используется в лэйауте) --}}
@section('title', 'Products')

{{-- Fallback-переменные: если шаблон случайно отрендерили без нужных значений,
     подхватим их из query-параметров, чтобы избежать Undefined variable. --}}
@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection $products */
    $q    = $q    ?? request()->query('q', '');
    $sort = $sort ?? request()->query('sort', 'id');       // id|name|price|created_at
    $dir  = $dir  ?? request()->query('dir', 'desc');      // asc|desc
@endphp

@section('content')
    {{-- Локальные стили таблицы: ширины столбцов и переносы --}}
    <style>

        /* Отступ над заголовком и ширина строки поиска */
        .page-title { margin-top: 50px; }
        .search-row { width: 100%; }                 /* форма по ширине таблицы */
        .search-row input[type="text"] {
            width: 100%;
            max-width: none;                           /* убираем ограничение  max-w-md */
        }

        /* Стили кнопок (видны без Tailwind) */
        .btn{display:inline-block; padding:10px 16px; border-radius:8px; border:1px solid transparent; text-decoration:none; cursor:pointer; line-height:1.2}
        .btn:focus{outline:2px solid #93c5fd; outline-offset:2px}

        /* Основная (синяя) */
        .btn-primary{background:#2563eb; color:#fff; border-color:#2563eb}
        .btn-primary:hover{background:#1d4ed8}

        /* Вторичная (белая с синей рамкой) */
        .btn-secondary{background:#fff; color:#2563eb; border-color:#2563eb}
        .btn-secondary:hover{background:#eff6ff}


        /* Общие настройки таблицы */
        .table-products { width: 100%; border-collapse: collapse; table-layout: auto; }
        .table-products th, .table-products td { padding: 10px 12px; vertical-align: top; }

        /* Контроль ширины и переносов для читаемости */
        .col-id      { width: 72px;  white-space: nowrap; text-align: center; }
        .col-sku     { min-width: 160px; word-break: break-word; } /* SKU может быть длинным */
        .col-name    { min-width: 320px; }                         /* основной растягиваемый столбец */
        .col-price   { width: 120px; white-space: nowrap; text-align: right; }
        .col-created { width: 180px; white-space: nowrap; }

        /* Обёртка для горизонтального скролла на узких экранах */
        .table-wrap { overflow-x: auto; }
    </style>

    <div class="container mx-auto px-4 py-6">
        <h1 class="page-title text-2xl font-bold mb-4"><strong>Список Products</strong></h1>

        {{-- Форма поиска: работаем через веб-маршрут products.page (не API) --}}
        <form method="GET" action="{{ route('products.page') }}" class="search-row mb-4 flex gap-2 items-center">
        <input
                type="text"
                name="q"
                value="{{ $q }}"
                placeholder="Поиск по name / sku"
                class="border rounded px-3 py-2 w-full max-w-md"
            >
            <button type="submit" class="btn btn-primary">Искать</button>
            @if($q !== '')
                <a href="{{ route('products.page') }}" class="btn btn-secondary">Сброс</a>
            @endif

        </form>

        {{-- Короткая сводка (если есть пагинация) --}}
        @if(method_exists($products, 'total'))
            <div class="text-sm text-gray-600 mb-2">
                Показано {{ $products->count() }} из {{ $products->total() }} записей
                (страница {{ $products->currentPage() }} из {{ $products->lastPage() }}).
            </div>
        @endif

        {{-- Таблица со стабильной шириной столбцов и кликабельными заголовками для сортировки --}}
        <div class="overflow-x-auto border rounded table-wrap">
            <table class="min-w-full border-collapse table-products">
                <thead>
                <tr class="bg-gray-100">
                    @php
                        // ключ => [Заголовок, CSS-класс столбца]
                        $cols = [
                            'id'         => ['ID', 'col-id'],
                            'sku'        => ['SKU', 'col-sku'],
                            'name'       => ['Название (name)', 'col-name'],
                            'price'      => ['Цена', 'col-price'],
                            'created_at' => ['Создан', 'col-created'],
                        ];
                    @endphp

                    @foreach($cols as $key => [$label, $colClass])
                        @php
                            $nextDir = ($sort === $key && $dir === 'asc') ? 'desc' : 'asc';
                            // Сохраняем текущие query-параметры (поиск/страница) + меняем только sort/dir
                            $link = route('products.page', array_merge(request()->query(), [
                                'sort' => $key,
                                'dir'  => $nextDir,
                            ]));
                        @endphp
                        <th class="border px-3 py-2 text-left whitespace-nowrap {{ $colClass }}">
                            <a href="{{ $link }}" class="hover:underline" title="Сортировать по «{{ $label }}»">
                                {{ $label }}
                                @if($sort === $key)
                                    <span class="text-xs opacity-70">({{ $dir }})</span>
                                @endif
                            </a>
                        </th>
                    @endforeach
                    <th class="border px-3 py-2 text-left whitespace-nowrap">Действия</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($products as $p)
                    <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                        <td class="border px-3 py-2 text-center col-id">{{ $p->id }}</td>
                        <td class="border px-3 py-2 col-sku">{{ $p->sku }}</td>
                        <td class="border px-3 py-2 col-name">{{ $p->name }}</td>
                        <td class="border px-3 py-2 col-price">
                            {{ number_format((float)$p->price, 3, '.', ' ') }}
                        </td>
                        <td class="border px-3 py-2 col-created">
                            {{ optional($p->created_at)->format('Y-m-d H:i') }}
                        </td>
                        <td class="border px-3 py-2 whitespace-nowrap">
                            <a href="{{ route('products.show.page', $p) }}" class="btn btn-secondary">Show</a>
                            <a href="{{ route('products.edit.page', $p) }}" class="btn btn-primary">Edit P</a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-3 py-6 text-center text-gray-500">
                            Нет данных
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Пагинация. В контроллере используется withQueryString(), параметры сохраняются. --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
