<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class EditProfileFormController extends Controller
{


    public function submit(Request $request) {
        $auth = Auth::user();
        $user = User::where('id', '=', $auth->id)->first();
        $user->name = $request->get('name');
        $user->dob = $request->get('dob');
        $user->country = $request->get('country');
        $user->city = $request->get('city');
        $user->website = $request->get('website');
        $user->biography = $request->get('biography');
        $user->save();
        /*$this->validate($request, [
            'name' => 'required|string',
        ]);*/


        return response()->json(null, 200);
    }
}
