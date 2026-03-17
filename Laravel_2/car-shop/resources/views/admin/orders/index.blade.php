@extends('layouts.app')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <h1 class="text-2xl font-bold mb-4">Управление заказами</h1>
            
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">№</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Покупатель</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Дата</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Сумма</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $order->id }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $order->order_date->format('d.m.Y') }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ number_format($order->items->sum(fn($item) => $item->quantity * $item->price), 0, ',', ' ') }} ₽</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Просмотр</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Нет заказов</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection