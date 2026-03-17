@extends('admin.layout')

@section('title', 'Управление пользователями')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Управление пользователями</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Добавить пользователя</a>
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
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role == 'admin')
                        <span style="background: #007bff; color: white; padding: 3px 8px; border-radius: 3px;">Админ</span>
                    @else
                        <span style="background: #6c757d; color: white; padding: 3px 8px; border-radius: 3px;">Покупатель</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-edit" style="margin-right: 5px;">✏️ Ред</a>
                    
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Удалить пользователя?')">🗑️ Уд</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
@endsection