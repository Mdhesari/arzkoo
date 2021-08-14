<?php

namespace App\Http\Controllers;

use App\Events\NewSubmittedRating;
use App\Models\Exchanges\Exchange;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Exchange $exchange)
    {
        $request->validate([
            'ease_of_use_range' => 'required|numeric',
            'verification_range' => 'required|numeric',
            'support_range' => 'required|numeric',
            'value_for_money_range' => 'required|numeric',
        ]);

        $rating = new Rating($request->all());
        $rating->user_id = $request->user()->id;
        $rating->average = ($rating->ease_of_use_range + $rating->support_range + $rating->value_for_money_range + $rating->verification_range) / 4;

        $exchange->ratings()->save($rating);

        $exchange->calcAverageRate();

        $exchange->updateRatingsAvg();

        event(new NewSubmittedRating($rating));

        return back()->with('success', 'نظر شما با موفقیت ثبت شد.');
    }
}
