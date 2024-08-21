<?php

namespace App\Actions\Frontend;

use Carbon\Carbon;

class ProfileUpdate
{
    public static function update($request, $customer)
    {
        $show_phone = $request->show_phone ?? 0;
        // dd($request->all());

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob ? Carbon::parse($request->dob) : null,
        ]);
        if ($request->password) {
            $customer->update(['password' => \Hash::make($request->password)]);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = uploadImage($request->image, "customer");
            $customer->update(['image' => $url]);
        }

        return $customer;
    }
}
