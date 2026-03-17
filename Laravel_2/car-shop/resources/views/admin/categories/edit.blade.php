<!DOCTYPE html>
<html>
<head>
    <title>Админка - редактирование категории</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type=text], textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        textarea { height: 100px; }
        .btn { display: inline-block; padding: 10px 15px; text-decoration: none; border-radius: 3px; border: none; cursor: pointer; }
        .btn-primary { background: #ffc107; color: black; }
        .btn-secondary { background: #6c757d; color: white; }
        .error { color: red; font-size: 14px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Редактирование категории</h1>
        
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Название категории:</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label>Описание:</label>
                <textarea name="description">{{ old('description', $category->description) }}</textarea>
                @error('description') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label>Родительская категория:</label>
                <select name="parent_id">
                    <option value="">— Нет родительской категории —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Обновить категорию</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>