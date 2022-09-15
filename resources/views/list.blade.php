@extends('templates.base')

@section('meta-title', 'Все Записи' . ' - ' . config('app.name'))

@section('content')
<div class="list-group">
    @foreach($data as $item)
    <a href="{{ $item['slug'] }}" class="list-group-item list-group-item-action" aria-current="true">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $item['title'] }}</h5>
            <small>{{ $item['updated_at'] }}</small>
        </div>
        <p class="mb-1">{{ $item['text'] }}</p>
        <small class="text-muted">

            @if (!$item['author'])
                Без Автора
            @else
                {{ $item['author'] }}
            @endif
        </small>
    </a>
    @endforeach
</div>
@endsection
