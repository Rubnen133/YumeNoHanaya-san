@extends('layouts.postDetail')
@section('post')
    <div class="post" style="margin-bottom: 4vh !important;">
        <div class="post-top">
            <img src="{{asset($viewData['avatar'])}}" alt="" class="avatar">
            <p class="username">{{$viewData['username']}}</p>
        </div>
        <img src="{{asset("storage/{$viewData['image']}")}}" alt="" class="post-img">
        <div class="post-bottom">
            <div class="post-interaction">
                <span class="material-icons md-36" style="grid-column: 2;
                        @if(\Illuminate\Support\Facades\Auth::user() != null)
                            @if(in_array($viewData['id'], $like_ids))
                                color: var(--accent-red) !important;
                            @endif
                        @endif
                ">favorite</span>
            </div>
        </div>
    </div>
@endsection
@section('postid', $viewData['id'])
@section('comments')
    @foreach($viewData['comments'] as $comment)
        <div class="comment">
            <img src="

            @if (!Str::startsWith(App\Models\User::find($comment['user_id'])->avatar, 'http'))
                {{asset('storage/'.App\Models\User::find($comment['user_id'])->avatar)}}
            @else
                {{App\Models\User::find($comment['user_id'])->avatar}}
            @endif

" alt="" class="avatar">
            <p class="username">{{App\Models\User::find($comment['user_id'])->name}}</p>
            <div style="grid-column: 2">
                {{$comment['content']}}
            </div>
        </div>
    @endforeach
@endsection
@if(\Illuminate\Support\Facades\Auth::user() != null)
    @section('username', \Illuminate\Support\Facades\Auth::user()->name)
@endif
