<header class="site-header">
    <div class="site-header__inner">
        <a class="brand" href="{{ url('/') }}">My Laravel Products Shop</a>

        <nav class="nav">
            <a href="{{ url('/') }}"               class="nav__link {{ request()->is('/') ? 'is-active' : '' }}">Главная</a>
            <a href="{{ route('products.page') }}" class="nav__link {{ request()->is('products*') ? 'is-active' : '' }}">Products</a>
            <a href="{{ route('products.create.page') }}" class="nav__link {{ request()->is('products/create') ? 'is-active' : '' }}">Store</a>
            <a href="{{ route('page') }}"
               class="btn btn-secondary {{ request()->routeIs('page') ? 'is-active' : '' }}">
                Welcome
            </a>
        </nav>
    </div>
</header>
