<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingState;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {

        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    public function charge(Request $request){
        $booking = Booking::find($request->booking_id);
        if($booking->user_id != Auth::id()){
            return redirect()->back();
        }
        if($booking->paid == 1){
            return redirect()->back()->with('warning', 'Esta reserva ya ha sido pagada');;
        }
        $response = $this->gateway->purchase(array(
            'amount' => $booking->total_amount,
            'currency' => env('PAYPAL_CURRENCY'),
            'returnUrl' => url('success'),
            'cancelUrl' => url('error'),
        ))->send();
        $booking->payment_id = $response->getData()["id"];
        $booking->save();
        if ($response->isRedirect()) {
            $response->redirect();
        } else {
            // not successful
            return $response->getMessage();
        }
    }

    public function success(Request $request)
    {

        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr_body = $response->getData();
                // Inserta los datos de transaccion en la bd
                $payment = Payment::create([
                    'payment_id' => $arr_body['id'],
                    'payer_id' => $arr_body['payer']['payer_info']['payer_id'],
                    'payer_email' => $arr_body['payer']['payer_info']['email'],
                    'amount' => $arr_body['transactions'][0]['amount']['total'],
                    'currency' => env('PAYPAL_CURRENCY'),
                    'payment_status' => $arr_body['state'],
                ]);

                $state = BookingState::where('name','Reservado')->first();
                //Cambio estado booking
                $booking = Booking::where('payment_id',$request->input('paymentId'))
                    ->where("user_id",Auth::id())->first();
                $booking->booking_state_id = $state->id;
                $booking->paid = 1;
                $booking->save();
                return redirect()->route('profile.edit')
                    ->with('status', 'Pago realizado correctamente');

            } else {
                return $response->getMessage();
            }
        } else {
            return redirect()->route('profile.edit')->with('error', 'Pago cancelado.');
        }
    }


    public function error()
    {
        return redirect()->route('profile.edit')->with('error', 'Pago cancelado.');
    }
}
