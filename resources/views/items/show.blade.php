@php
$title = __('Item') . ': ' . $item->name;
@endphp
@extends('layouts.my')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    {{-- 編集・削除ボタン --}}
    <div>
        <a href="{{ url('items/'.$item->key.'/edit') }}" class="btn btn-primary">
            {{ __('Edit') }}
        </a>
        {{-- 削除ボタンは後で正式なものに置き換えます --}}
        @component('components.btn-del')
        @slot('table', 'items')
        @slot('idkey', $item->key)
        @endcomponent
    </div>

    {{-- アイテム1件の情報 --}}
    <dl class="row">
        <dt class="col-md-2">{{ __('ID') }}</dt>
        <dd class="col-md-10">{{ $item->id }}</dd>
        <dt class="col-md-2">{{ __('Name') }}</dt>
        <dd class="col-md-10">{{ $item->name }}</dd>
    </dl>

    {{-- コメント --}}
    <h2>コメント</h2>
    <a href="">新規投稿</a>
    <div id="comment_wrap">
        @component('item_comments.main')
        @slot('page', app('request')->input('page'))
        @slot('item_comments', $item_comments)
        @endcomponent
    </div>
    @component('item_comments.javascript')
    @slot('key', $item->key)
    @endcomponent

</div>
@endsection