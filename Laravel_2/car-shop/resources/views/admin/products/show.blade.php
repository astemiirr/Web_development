<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 0; background: #f5f5f5; }
        .header { background: #333; color: white; padding: 15px 0; }
        .header .container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: white; text-decoration: none; margin-left: 20px; }
        .container { max-width: 1200px; margin: 20px auto; background: white; padding: 20px; border-radius: 5px; }
        
        .product { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .product-image img { width: 100%; max-height: 400px; object-fit: cover; border-radius: 5px; }
        .product-info h1 { margin-top: 0; }
        .price { font-size: 24px; color: #28a745; font-weight: bold; margin: 20px 0; }
        .description { line-height: 1.6; color: #666; }
        .btn { display: inline-block; padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 3px; border: none; cursor: pointer; }
        .btn:hover { background: #218838; }
        
        .rating { margin: 20px 0; }
        .star { font-size: 24px; color: #ddd; cursor: pointer; display: inline-block; }
        .star.active { color: #ffc107; }
        .average-rating { margin-top: 10px; font-size: 18px; }
        
        .back-link { margin-bottom: 20px; display: block; }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h2>Автомобильный магазин</h2>
            <div>
                <a href="/">Каталог</a>
                <a href="/feedback">Обратная связь</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="/admin/users">Админ панель</a>
                    @endif
                    <a href="/cart">Корзина</a>
                    <a href="/my-orders">Мои заказы</a>
                    <span>{{ auth()->user()->name }}</span>
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
        <a href="/" class="back-link">← Назад в каталог</a>
        
        <div class="product">
            <div class="product-image">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/600x400?text=No+Image" alt="Нет фото">
                @endif
            </div>
            
            <div class="product-info">
                <h1>{{ $product->name }}</h1>
                <p>Категория: {{ $product->category->name ?? 'Без категории' }}</p>
                
                <div class="price">{{ number_format($product->price, 0, ',', ' ') }} ₽</div>
                
                <div class="description">
                    <h3>Описание</h3>
                    <p>{{ $product->description }}</p>
                </div>
                
                @auth
                    <form action="/cart/add/{{ $product->id }}" method="POST" style="margin: 20px 0;">
                        @csrf
                        <button type="submit" class="btn">Добавить в корзину</button>
                    </form>
                @endauth
                
                <!-- Оценка товара -->
                <div class="rating">
                    <h3>Оценить товар</h3>
                    <div>
                        @for($i = 1; $i <= 5; $i++)
                            <form action="/products/{{ $product->id }}/rate" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" name="rating" value="{{ $i }}" class="star" style="background: none; border: none;">
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
                    
                    @php
                        $avgRating = $product->ratings()->avg('rating');
                    @endphp
                    @if($avgRating)
                        <div class="average-rating">
                            Средняя оценка: {{ number_format($avgRating, 1) }} / 5
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>