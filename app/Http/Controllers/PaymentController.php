<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Http\Requests\Payments\AuthorizeNetPaymentStoreRequest;

use App\Models\PreprocessTicket;
use App\Models\Ticket;
use App\Models\AuthorizeNetPayment;

use Log;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('AuthorizeNetApi_Api');
        $this->gateway->setAuthName(config('authorizenet.login_id'));
        $this->gateway->setTransactionKey(config('authorizenet.transaction_key'));
        $this->gateway->setTestMode(config('authorizenet.test_mode'));
    }

    public function index($id, $passenger, $arrival, $departure)
    {
        $ticket = PreprocessTicket::find($id);

        if($ticket->payment_status === 'Paid') {
            return redirect()->route('ticket.status', [ 'paid' ]);
        }

        if($ticket->is_cancelled) {
            return redirect()->route('ticket.status', [ 'cancelled' ]);
        }

        $trip_time = $ticket->trip_time ? $ticket->trip_time->formatted_time : now()->format('h:i A');
        $travel_date = Carbon::parse($ticket->trip->date)->format('Y-m-d'). ' '. $trip_time;
        
        $period = CarbonPeriod::create('now', '12 months', 25);
        $years = [];

        foreach($period as $date) {
            $years[] = $date->format('y');
        }

        return view('pages.payment.index', [
            'ticket' => $ticket,
            'travel_date' => $travel_date,
            'years' => $years,
        ]);
    }

    public function payment(AuthorizeNetPaymentStoreRequest $request, $id, $passenger, $arrival, $departure)
    {
        Log::info('Payment Running...');
        try {   
            $preprocess_ticket = PreprocessTicket::find($id);

            $credit_card = new \Omnipay\Common\CreditCard([
                'number' => $request->cc_number,
                'expiryMonth' => $request->expiry_month,
                'expiryYear' => $request->expiry_year,
                'cvv' => $request->cvv,
            ]);

            $transaction_id = rand(100000000, 999999999).''.time();

            $response = $this->gateway->authorize([
                'amount' => $request->amount,
                'currency' => 'USD',
                'transactionId' => $transaction_id,
                'card' => $credit_card
            ])->send();

            Log::info('Response : '. $response->isSuccessful());

            if($response->isSuccessful()) {
                $transaction_reference = $response->getTransactionReference();
                Log::info('Transaction Reference : '. $transaction_reference);

                $response = $this->gateway->capture([
                    'amount' => $request->amount,
                    'currency' => 'USD',
                    'transctionReference' => $transaction_reference
                ])->send();
                // $transaction_id = $response->getTransactionReference();

                $preprocess_ticket->update([
                    'payment_status' => 'Paid',
                    'confirmed' => true,
                    'confirmation_date' => now(),
                    'purchase_date' => now(),
                    'payment_method' => 'Credit Card',
                ]);

                $ticket = Ticket::create([
                    'passenger_id' => $preprocess_ticket->passenger_id,
                    'seller_id' => $preprocess_ticket->seller_id,
                    'arrival_id' => $preprocess_ticket->arrival_id,
                    'departure_id' => $preprocess_ticket->departure_id,
                    'trip_id' => $preprocess_ticket->trip_id,
                    'bus_model_column_id' => $preprocess_ticket->bus_model_column_id,
                    'number_of_ticket' => $preprocess_ticket->number_of_ticket,
                    'total_sale' => $preprocess_ticket->total_sale,
                    'payment_method' => $preprocess_ticket->payment_method,
                    'payment_status' => $preprocess_ticket->payment_status,
                    'boarding_status' => $preprocess_ticket->boarding_status,
                    'reservation_date' => $preprocess_ticket->reservation_date,
                    'purchase_date' => $preprocess_ticket->purchase_date,
                    'voucher_code' => $preprocess_ticket->voucher_code,
                    'new_seat_id' => $preprocess_ticket->new_seat_id,
                    'is_registered_payment' => $preprocess_ticket->is_registered_payment,
                    'office_id' => $preprocess_ticket->office_id,
                    'trip_time_id' => $preprocess_ticket->trip_time_id,
                    'driver_id' => $preprocess_ticket->driver_id
                ]);

                $amount = $request->amount;
                
                $payment_exist = AuthorizeNetPayment::where('transaction_id', $transaction_reference)->first();

                if(!$payment_exist) {
                    AuthorizeNetPayment::create([
                        'transaction_id' => $transaction_reference,
                        'amount' => $request->amount,
                        'currency' => 'USD',
                        'payment_status' => 'Captured',
                        'ticket_id' => $ticket->id,
                        'preprocess_ticket_id' => $preprocess_ticket->id,
                        'passenger_id' => $ticket->passenger->id,
                    ]);
                }


                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful. Thank you!',
                    'title' => 'Success.',
                    'redirect' => route('ticket.status', [ 'paid', $ticket->id, $ticket->passenger->fullname, $ticket->arrival->name, $ticket->departure->name ])
                ]);
            } else {
                Log::info('Failed Response : '. $response->getMessage());
                return $response->getMessage();
            }
        } catch (Exception $e) {
            Log::info('Catch Error Response : '. $e->getMessage());
            return $e->getMessage();
        }
    }
}
