<!DOCTYPE html>
<html>
<head>
    <title>Админка - редактирование товара</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type=text], input[type=number], textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        textarea { height: 100px; }
        .btn { display: inline-block; padding: 10px 15px; text-decoration: none; border-radius: 3px; border: none; cursor: pointer; }
        .btn-primary { background: #ffc107; color: black; }
        .btn-secondary { background: #6c757d; color: white; }
        .error { color: red; font-size: 14px; margin-top: 5px; }
        img { max-width: 200px; max-height: 200px; margin-top: 10px; border: 1px solid #ddd; padding: 5px; }
        .header { background: #333; color: white; padding: 10px; margin-bottom: 20px; }
        .header a { color: white; margin-right: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <a href="/">На сайт</a>
        <a href="/admin/users">Пользователи</a>
        <a href="/admin/categories">Категории</a>
        <a href="/admin/products">Товары</a>
        <a href="/admin/orders">Заказы</a>
    </div>

    <div class="container">
        <h1>Редактирование товара</h1>
        
        <form method="POST" action="{{ route('admin.products.update', $product) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Название товара:</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label>Описание:</label>
                <textarea name="description" required>{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label>Цена (₽):</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
                @error('price') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label>Категория:</label>
                <select name="category_id" required>
                    <option value="">Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label>Ссылка на изображение:</label>
                <input type="text" name="image_url" value="{{ old('image_url', $product->image_url) }}" placeholder="/images/cars/имя_файла.jpg">
                <small style="color: #666; display: block; margin-top: 5px;">Например: /images/cars/bmw.jpg</small>
                @error('image_url') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            @if($product->image_url)
            <div class="form-group">
                <label>Текущее изображение:</label>
                <div>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" onerror="this.src='https://via.placeholder.com/200?text=Ошибка+загрузки'">
                </div>
            </div>
            @endif
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Обновить товар</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>