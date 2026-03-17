<!DOCTYPE html>
<html>
<head>
    <title>ТЕСТ</title>
</head>
<body>
    <h1 style="color: red; font-size: 48px;">ЕСЛИ ТЫ ЭТО ВИДИШЬ - ШАБЛОНЫ РАБОТАЮТ</h1>
    <p>Количество товаров: {{ $products->count() }}</p>
    @foreach($products as $product)
        <div style="border: 2px solid blue; margin: 10px; padding: 10px;">
            <h3>{{ $product->name }}</h3>
            <img src="{{ $product->image_url }}" style="max-width: 200px;">
        </div>
    @endforeach
</body>
</html>