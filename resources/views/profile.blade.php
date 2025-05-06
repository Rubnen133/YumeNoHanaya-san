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
