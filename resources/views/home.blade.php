@extends('layouts.app')

@section('content')

    <div class="flex">
        <div class="w-3/12">
            Nav
        </div>
        <div class="w-9/12 border-2 border-gray-800 border-t-0 border-b-0">
            <app-timeline/>
        </div>
    </div>

@endsection
