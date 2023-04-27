@extends('layouts.main')

@section('content')
<div class="single">
    <div class="container">
         <div class="col-md-8 single-main">				 
             <div class="single-grid">
                <h2 style="color: #00AEFF; margin-bottom: 20px;">{{ $post->title }}</h2>
                <div style="margin-bottom: 20px;">{{ $date->day }} {{ $date->translatedFormat('F') }} {{ $date->year }} {{ $date->format('H:i') }}</div>
                <img src="{{ asset('storage/' . $post->main_image) }}" alt="{{ $post->title }}"/>						 					 
                <p>{!! $post->content !!}</p>
             </div>
             <div style="display: flex;">
                <div>
                    <span><i class="far fa-eye"></i></span>
                    <span style="font-size: 14px; margin-left: 4px;">{{ $post->views() }}</span>
                </div>
                @auth()
                <form style="margin-left: 15px;margin-bottom: 50px;">
                    <button type="button" id="like" style="border: none; outline: none; background: unset;"> 
                        <i id="heart" class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's text-danger' : 'r' }} fa-heart"></i>
                    </button>
                    <span style="font-size: 14px;" id="quantityLikes">{{ $post->likes->count() }}</span>
                </form>
                <script>
                    $("#like").on("click", function () {
                        $.ajax({
                            url: "{{ route('post.like.store', $post->id) }}",
                            type: 'POST',
                            cache: false,
                            data: {'_token': "{{ csrf_token() }}"},
                            success: function(res) {
                                if (res.likeContains === true) {
                                    $('#quantityLikes').text(res.likesCount);
                                    $('#heart').addClass('text-danger');
                                    $('#heart').removeClass('far');
                                    $('#heart').addClass('fas');
                                } else {
                                    $('#quantityLikes').text(res.likesCount);
                                    $('#heart').removeClass('text-danger');
                                    $('#heart').removeClass('fas');
                                    $('#heart').addClass('far');
                                }
                            }
                        });
                    });
                </script>
                @endauth
                @guest()
                    <div style="margin-left: 15px; margin-bottom: 50px;">
                        <a href="{{ route('login') }}"><i class="far fa-heart"></i></a>
                        <span style="font-size: 14px;">{{ $post->likes->count() }}</span>
                    </div>
                @endguest
             </div>
             @auth
             <div class="content-form">
                <form action="{{ route('post.comment.store', $post->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="message" placeholder="Введите комментарий" style="border: 1px solid gray;"></textarea>
                    <input type="submit" value="ОТПРАВИТЬ"/>
                </form>
             </div><br><br>
             @endauth
             <section class="comment-list">
             <h2 class="section-title" data-aos="fade-up">Комментарии ({{ $post->comments->count() }})</h2><br><br>
             @foreach($post->comments as $comment)
             <div class="comment-text">
                <span class="username">
                    <div>
                       {{ $comment->user->name }}
                    </div>
                </span>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-family:Arial;">{{ $comment->message }}</span>
                    <span class="text-muted text-right">{{ $comment->dateAsCarbon->diffForHumans() }}</span>
                </div> 
             </div><br>
             @endforeach
             </section>
         </div>

             <div class="col-md-4 side-content">
                <div class="recent">
                    <h3>Недавние посты</h3>
                    <ul>
                    @foreach($recentPosts as $post)
                        <li><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></li>
                    @endforeach
                    </ul>
                </div>
                <div class="clearfix"></div>
             </div>
             <div class="clearfix"></div>
         </div>
     </div>
</div>
@endsection