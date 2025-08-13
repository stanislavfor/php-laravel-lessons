@extends('layouts.app')
@section('title','Product')

@section('content')
    <style>
        .btn{display:inline-block;padding:10px 16px;border-radius:8px;border:1px solid transparent;text-decoration:none;cursor:pointer;line-height:1.2}
        .btn:focus{outline:2px solid #93c5fd;outline-offset:2px}
        .btn-primary{background:#2563eb;color:#fff;border-color:#2563eb}
        .btn-primary:hover{background:#1d4ed8}
        .btn-secondary{background:#fff;color:#2563eb;border-color:#2563eb}
        .btn-secondary:hover{background:#eff6ff}
        .btn-danger{background:#ef4444;color:#fff;border-color:#ef4444}
        .btn-danger:hover{background:#dc2626}
        .row{display:flex;gap:10px;margin-bottom:8px}
        .label{width:140px;color:#6b7280}
        .value{font-weight:500}
        .notice{font-size:14px;color:#374151;margin:8px 0}
        .container{max-width:1024px;margin:0 auto}
    </style>

    <div class="container px-4 py-6">
        <h1 class="page-title text-2xl font-bold mb-4" style="margin-top:50px;">Товар #{{ $product->id }}</h1>

        <div class="notice" id="msg"></div>

        <div class="card" style="border:1px solid #e5e7eb;border-radius:12px;padding:16px;margin-bottom:16px;">
            <div class="row"><div class="label">SKU</div><div class="value">{{ $product->sku }}</div></div>
            <div class="row"><div class="label">Название</div><div class="value">{{ $product->name }}</div></div>
            <div class="row"><div class="label">Цена</div><div class="value">{{ number_format((float)$product->price, 3, '.', ' ') }}</div></div>
            <div class="row"><div class="label">Создан</div><div class="value">{{ optional($product->created_at)->format('Y-m-d H:i') }}</div></div>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('products.edit.page', $product) }}" class="btn btn-primary">Редактировать</a>
            <button id="deleteBtn" class="btn btn-danger">Удалить</button>
            <a href="{{ route('products.page') }}" class="btn btn-secondary">К списку</a>
        </div>
    </div>

    <script>
        const deleteBtn = document.getElementById('deleteBtn');
        const msg = document.getElementById('msg');

        deleteBtn.addEventListener('click', async () => {
            if (!confirm('Удалить товар без возможности восстановления?')) return;

            try {
                const res = await fetch('/api/products/{{ $product->id }}', {
                    method: 'DELETE',
                    headers: { 'Accept':'application/json' }
                });

                if (res.status === 204 || res.ok) {
                    window.location.href = '{{ route('products.page') }}';
                    return;
                }

                const data = await res.json().catch(() => ({}));
                msg.textContent = data.message || 'Не удалось удалить';
            } catch (err) {
                msg.textContent = 'Сеть/сервер недоступен';
                console.error(err);
            }
        });
    </script>
@endsection
