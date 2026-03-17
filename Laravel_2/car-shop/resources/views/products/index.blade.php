<!DOCTYPE html>
<html>
<head>
    <title>Каталог автомобилей</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .header { background: #333; color: white; padding: 15px 0; }
        .header .container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .header a { color: white; text-decoration: none; margin-left: 20px; }
        .header a:hover { text-decoration: underline; }
        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }
        
        /* Каталог */
        .catalog { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 20px; }
        .product-card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .product-image { height: 200px; overflow: hidden; }
        .product-image img { width: 100%; height: 100%; object-fit: cover; }
        .product-info { padding: 15px; }
        .product-title { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
        .product-price { font-size: 20px; color: #28a745; font-weight: bold; margin: 10px 0; }
        .product-category { color: #666; font-size: 14px; margin-bottom: 10px; }
        .btn { display: inline-block; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
        .btn:hover { background: #0056b3; }
        
        /* Поиск */
        .search-box { margin: 20px 0; }
        .search-box form { display: flex; gap: 10px; }
        .search-box input { padding: 10px; flex: 1; max-width: 300px; border: 1px solid #ddd; border-radius: 4px; }
        .search-box button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        
        /* Недавно просмотренные */
        .recent { margin-top: 40px; padding-top: 20px; border-top: 2px solid #ddd; }
        .recent-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-top: 10px; }
        .recent-item { background: white; padding: 10px; border-radius: 4px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .recent-item img { width: 100%; height: 100px; object-fit: cover; border-radius: 4px; }
        .recent-item a { display: block; margin-top: 5px; color: #007bff; text-decoration: none; }
        
        /* Пагинация */
        .pagination { margin-top: 30px; text-align: center; }
        .pagination a, .pagination span { display: inline-block; padding: 8px 12px; margin: 0 4px; border: 1px solid #ddd; text-decoration: none; color: #007bff; border-radius: 4px; }
        .pagination .active { background: #007bff; color: white; border-color: #007bff; }
        
        @media (max-width: 768px) {
            .recent-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h2 style="margin:0;">🚗 Автомобильный магазин</h2>
            <div>
                <a href="/">Каталог</a>
                <a href="/feedback">Обратная связь</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="/admin/users">Админ панель</a>
                    @endif
                    <a href="/cart">Корзина</a>
                    <a href="/my-orders">Мои заказы</a>
                    <span style="color: #ffc107;">{{ auth()->user()->name }}</span>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">@csrf</form>
                @else
                    <a href="/login">Вход</a>
                    <a href="/register">Регистрация</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Каталог автомобилей</h1>
        
        <!-- Поиск -->
        <div class="search-box">
            <form method="GET" action="/">
                <input type="text" name="search" placeholder="Поиск по названию..." value="{{ request('search') }}">
                <button type="submit">Найти</button>
            </form>
        </div>
        
        <!-- Товары -->
        <div class="catalog">
            @forelse($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" alt="Нет фото">
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="product-title">{{ $product->name }}</div>
                        <div class="product-category">{{ $product->category->name ?? 'Без категории' }}</div>
                        <div class="product-price">{{ number_format($product->price, 0, ',', ' ') }} ₽</div>
                        <a href="/products/{{ $product->id }}" class="btn">Подробнее</a>
                    </div>
                </div>
            @empty
                <p>Товаров не найдено</p>
            @endforelse
        </div>
        
        <!-- Пагинация -->
        <div class="pagination">
            {{ $products->links() }}
        </div>
        
        <!-- Недавно просмотренные -->
        @if(isset($recentProducts) && $recentProducts->count() > 0)
            <div class="recent">
                <h2>Недавно просмотренные</h2>
                <div class="recent-grid">
                    @foreach($recentProducts as $recent)
                        <div class="recent-item">
                            @if($recent->image_url)
                                <img src="{{ $recent->image_url }}" alt="{{ $recent->name }}">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Нет фото">
                            @endif
                            <div style="font-weight:bold; margin:5px 0;">{{ $recent->name }}</div>
                            <a href="/products/{{ $recent->id }}">Смотреть</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>
</html>