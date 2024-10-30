@extends('users.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('時間割ボタンから') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('授業一覧ページ') }}

                    <ul>
                        @foreach ($curriculums as $curriculum)
                            <li>
                                <a href="{{ route('user.show.delivery', $curriculum->id)}}">
                                    {{ $curriculum->title}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
