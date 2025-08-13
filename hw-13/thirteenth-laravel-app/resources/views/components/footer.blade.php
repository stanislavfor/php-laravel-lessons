<footer class="site-footer">
    <div class="site-footer__inner">
        <div>My Laravel Products Shop © {{ date('Y') }} All rights reserved.</div>
        <div class="site-footer__right">
            <a href="{{ route('products.page') }}" class="site-footer__link">Products</a>
            <a href="{{ route('products.create.page') }}" class="site-footer__link">Добавить</a>
            <a href="{{ route('page') }}" class="site-footer__link">Laravel</a>
        </div>
    </div>
</footer>
