<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PaymentMethod\{ IndexPaymentMethod, ShowPaymentMethod, StorePaymentMethod, DestroyPaymentMethod, CreateSetupIntent };
use App\Models\PaymentMethod;
use Symfony\Component\HttpFoundation\Request;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class PaymentMethodController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the payment_methods.
     *
     * @param  \App\Http\Requests\Api\v1\PaymentMethod\IndexPaymentMethod  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexPaymentMethod $request)
    {
        $fields = $request->validated();
        $paymentMethods = auth()->user()->paymentMethods();

        return $paymentMethods;
    }

    /**
     * Display the specified payment_method.
     *
     * @param  \App\Models\PaymentMethod  $payment_method
     * @param  \App\Http\Requests\Api\v1\PaymentMethod\ShowPaymentMethod  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, ShowPaymentMethod $request)
    {
        $paymentMethod = auth()->user()->findPaymentMethod($id);
        auth()->user()->updateDefaultPaymentMethod($id);
        return $paymentMethod;
    }

    /**
     * Store a newly created payment_method in storage.
     *
     * @param  \App\Http\Requests\Api\v1\PaymentMethod\StorePaymentMethod  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentMethod $request)
    {
        $fields = $request->validated();

        $payment_method = auth()->user()->addPaymentMethod($fields['payment_method_id']);

        return $payment_method;
    }

    /**
     * Remove the specified payment_method from storage.
     *
     * @param  \App\Models\PaymentMethod  $payment_method
     * @param  \App\Http\Requests\Api\v1\PaymentMethod\DestroyPaymentMethod  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DestroyPaymentMethod $request)
    {
        $paymentMethod = auth()->user()->findPaymentMethod($id);
        $paymentMethod->delete();
        return response()->json(null, 204);
    }

    /**
     * Returns a Stripe 'Setup Intent" object
     *
     * @param  \App\Models\Subscription  $subscription
     * @param  \App\Http\Requests\Api\v1\Subscription\ShowSubscription  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createSetupIntent(Request $request)
    {
        $user = auth()->user();
        $user->createOrGetStripeCustomer();
        return $user->createSetupIntent();
    }
}
