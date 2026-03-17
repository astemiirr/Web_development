<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог автомобилей</title>
    <style>
        /* БАЗОВЫЕ СТИЛИ */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; }
        a { text-decoration: none; }

        /* ШАПКА */
        .top-bar {
            background: #222;
            color: white;
            padding: 15px 0;
            border-bottom: 3px solid #ffc107;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }
        .nav a {
            color: #ddd;
            margin-left: 20px;
            transition: color 0.2s;
        }
        .nav a:hover {
            color: #ffc107;
        }

        /* ПОИСК */
        .search-section {
            background: white;
            padding: 25px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .search-box {
            display: flex;
            gap: 10px;
            max-width: 500px;
        }
        .search-box input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 30px;
            font-size: 16px;
            outline: none;
            transition: border 0.2s;
        }
        .search-box input:focus {
            border-color: #ffc107;
        }
        .search-box button {
            background: #ffc107;
            border: none;
            border-radius: 30px;
            padding: 0 25px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .search-box button:hover {
            background: #e0a800;
        }

        /* КАТАЛОГ (сетка) */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .product-image {
            height: 200px;
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        .product-info {
            padding: 20px;
        }
        .product-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .product-category {
            color: #888;
            font-size: 14px;
            margin-bottom: 12px;
        }
        .product-price {
            font-size: 24px;
            font-weight: 800;
            color: #28a745;
            margin: 15px 0;
        }
        .btn-detail {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-detail:hover {
            background: #0056b3;
        }

        /* ПАГИНАЦИЯ */
        .pagination {
            margin: 40px 0;
            text-align: center;
        }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 14px;
            margin: 0 4px;
            border: 1px solid #ddd;
            border-radius: 6px;
            color: #333;
        }
        .pagination .active {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        /* НЕДАВНО ПРОСМОТРЕННЫЕ */
        .recent {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px dashed #ccc;
        }
        .recent h2 {
            margin-bottom: 20px;
        }
        .recent-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
        }
        .recent-item {
            background: white;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .recent-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 8px;
        }
        .recent-item a {
            display: inline-block;
            margin-top: 8px;
            color: #007bff;
            font-weight: 500;
        }
        @media (max-width: 768px) {
            .recent-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

<!-- ШАПКА (навигация) -->
<div class="top-bar">
    <div class="container">
        <div class="logo">🚗 AutoStore</div>
        <div class="nav">
            <a href="/">Каталог</a>
            <a href="/feedback">Обратная связь</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="/admin/users">Админ панель</a>
                @endif
                <a href="/cart">Корзина</a>
                <a href="/my-orders">Мои заказы</a>
                <span style="color:#ffc107;">{{ auth()->user()->name }}</span>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                <form id="logout-form" action="/logout" method="POST" style="display:none;">@csrf</form>
            @else
                <a href="/login">Вход</a>
                <a href="/register">Регистрация</a>
            @endauth
        </div>
    </div>
</div>

<!-- ПОИСК -->
<div class="search-section">
    <div class="container">
        <form method="GET" action="/">
            <div class="search-box">
                <input type="text" name="search" placeholder="Поиск по названию..." value="{{ request('search') }}">
                <button type="submit">🔍 Найти</button>
            </div>
        </form>
    </div>
</div>

<!-- КАТАЛОГ ТОВАРОВ -->
<div class="container">
    <h1 style="margin-bottom: 20px;">Каталог автомобилей</h1>

    <div class="catalog-grid">
        @forelse($products as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/280x200?text=Нет+фото" alt="Нет фото">
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product-category">{{ $product->category->name ?? 'Без категории' }}</div>
                    <div class="product-price">{{ number_format($product->price, 0, ',', ' ') }} ₽</div>
                    <a href="/products/{{ $product->id }}" class="btn-detail">Подробнее</a>
                </div>
            </div>
        @empty
            <p>Товаров не найдено.</p>
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
                        <div style="font-weight:600;">{{ $recent->name }}</div>
                        <a href="/products/{{ $recent->id }}">Смотреть</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
</body>
</html>