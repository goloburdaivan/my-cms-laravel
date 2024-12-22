@extends('layouts.app')

@section('content')
    <h1>Страницы</h1>

    <a href="{{ route('admin.pages.create') }}" class="btn btn-success mb-3">Создать новую страницу</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        <a href="{{ route('admin.pages.show', $page->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                        <a href="{{ route('admin.pages.edit', ['page' => $page->id]) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $items->links() }}
        </div>
    @else
        <p>Страницы не найдены.</p>
    @endif
@endsection
