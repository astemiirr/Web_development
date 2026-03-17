@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Назад к списку</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Заказ №{{ $order->id }}</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Информация о заказе</h5>
                    <p><strong>Дата заказа:</strong> {{ $order->order_date->format('d.m.Y H:i') }}</p>
                    <p><strong>Покупатель:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                </div>
            </div>

            <h5>Состав заказа</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Количество</th>
                            <th>Цена</th>
                            <th class="text-end">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 0, ',', ' ') }} ₽</td>
                            <td class="text-end">{{ number_format($item->quantity * $item->price, 0, ',', ' ') }} ₽</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Итого:</th>
                            <th class="text-end">{{ number_format($order->items->sum(fn($item) => $item->quantity * $item->price), 0, ',', ' ') }} ₽</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection