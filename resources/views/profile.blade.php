@extends('layouts.app')

@section('content')

    <div class="flex text-gray-600">
        <div class="w-3/12">
            <app-nav />
        </div>
        <div class="w-9/12 border-2 border-gray-800 border-t-0 border-b-0">
            <div>
               <app-profile :auth="{{$authId}}"  :user="{{$user}}" :date="'{{ date_format($user->created_at,"F Y") }}'" :avatar="'{{$user->avatar()}}'" />
            </div>
            <div>
                <app-user-timeline/>
            </div>
        </div>
    </div>

@endsection
