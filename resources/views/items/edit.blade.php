@php
    $title = __('Edit') . ': ' . $item->name;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ url('items/'.$item->key) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $item->name }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea id="description" class="form-control" name="description" rows="8" required>{{ $item->description }}</textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
@endsection
