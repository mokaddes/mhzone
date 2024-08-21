<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request){

        DB::beginTransaction();
        try {

        $request->validate([
            'stars' => 'required',
            'comment' => 'required|string|max:250'
        ]);

        if($request->ad_id==Auth::user()->id){
            return redirect()->back()->with('error','You can\'t review yourself. Thanks');
        }
        $result = DB::table('reviews')->where('user_id', Auth::user()->id)->where('ad_id', $request->ad_id)->first();
        if(isset($result)){
            return back()->with('error', "Sorry You Can not Review Second time.");
        }else{

            DB::table('reviews')->insert([
                'ad_id' => $request->ad_id,
                'order_id' => $request->order_id,
                'user_id' => Auth::user()->id,
                'stars' => $request->stars,
                'comment' => $request->comment,
                'status' => 1,
              
            ]);
        }
        
    } catch (\Exception $e) {
        dd($e->getMessage());
        DB::rollback();
        return redirect()->back()->with('error','Something wrong! Please try again');
    }
    DB::commit();
    return redirect()->back()->with('success','Review submitted successfully');
}

}