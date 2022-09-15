@extends('templates.base')

@section('meta-title', $data['title'] . ' - ' . config('app.name'))

@section('content')
    <form method="POST" action="{{ route('text.delete', $data['slug']) }}">
        @csrf
        @method('DELETE')

        <button onclick="return confirm('Вы уверены?')" type="submit" class="btn btn-danger float-end">Удалить
        </button>
    </form>
    <a href="{{ route('text.edit', $data['slug']) }}" type="button"
       class="btn btn-success me-1 float-end">Редактировать</a>
    <h1>{{ $data['title'] }}</h1>
    <p class="text-muted">
        {{ $data['author'] ?? 'Аноним' }}
        <span class="date">
            {{ $data['updated_at']}}
        </span>
    </p>
    <p>{{ $data['text'] }}</p>
@endsection
