<!DOCTYPE html>
<html>
<head>
    <title>Корзина</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; }
        .container { max-width: 1200px; margin: 20px auto; background: white; padding: 20px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #333; color: white; padding: 10px; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .btn { padding: 8px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 3px; }
        .empty-cart { text-align: center; padding: 40px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Корзина</h1>
        
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if(empty($cart))
            <div class="empty-cart">
                <h2>Корзина пуста</h2>
                <a href="/" class="btn">Перейти в каталог</a>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 0, ',', ' ') }} ₽</td>
                        <td>{{ $cart[$product->id] }}</td>
                        <td>{{ number_format($product->price * $cart[$product->id], 0, ',', ' ') }} ₽</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" style="text-align:right;">Итого:</th>
                        <th>{{ number_format($total, 0, ',', ' ') }} ₽</th>
                    </tr>
                </tfoot>
            </table>
            
            <form action="/cart/checkout" method="POST" style="margin-top: 20px;">
                @csrf
                <button type="submit" class="btn">Оформить заказ</button>
            </form>
        @endif
    </div>
</body>
</html>