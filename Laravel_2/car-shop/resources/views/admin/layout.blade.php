<!DOCTYPE html>
<html>
<head>
    <title>Админка - @yield('title')</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 0; background: #f5f5f5; }
        .admin-header { background: #333; color: white; padding: 15px 0; }
        .admin-header .container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .admin-nav a { color: white; text-decoration: none; margin-left: 20px; }
        .admin-nav a:hover { text-decoration: underline; }
        .container { max-width: 1200px; margin: 20px auto; background: white; padding: 20px; border-radius: 5px; }
        .admin-menu { background: #f8f9fa; padding: 10px; margin-bottom: 20px; border-bottom: 1px solid #ddd; }
        .admin-menu a { display: inline-block; padding: 8px 15px; margin-right: 10px; background: #007bff; color: white; text-decoration: none; border-radius: 3px; }
        .admin-menu a:hover { background: #0056b3; }
        .btn { display: inline-block; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-primary { background: #28a745; color: white; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #333; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        tr:hover { background: #f9f9f9; }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <h2>Панель администратора</h2>
            <div class="admin-nav">
                <a href="/">На сайт</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="admin-menu">
            <a href="{{ route('admin.users.index') }}">👥 Пользователи</a>
            <a href="{{ route('admin.categories.index') }}">📁 Категории</a>
            <a href="{{ route('admin.products.index') }}">📦 Товары</a>
            <a href="{{ route('admin.orders.index') }}">📋 Заказы</a>
        </div>
        
        @yield('content')
    </div>
</body>
</html>