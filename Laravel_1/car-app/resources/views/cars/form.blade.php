<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Учет автомобилей</title>
    <!-- Bootstrap 5 для стилей -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 800px; }
        .form-section { margin-bottom: 2rem; }
        .btn-container { margin-top: 1.5rem; }
        .alert { margin-top: 1rem; }
        h1 { color: #333; margin-bottom: 1.5rem; }
        .form-label { font-weight: 500; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">📝 Система учета автомобилей</h1>
        
        <!-- Вывод сообщений об успехе/ошибке -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <!-- Форма -->
        <form method="POST" action="{{ route('cars.store') }}" id="carForm">
            @csrf
            
            <div class="row">
                <!-- Основная информация -->
                <div class="col-md-6 form-section">
                    <h3>Основная информация</h3>
                    
                    <div class="mb-3">
                        <label for="brand" class="form-label">Марка *</label>
                        <input type="text" class="form-control" id="brand" name="brand" 
                               value="{{ old('brand') }}" required 
                               placeholder="Например: Toyota">
                    </div>
                    
                    <div class="mb-3">
                        <label for="model" class="form-label">Модель *</label>
                        <input type="text" class="form-control" id="model" name="model" 
                               value="{{ old('model') }}" required 
                               placeholder="Например: Camry">
                    </div>
                    
                    <div class="mb-3">
                        <label for="year" class="form-label">Год выпуска *</label>
                        <input type="number" class="form-control" id="year" name="year" 
                               value="{{ old('year', date('Y')) }}" required 
                               min="1900" max="{{ date('Y') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="color" class="form-label">Цвет *</label>
                        <input type="text" class="form-control" id="color" name="color" 
                               value="{{ old('color') }}" required 
                               placeholder="Например: Черный">
                    </div>
                </div>
                
                <!-- Технические характеристики -->
                <div class="col-md-6 form-section">
                    <h3>Технические характеристики</h3>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Цена ($) *</label>
                        <input type="number" class="form-control" id="price" name="price" 
                               value="{{ old('price') }}" required 
                               min="0" step="0.01" placeholder="Например: 25000">
                    </div>
                    
                    <div class="mb-3">
                        <label for="engine_volume" class="form-label">Объем двигателя (л) *</label>
                        <input type="number" class="form-control" id="engine_volume" name="engine_volume" 
                               value="{{ old('engine_volume') }}" required 
                               min="0.5" max="10" step="0.1" placeholder="Например: 2.5">
                    </div>
                    
                    <div class="mb-3">
                        <label for="transmission" class="form-label">Коробка передач *</label>
                        <select class="form-select" id="transmission" name="transmission" required>
                            <option value="">Выберите тип</option>
                            <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>Автоматическая</option>
                            <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Механическая</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="fuel_type" class="form-label">Тип топлива *</label>
                        <select class="form-select" id="fuel_type" name="fuel_type" required>
                            <option value="">Выберите тип</option>
                            <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : '' }}>Бензин</option>
                            <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Дизель</option>
                            <option value="electric" {{ old('fuel_type') == 'electric' ? 'selected' : '' }}>Электро</option>
                            <option value="hybrid" {{ old('fuel_type') == 'hybrid' ? 'selected' : '' }}>Гибрид</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="mileage" class="form-label">Пробег (км)</label>
                        <input type="number" class="form-control" id="mileage" name="mileage" 
                               value="{{ old('mileage') }}" min="0" 
                               placeholder="Например: 50000">
                    </div>
                    
                    <div class="mb-3">
                        <label for="vin" class="form-label">VIN-код (17 символов)</label>
                        <input type="text" class="form-control" id="vin" name="vin" 
                               value="{{ old('vin') }}" maxlength="17" 
                               placeholder="Пример: 1HGBH41JXMN109186">
                    </div>
                </div>
            </div>
            
            <!-- Кнопки -->
            <div class="btn-container text-center">
                <!-- Кнопка Сохранить - обычная отправка формы -->
                <button type="submit" name="action" value="save" class="btn btn-success btn-lg me-3">
                    💾 Сохранить автомобиль
                </button>
                
                <!-- Кнопка Найти - отправка на другой маршрут с отключением валидации -->
                <button type="submit" formaction="{{ route('cars.search') }}" formmethod="POST" 
                        formnovalidate class="btn btn-primary btn-lg">
                    🔍 Найти автомобиль
                </button>
            </div>
            
            <div class="text-muted small mt-3">
                * Поля, обязательные для заполнения при сохранении
            </div>
        </form>
        
        <!-- Ссылка на просмотр всех автомобилей -->
        <div class="text-center mt-4">
            <a href="{{ route('cars.search') }}" class="btn btn-outline-secondary">
                👁️ Показать все автомобили
            </a>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Дополнительный скрипт для улучшения UX -->
    <script>
        // Отключаем required атрибуты при нажатии кнопки поиска
        document.addEventListener('DOMContentLoaded', function() {
            const searchBtn = document.querySelector('button[formaction="{{ route("cars.search") }}"]');
            
            searchBtn.addEventListener('click', function() {
                // Временно отключаем required у всех полей
                const form = document.getElementById('carForm');
                const requiredFields = form.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    field.dataset.wasRequired = field.hasAttribute('required');
                    field.removeAttribute('required');
                });
                
                // Восстанавливаем через короткое время
                setTimeout(() => {
                    requiredFields.forEach(field => {
                        if (field.dataset.wasRequired === 'true') {
                            field.setAttribute('required', '');
                        }
                    });
                }, 100);
            });
        });
    </script>
</body>
</html>
