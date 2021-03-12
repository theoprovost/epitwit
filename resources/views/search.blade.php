@extends('layouts.app')

@section('content')

    <div class="flex w-full">
        <div class="w-4/12">
            <app-nav />
        </div>
        <div class="w-8/12 border-2 h-screen border-gray-800 border-t-0 border-b-0 flex flex-col border">
            <div class="w-full flex content-center justify-center  p-4">
                <app-search-bar url="/api/users/search" component="app-follower" placeholder="Search for a user"/>
            </div>
        </div>
    </div>

@endsection