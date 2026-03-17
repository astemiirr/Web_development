@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Мои заказы</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($orders as $order)
        <div class="card mb-4">
            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Заказ №{{ $order->id }}</strong>
                    </div>
                    <div class="col-md-4">
                        Дата: {{ $order->order_date->format('d.m.Y H:i') }}
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-success">Оформлен</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
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
    @empty
        <div class="alert alert-info">
            У вас пока нет заказов. <a href="{{ route('products.index') }}">Перейти в каталог</a>
        </div>
    @endforelse
</div>
@endsection