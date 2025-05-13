@extends('layouts.profile')
@section('banner')
    @if($viewData['banner'] != null)
        {{asset('storage/'.$viewData['banner'])}}
    @else
        {{asset('images/101755206_p0_master1200.jpg')}}
    @endif
@endsection
@section('pfp', asset($viewData['avatar']))
@section('username', $viewData['username'])
@section('pronouns', $viewData['pronouns'])
@section('description', $viewData['bio'])
@section('posts')
    @foreach($viewData['posts'] as $post)
        <div class="line"></div>

        <div class="single-post">
            <div class="post-image" style="background-image: url('{{asset('storage/'.$post->image)}}')">
            </div>
            <!--<img src="{{asset('storage/'.$post->image)}}" alt="postimage">-->

            <div class="post-info">
                <h3>Post from {{date('d-m-Y', strtotime($post->created_at))}}</h3>
                <p>
                    {{$post->likes->count()}}
                    @if($post->likes->count() != 1)
                        Likes
                    @else
                        Like
                    @endif
                    |
                    {{$post->comments->count()}}
                    @if($post->comments->count() != 1)
                        Comments
                    @else
                        Comment
                    @endif

                </p>
                <div>
                    <a  href="{{route('detail', ['id'=>$post['id']])}}" class="material-icons md-36" style="margin-right: 1rem">comment</a>
                    <a  href="{{route('delete', ['id'=>$post['id']])}}" class="material-icons md-36" style="color: var(--accent-red)">delete</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection
