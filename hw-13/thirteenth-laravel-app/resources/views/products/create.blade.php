@extends('layouts.app')
@section('title','Create Product')

@section('content')
    <style>
        .btn{display:inline-block;padding:10px 16px;border-radius:8px;border:1px solid transparent;text-decoration:none;cursor:pointer;line-height:1.2}
        .btn:focus{outline:2px solid #93c5fd;outline-offset:2px}
        .btn-primary{background:#2563eb;color:#fff;border-color:#2563eb}
        .btn-primary:hover{background:#1d4ed8}
        .btn-secondary{background:#fff;color:#2563eb;border-color:#2563eb}
        .btn-secondary:hover{background:#eff6ff}
        .form-field{display:flex;flex-direction:column;gap:6px;margin-bottom:14px}
        .form-field input{border:1px solid #e5e7eb;border-radius:8px;padding:10px 12px}
        .error{color:#b91c1c;font-size:14px;margin-top:6px}
        .notice{font-size:14px;color:#374151;margin:8px 0}
        .container{max-width:1024px;margin:0 auto}
    </style>

    <div class="container px-4 py-6">
        <h1 class="page-title text-2xl font-bold mb-4" style="margin-top:50px;">Добавить продукт</h1>

        <div id="msg" class="notice"></div>

        <form id="createForm" class="max-w-xl">
            <div class="form-field">
                <label for="sku">SKU</label>
                <input id="sku" name="sku" type="text" placeholder="SKU-1234" required>
                <div class="error" data-err="sku"></div>
            </div>

            <div class="form-field">
                <label for="name">Название</label>
                <input id="name" name="name" type="text" placeholder="Название товара" required>
                <div class="error" data-err="name"></div>
            </div>

            <div class="form-field">
                <label for="price">Цена (3 знака после запятой)</label>
                <input id="price" name="price" type="number" step="0.001" min="0" placeholder="222.000" required>
                <div class="error" data-err="price"></div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('products.page') }}" class="btn btn-secondary">Назад к списку</a>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('createForm');
        const msg  = document.getElementById('msg');

        function showErrors(errors) {
            document.querySelectorAll('.error').forEach(e => e.textContent = '');
            if (!errors) return;
            Object.entries(errors).forEach(([key, arr]) => {
                const box = document.querySelector(`.error[data-err="${key}"]`);
                if (box) box.textContent = Array.isArray(arr) ? arr.join(', ') : String(arr);
            });
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            showErrors(null);
            msg.textContent = '';

            const payload = {
                sku:   form.sku.value.trim(),
                name:  form.name.value.trim(),
                price: form.price.value.trim()
            };

            try {
                const res = await fetch('/api/products', {
                    method: 'POST',
                    headers: { 'Accept':'application/json', 'Content-Type':'application/json' },
                    body: JSON.stringify(payload)
                });

                if (!res.ok) {
                    const data = await res.json().catch(() => ({}));
                    if (data.errors) showErrors(data.errors);
                    msg.textContent = data.message || 'Ошибка сохранения';
                    return;
                }

                const created = await res.json(); // вернётся продукт
                window.location.href = `/products/${created.id}`; // на страницу просмотра
            } catch (err) {
                msg.textContent = 'Сеть/сервер недоступен';
                console.error(err);
            }
        });
    </script>
@endsection
