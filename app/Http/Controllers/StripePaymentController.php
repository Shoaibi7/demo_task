<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;


class StripePaymentController extends Controller
{
    public function stripe(Request $request)
    {               
        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $total_price = $request->price;
        

        return view('payment.stripe',compact('product_id','total_price','product_name'));
    }
    public function stripePost(Request $request)
    {
        $user=Auth()->user();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $request->price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment Added Successfully." 
        ]);
      
        Session::flash('success', 'Payment Added Successful!');
        Cart::where('user_id',$user->id)->where('product_id',$request->product_id)->delete();
              
        return redirect('products');
    }

}
