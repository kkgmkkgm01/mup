@php
    $title = __('Items');
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('Id') }}</th>
                    <th>{{ __('Name') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        <a href="{{ url('items/'.$item->key) }}">{{ $item->name }}</a>
                    </td>
                 </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $items->links() }}
</div>
@endsection
