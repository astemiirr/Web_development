<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты поиска автомобилей</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 1200px; }
        .car-card { 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            padding: 20px; 
            margin-bottom: 20px; 
            transition: transform 0.2s;
        }
        .car-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .car-header { 
            background-color: #f8f9fa; 
            padding: 15px; 
            border-radius: 8px; 
            margin-bottom: 15px;
        }
        .stats { 
            background-color: #e9ecef; 
            padding: 10px; 
            border-radius: 5px; 
            margin-bottom: 1rem;
        }
        .back-btn { margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Кнопка возврата -->
        <div class="back-btn">
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">← Назад к форме</a>
        </div>
        
        <!-- Заголовок с результатами -->
        <div class="car-header">
            <h2>🔍 Результаты поиска автомобилей</h2>
            @if(!empty($searchParams))
                <p class="mb-1">
                    <strong>Критерии поиска:</strong> 
                    @foreach($searchParams as $key => $value)
                        <span class="badge bg-info me-1">{{ $key }}: {{ $value }}</span>
                    @endforeach
                </p>
            @else
                <p class="mb-1"><strong>Все автомобили в базе</strong></p>
            @endif
            <p class="mb-0"><strong>Найдено автомобилей:</strong> {{ $totalFound }}</p>
        </div>
        
        <!-- Сообщение, если ничего не найдено -->
        @if($totalFound == 0)
            <div class="alert alert-warning">
                <h4>🚫 Автомобили не найдены</h4>
                <p>По вашему запросу не найдено ни одного автомобиля.</p>
                <a href="{{ route('cars.index') }}" class="btn btn-primary">Добавить новый автомобиль</a>
            </div>
        @else
            <!-- Список автомобилей -->
            <div class="row">
                @foreach($cars as $car)
                    <div class="col-md-6">
                        <div class="car-card">
                            <!-- Заголовок карточки -->
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h4 class="text-primary">{{ $car['brand'] }} {{ $car['model'] }}</h4>
                                <span class="badge bg-success fs-6">${{ number_format($car['price'], 2) }}</span>
                            </div>
                            
                            <!-- Основная информация -->
                            <div class="stats">
                                <div class="row">
                                    <div class="col-6"><strong>Год:</strong> {{ $car['year'] }}</div>
                                    <div class="col-6"><strong>Цвет:</strong> {{ $car['color'] }}</div>
                                    <div class="col-6"><strong>Двигатель:</strong> {{ $car['engine_volume'] }}л</div>
                                    <div class="col-6">
                                        <strong>КПП:</strong> 
                                        {{ $car['transmission'] == 'automatic' ? 'Автомат' : 'Механика' }}
                                    </div>
                                    <div class="col-6">
                                        <strong>Топливо:</strong> 
                                        @php
                                            $fuelTypes = [
                                                'petrol' => 'Бензин',
                                                'diesel' => 'Дизель',
                                                'electric' => 'Электро',
                                                'hybrid' => 'Гибрид'
                                            ];
                                        @endphp
                                        {{ $fuelTypes[$car['fuel_type']] ?? $car['fuel_type'] }}
                                    </div>
                                    @if(!empty($car['mileage']))
                                        <div class="col-6"><strong>Пробег:</strong> {{ number_format($car['mileage']) }} км</div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Дополнительная информация -->
                            @if(!empty($car['vin']))
                                <p class="mb-1"><small><strong>VIN:</strong> {{ $car['vin'] }}</small></p>
                            @endif
                            <p class="mb-0 text-muted small">
                                <strong>Добавлен:</strong> {{ $car['created_at'] }} 
                                <span class="ms-2"><strong>ID:</strong> {{ $car['id'] }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
