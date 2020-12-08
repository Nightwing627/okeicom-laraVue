@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @foreach($categories as $category)
                <p>
                    <a class="" href="{{ route('lessons.categories', ['categories_id' => $category->id]) }}">
                    {{ $category->name }}
                    </a>
                </p>
            @endforeach
        </div>
        <div class="col-md-8">
            <h2>レッスン一覧</h2>
            @foreach($lessons as $lesson)
                <p>
                    {{ $lesson->kanji_number }}
                    {{ $lesson->add_week_date }}
                    {{ $lesson->separate_hyphen_time }}
                    {{ $lesson->category1_name }} {{ $lesson->category2_name }} {{ $lesson->category3_name }}
                </p>
                <p>{{ $lesson->title }}</p>
                <p>{{ $lesson->detail }}</p>
                <p>{{ $lesson->user_name }}</p>
                <hr>
            @endforeach
            {{ $lessons->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>
@endsection
