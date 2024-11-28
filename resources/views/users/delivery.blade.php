@extends('users.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('user.show.top') }}" >←戻る</a>

                    <div>
                        <video width="320" height="240" controls>
                            <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                        </video>
                    </div>

                    <div>
                        <form action="{{ route('user.curriculum.markAsCompleted', $curriculum->id) }}" method="post">
                            @csrf
                            <button>受講しました</button>
                        </form>
                    </div>

                    <div>
                        @if ($curriculum->grades)
                        <p><h3>{{ $curriculum->grades->name }}</h3></p>
                        @else
                        <p>授業名は設定されていません。</p>
                        @endif
                        
                    </div>

                    <div>
                        
                        <h1>{{ $curriculum->title }}</h1>

                    </div>
                    <div>
                        <h4>講座内容</h4>
                        <div>
                            {{ $curriculum->description}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
