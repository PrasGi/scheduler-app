<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $datas = User::where('id', '!=', auth()->id());

        if ($request->search) {
            $datas->search($request->search);
        }

        $datas = $datas->get();

        return view('pages.user', compact('datas'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back();
    }
}
