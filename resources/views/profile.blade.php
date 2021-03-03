@extends('layouts.app')

@section('content')

    <div class="flex">
        <div class="w-3/12">
            <app-nav />
        </div>
        <div class="w-9/12 border-2 border-gray-800 border-t-0 border-b-0">
            <div>
                <div>
                    <div>
                        img
                    </div>
                    <div>
                        Bouton modifier profil si user = moi || bouton de follow + boutton envoyer un message
                    </div>
                </div>
                <div>
                    <p>{{$user->name}}</p>
                    <p>@<span>{{ $user->username }}</span></p>
                </div>
                <div>
                    icone + Joined {{date($user->created_at)}}
                </div>
                <div>
                    <p><span>{{count($user->following)}}</span> Following</p>
                    <p><span>{{count($user->followers)}}</span> Followers</p>
                </div>
            </div>
        </div>
    </div>

@endsection
