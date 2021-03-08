@extends('layouts.app')

@section('content')

    <div class="flex w-full">
        <div class="w-3/12">
            <app-nav />
        </div>
        <div class="w-9/12 border-2 border-gray-800 border-t-0 border-b-0">
            <app-followers :user="{{$user}}" :followers="{{$user->followers}}" :auth="{{$authId}}"/>
        </div>
    </div>

@endsection
