<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; }
        a { text-decoration: none; }

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
        .logo { font-size: 24px; font-weight: bold; color: white; }
        .nav a {
            color: #ddd;
            margin-left: 20px;
            transition: color 0.2s;
        }
        .nav a:hover { color: #ffc107; }

        /* Детальная страница */
        .product-detail {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        .product-image img {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 8px;
        }
        .product-info h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }
        .product-category {
            color: #666;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .product-price {
            font-size: 36px;
            font-weight: 800;
            color: #28a745;
            margin: 20px 0;
        }
        .product-description {
            line-height: 1.6;
            color: #444;
            margin: 20px 0;
        }
        .btn-cart {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 18px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-cart:hover { background: #218838; }

        /* Рейтинг */
        .rating-section {
            margin: 30px 0;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .stars {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }
        .star-btn {
            background: none;
            border: none;
            font-size: 30px;
            color: #ffc107;
            cursor: pointer;
            transition: transform 0.1s;
        }
        .star-btn:hover { transform: scale(1.2); }
        .average-rating {
            font-size: 18px;
            color: #555;
        }

        .back-link {
            display: inline-block;
            margin: 20px 0;
            color: #007bff;
        }
    </style>
</head>
<body>

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

<div class="container">
    <a href="/" class="back-link">← Назад в каталог</a>

    <div class="product-detail">
        <div class="product-image">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/600x400?text=Нет+фото" alt="Нет фото">
            @endif
        </div>

        <div class="product-info">
            <h1>{{ $product->name }}</h1>
            <div class="product-category">Категория: {{ $product->category->name ?? 'Без категории' }}</div>
            <div class="product-price">{{ number_format($product->price, 0, ',', ' ') }} ₽</div>
            <div class="product-description">{{ $product->description }}</div>

            @auth
                <form action="/cart/add/{{ $product->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-cart">Добавить в корзину</button>
                </form>
            @endauth

            <div class="rating-section">
                <h3>Оценка товара</h3>
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        <form action="/products/{{ $product->id }}/rate" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" name="rating" value="{{ $i }}" class="star-btn">
                                @php
                                    $userRating = auth()->check() ? auth()->user()->ratings()->where('product_id', $product->id)->first() : null;
                                @endphp
                                @if($userRating && $userRating->rating >= $i)
                                    ★
                                @else
                                    ☆
                                @endif
                            </button>
                        </form>
                    @endfor
                </div>
                @php $avg = $product->ratings()->avg('rating'); @endphp
                @if($avg)
                    <div class="average-rating">Средняя оценка: {{ number_format($avg, 1) }} / 5</div>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>