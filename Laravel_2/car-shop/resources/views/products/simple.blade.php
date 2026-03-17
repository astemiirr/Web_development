<!DOCTYPE html>
<html>
<head>
    <title>Каталог</title>
</head>
<body>
    <h1>Каталог автомобилей</h1>
    
    <ul>
    @foreach($products as $product)
        <li>
            <strong>{{ $product->name }}</strong> - {{ $product->price }} ₽
            <br>
            <a href="/products/{{ $product->id }}">Подробнее</a>
        </li>
    @endforeach
    </ul>
    
    <p><a href="/admin/users">Админка</a></p>
</body>
</html>