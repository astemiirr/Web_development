<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Передаем недавно просмотренные товары во все шаблоны
        View::composer('*', function ($view) {
            $recentIds = session()->get('recent_products', []);
            
            if (!empty($recentIds)) {
                // Сохраняем порядок как в сессии
                $recentProducts = Product::whereIn('id', $recentIds)
                    ->orderByRaw('FIELD(id, ' . implode(',', $recentIds) . ')')
                    ->get();
            } else {
                $recentProducts = collect([]);
            }
            
            $view->with('recentProducts', $recentProducts);
        });
    }
}