@extends('users.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('トップページお知らせから') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('お知らせページ') }}

                    <form method="POST" action="{{ route('user.articles.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>

                        <div class="form-group">
                            <label for="posted_date">投稿日</label>
                            <input type="date" class="form-control" name="posted_date" id="posted_date" required>
                        </div>

                        <div class="form-group">
                            <label for="article_contents">記事内容</label>
                            <textarea class="form-control" name="article_contents" id="article_contents" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">登録</button>
                    </form>
                </div>
                <div class="card-body">
                    <h3>お知らせ表示</h3>
                    <h4>{{ $article->title }}</h4>
                    <p>{{ $article->posted_date }}</p>
                    <p>{{ $article->article_contents }}</p>

                </div>
                <a href="{{ route('user.show.top') }}" >戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
