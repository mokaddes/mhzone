<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\Token;

class UserCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $card = UserCard::where('user_id', $id)->first();
        return view('front.user.saved_card', compact('card'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'card_number' => 'required',
                'exp_month' => 'required',
                'exp_year' => 'required',
                'cvc' => 'required',
            ],[
                'card_number.required' => 'The :attribute field is required',
                'exp_month.required' => 'The :attribute field is required',
                'exp_year.required' => 'The :attribute field is required',
                'cvc.required' => 'The :attribute field is required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'error' => $validator->errors()->all()]);
            }
        }
        $request->validate([
            'card_number' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvc' => 'required',
        ],[
            'card_number.required' => 'The :attribute field is required',
            'exp_month.required' => 'The :attribute field is required',
            'exp_year.required' => 'The :attribute field is required',
            'cvc.required' => 'The :attribute field is required',
        ]);

        $number = str_replace(' ', '', $request->get('card_number'));
        $id = Auth::user()->id;
        $name = $request->get('card_name');
        $cvc = $request->get('cvc');
        $month = ($request->get('exp_month'));
        $year = $request->get('exp_year');


        try {
            $token = getStripeToken($number, $month, $year, $cvc);
            Log::alert($token);
//            dd($token->card->brand);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'error' => [$e->getMessage()]]);
            }
            return back()->with('error', $e->getMessage());
        }

        $card = UserCard::where('user_id', $id)->first();
        if (!isset($card)) {
            $card = new UserCard();
        }

        $card->card_name = $name;
        $card->user_id = $id;
        $card->card_number = $number;
        $card->cvc = $cvc;
        $card->card_type = $token->card->brand ?? null;
        $card->exp_month = $month;
        $card->exp_year = $year;
        $card->save();
        Log::alert($card);

        if ($request->ajax()) {
            return response()->json(['status' => true, 'card' => $card]);
        }

        return back()->with('success', 'Card saved successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
