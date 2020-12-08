@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lesson Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('mypage.t.lessons.store') }}">
                        @csrf
                        <input type="hidden" name="courses_id" value="{{ $courses_id }}">

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Lesson Number') }}</label>

                            <div class="col-md-6">
                                <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number', 0) }}" required autocomplete="number" min="1" max="10">

                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Lesson Type') }}</label>

                            <div class="col-md-6">
                                @foreach ($types as $key => $value)
                                    <div>
                                        <label>
                                            <input type="radio" name="type" value="{{ $key }}" @if ($loop->first) checked @endif>
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-3">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" required autocomplete="date" value="">

                                @error('detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input id="start" type="time" class="form-control @error('start') is-invalid @enderror" name="start" required autocomplete="start" value="">
                            </div>
                            <div class="col-md-2">
                                <input id="finish" type="time" class="form-control @error('finish') is-invalid @enderror" name="finish" required autocomplete="finish" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detail" class="col-md-4 col-form-label text-md-right">{{ __('Detail') }}</label>

                            <div class="col-md-6">
                                <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="detail" autocomplete="detail" cols="50" rows="10">{{ old('detail') }}</textarea>

                                @error('detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', 0) }}" required autocomplete="price" min="0" max="500000">

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cancel_rate" class="col-md-4 col-form-label text-md-right">{{ __('Cancel rate') }}</label>

                            <div class="col-md-6">
                                <input id="cancel_rate" type="number" class="form-control @error('cancel_rate') is-invalid @enderror" name="cancel_rate" value="{{ old('cancel_rate', 0) }}" required autocomplete="cancel_rate" min="0" max="100">

                                @error('cancel_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
