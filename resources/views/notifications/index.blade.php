@extends('layouts.app')

@section('content')

    <div class="flex">
        <div class="w-4/12">
            <app-nav />
        </div>
        <div class="w-8/12 border-2 border-gray-800 border-t-0 border-b-0">
            <app-notifications />
        </div>
    </div>

@endsection
