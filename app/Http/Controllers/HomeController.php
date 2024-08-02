<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Url;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->name == 'admin'){

            $shortLinks = Url::get();
            $user = User::where('is_admin',0)->count();

            return view('admin.home', compact('shortLinks','user'));

        }else{

            // $shortLinks = Url::with('user')->where('user_id', Auth::user()->id)->get()->groupBy('user.name');

            $shortLinks = User::with('urls')->where('id', Auth::user()->id)
            ->whereHas('urls',function ($q){
                $q->where('user_id', Auth::user()->id);
            })
            ->first();
            return view('home', compact('shortLinks'));
        }

    }
}
