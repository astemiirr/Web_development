@extends('admin.layout')

@section('title', 'Управление категориями')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Управление категориями</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">➕ Добавить категорию</a>
    </div>
    
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 3px;">
            {{ session('success') }}
        </div>
    @endif
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Родитель</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description ?? '—' }}</td>
                <td>{{ $category->parent->name ?? '—' }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-edit" style="margin-right: 5px;">✏️ Ред</a>
                    
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Удалить категорию?')">🗑️ Уд</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">Категорий нет</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $categories->links() }}
    </div>
@endsection