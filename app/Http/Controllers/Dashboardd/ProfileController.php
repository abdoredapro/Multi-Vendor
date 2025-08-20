<?php

namespace App\Http\Controllers\Dashboardd;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit() {
        

        $user = Auth::user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'country' => Countries::getNames(),
            'local' => Languages::getNames(),
        ]);
    }

    public function update(Request $request) {

        $user = $request->user();

        $user->profile->fill( $request->all() )->save();

        return redirect()->route('dashboard.profile.edit')->with([
            'success' => 'Profile Updated'
        ]);
    }
}
