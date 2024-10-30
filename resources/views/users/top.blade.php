@extends('users.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($banners as $index => $banner)
                            <div class="carousel-item {{ $index == 0 ? 'active' : ''}}">
                                <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="バナー画像">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#bannerCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                    <div class="carousel-indicators">
                        @foreach ($banners as $index => $banner)
                            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
                        @endforeach
                    </div>
                </div>
                
            </div>

            <h2 class="article-title">お知らせ</h2>
            <div class="card">
                <div class="card-body">                    
                    <ul>
                        @foreach ($articles as $article)
                            <li>
                                <div class="link">
                                    <a href="{{ route('user.show.test.article', $article->id) }}" class="fs-4">
                                        {{ \Carbon\Carbon::parse($article->posted_date)->format('Y年m月d日') }} &nbsp;&nbsp; {{ $article->title }}
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>
@endsection
