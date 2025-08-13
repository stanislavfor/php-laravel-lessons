<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Vite стандарт в свежем Laravel --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Небольшие дефолтные стили на случай отсутствия Tailwind --}}
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }
        .container { max-width: 1024px; margin: 0 auto; }
    </style>
    <style>
        /* ==== Базовые стили (без Tailwind) ==== */
        :root{
            --c-border:#e5e7eb; --c-text:#111827; --c-muted:#6b7280;
            --c-brand:#2563eb; --c-brand-d:#1d4ed8; --c-bg:#ffffff;
        }
        html,body{margin:0;padding:0;background:var(--c-bg);color:var(--c-text);
            font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif}
        .container{max-width:1024px;margin:0 auto}

        /* ==== Header ==== */
        .site-header{position:sticky;top:0;z-index:10;background:#fff;border-bottom:1px solid var(--c-border)}
        .site-header__inner{display:flex;align-items:center;justify-content:space-between;gap:16px;
            padding:12px 16px;max-width:1024px;margin:0 auto}
        .brand{font-weight:700;text-decoration:none;color:var(--c-text)}
        .nav{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
        .nav__link{display:inline-block;padding:8px 12px;border-radius:8px;text-decoration:none;border:1px solid transparent;
            color:var(--c-text)}
        .nav__link:hover{background:#f3f4f6}
        .nav__link.is-active{border-color:var(--c-border);background:#f9fafb}

        /* ==== Footer ==== */
        .site-footer{margin-top:40px;border-top:1px solid var(--c-border);background:#fff}
        .site-footer__inner{display:flex;align-items:center;justify-content:space-between;gap:12px;
            padding:16px;max-width:1024px;margin:0 auto;color:var(--c-muted);font-size:14px}
        .site-footer__right{display:flex;gap:12px;align-items:center}
        .site-footer__link{color:var(--c-muted);text-decoration:none}
        .site-footer__link:hover{color:var(--c-text)}

        /* ==== Кнопки (как на /products) ==== */
        .btn{display:inline-block;padding:10px 16px;border-radius:8px;border:1px solid transparent;
            text-decoration:none;cursor:pointer;line-height:1.2}
        .btn:focus{outline:2px solid #93c5fd;outline-offset:2px}
        .btn-primary{background:var(--c-brand);color:#fff;border-color:var(--c-brand)}
        .btn-primary:hover{background:var(--c-brand-d)}
        .btn-secondary{background:#fff;color:var(--c-brand);border-color:var(--c-brand)}
        .btn-secondary:hover{background:#eff6ff}
        .btn-danger{background:#ef4444;color:#fff;border-color:#ef4444}
        .btn-danger:hover{background:#dc2626}
    </style>
</head>
<body class="bg-white mb-4">

{{-- HEADER --}}
<x-header />

{{-- Основной контент страниц --}}
@yield('content')

{{-- FOOTER --}}
<x-footer />

</body>
</html>
