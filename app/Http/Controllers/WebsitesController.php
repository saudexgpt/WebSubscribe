<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsitesController extends Controller
{
    //
    public function index()
    {
        $websites = Website::all();
        return response()->json(compact('websites'), 200);
    }
    public function newSubscription(Request $request)
    {
        // let's validate some stuff
        $validator = Validator::make($request->all(), [
            'website_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns'
        ]);
        // check if it fails and send an error message
        if ($validator->fails()) {
            return response()->json(['error_messages' => $validator->errors()], 500);
        }

        $email = $request->email;
        $name = $request->name;
        $website_id = $request->website_id;
        // check if user DOES NOT exist and add to db
        $user = User::where('email', $email)->first();
        if (!$user) {
            // email exists alert the user a
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->save();
        }
        // retrieve the user id
        $user->websites()->syncWithoutDetaching($website_id);
        return $this->show($user);
    }

    public function show(User $user)
    {
        //
        $user_subcriptions = $user->with('websites')->find($user->id);

        return response()->json(compact('user_subcriptions'), 200);
    }
}
