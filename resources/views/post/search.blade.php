@extends('layouts.main')

@section('content')
<div class="content">
    <div class="container">
        <div class="content-grids">
            <div class="col-md-8 content-main">
                <div class="content-grid">
                    @if($posts->count() > 0)
                    @foreach($posts as $post)					 
                    <div class="content-grid-info">
                        <a href="{{ route('post.show', $post->id) }}"><img src="{{ asset('storage/' . $post->preview_image) }}" alt="{{ $post->title }}" style="max-width: 100%;"/></a>
                        <div class="post-info">
                        <h4>
                            <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a> 
                            <span style="margin-right: 5px">{{ $post->date->day }} {{ $post->date->translatedFormat('F') }} {{ $post->date->year }} {{ $post->date->format('H:i') }}</span> / 
                            <span style="margin-left: 5px; margin-right: 5px;">{{ $post->comments->count() }} <i class="far fa-comment" style="margin-left: 4px"></i></span> / 
                            <span style="margin-left: 5px">{{ $post->likes->count() }} <i class="far fa-heart" style="margin-left: 4px"></i></span>
                        </h4>
                        <a href="{{ route('post.show', $post->id) }}"><span></span>Подробнее</a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p style="margin-bottom: 60px">Ничего не найдено</p>
                    @endif
                </div>
             </div>
             <div class="clearfix"></div>
         </div>
         <div>
            {{ $posts->links() }}
         </div>
     </div>
</div>
@endsection