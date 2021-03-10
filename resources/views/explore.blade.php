@extends('layouts.app')

@section('content')

    <div class="flex w-full">
        <div class="w-4/12">
            <app-nav />
        </div>
        <div class="w-8/12 border-2 border-gray-800 border-t-0 border-b-0 flex flex-col border">
            <div class="w-full flex content-center justify-center border p-4">
                <app-search-bar />
            </div>
            <div class="border" id="searchResultsContainer">

            </div>
        </div>
    </div>

@endsection
