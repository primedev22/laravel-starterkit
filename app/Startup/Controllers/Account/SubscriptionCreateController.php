<?php

namespace Startup\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionCreateController extends Controller
{
    public function index(Request $request)
    {
        $plans = collect(config('subscription.plans'))->where('active', true);

        return view('startup::account.subscribe.index', compact('plans'));
    }

    public function process(Request $request)
    {
        $plans = collect(config('subscription.plans'))->where('active', true);
        $selectedPlan = $plans->where('stripe_id', $request->get('plan'))->first();

        if (!$selectedPlan) {
            return redirect()->route('plans.index')->withError('There was a problem. Please select another plan.');
        }

        $request->account()->createSubscription($selectedPlan['stripe_id'], $request->get('stripe_token'));

        return redirect()->route('account.subscription.details')->withSuccess('Your subscription has started!');
    }
}