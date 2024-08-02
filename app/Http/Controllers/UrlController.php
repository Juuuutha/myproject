<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Url;

class UrlController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $url = new Url;
        $url->user_id = Auth::user()->id;
        $url->original_url = $request->original_url;
        $url->short_url = Str::random(5);
        $url->save();

        return redirect(route('home')) ->with('success', 'Shorten Link Generated Successfully!');;
    }


    public function shortenLink($code)
    {
        $find = Url::where('short_url', $code)->first();
        return redirect($find->original_url);
    }


    public function deleteUrl(Request $req)
    {
        $Url = Url::find($req->url_id);
        if($Url != null) {

            DB::beginTransaction();

          $Url->delete();

            DB::commit();
                return 'success';

        }else{

            return 'error';
        }
    }

    public function editUrl(Request $request)
    {
        DB::beginTransaction();
        $url =  Url::where('id', $request->url_id)->first();
        $url->original_url = $request->original_url;
        $url->short_url = Str::random(5);
        $url->save();
        DB::commit();

        return redirect(route('home')) ->with('success', 'Update shorten Link Generated Successfully!');;
    }
}
