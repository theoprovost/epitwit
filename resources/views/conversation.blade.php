@extends('layouts.app')

@section('content')
    <div class="flex text-gray-600">
        <div class="w-3/12">
            <app-nav />
        </div>
        <div class="flex">
              <app-messages :userid="{{$userId}}"/>
        </div>
    </div>
@endsection
