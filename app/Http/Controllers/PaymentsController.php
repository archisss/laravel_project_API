<?php

namespace App\Http\Controllers;

use DB;
use App\Parking;
use Carbon\Carbon;
use App\Rental;
use App\User;
use App\Payment;
use Conekta\Order;
use Conekta\Conekta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index','APIprocessPayment','APIhasCreditcards','APIaddCreditcards'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        //revisar si tiene saldo pendiente por pagar el usuario 
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric'
        ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            if (Rental::where('rental_status', '=', 'charging') // cajon al que se quiere hacer el checkin
                ->where('user_id', '=', $request->user_id)
                ->exists()) {                
                    $saldo = Rental::where('rental_status', '=', 'charging') // cajon al que se quiere hacer el checkin
                    ->where('user_id', '=', $request->user_id)
                    ->sum('total');
                return response()->json([
                    'saldo' => $saldo,
                ], 200); 
            }else{
                return response()->json('Do not have payments to process', 404); 
            }
        } 
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function payment(Request $request){
        dd($request);
        Conekta::setApiKey(config('conekta.secret_key'));
        Conekta::setApiVersion("2.0.0");
        $tokencard = $request->conektaTokenId;
        try {

            $items = [
                ['name' => 'Product 1', 'unit_price' => number_format(300.00,2, '', ''), 'quantity' => 1,],
                ['name' => 'Product 2', 'unit_price' => number_format(999.99, 2, '', ''), 'quantity' => 1,],
            ];
            $customer = [
                'name'  => 'Nombre nuevo de prueba',
                'email' => 'esteban992521@gmail.com',
                'phone' => '553141743802',
            ];
            /** Solo requerido para productos fisicos */
            $contact_ship = [
                'address' => [
                    'street1'     => 'street name, number' ,
                    'postal_code' => '28860',
                    'country'     => 'MX',
                ],
            ];
            $shipping = [
                [
                    'amount' => 100, 
                    'carrier' => 'FEDEX',
                ],
            ];
            /*********************************************/
            $metadata = [
                'reference' => '12345678',
                'more_info' => 'esteban992521',
            ];
            $info_charge = [
                [
                    'payment_method' => [ 
                        'type' => 'card',
                        'token_id' => $tokencard,
                    ],
                ],
            ];

            $info_order = [
                'line_items'        => $items,
                //'shipping_lines'    => $shipping,
                'currency'          => 'MXN',
                'customer_info'     => $customer,
                //'shipping_contact'  => $contact_ship,
                'metadata'          => $metadata,
                'charges'           => $info_charge,
            ];

            $order = Order::create($info_order);
            dd($order);
        } catch (\Conekta\ProcessingError $error) {
            echo $error->getMessage();
        }catch (\Conekta\ParameterValidationError $error){
            echo $error->getMessage().' parameter';
        } catch (\Conekta\Handler $error){
            echo $error->getMessage();
        }     
    }


    public function APIprocessPayment(Request $request){
        //valido que los datos solicitados vengan
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'parking_id' => 'required|numeric', 
            'car_id' => 'required|numeric',
            'tocharge' => 'required|numeric|between:0,999.99'
        ]);
            //dd($request->tocharge);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            //valido que el user_id tenga al menos una tarjeta dada de alta 
            if (Payment::where('user_id', '=', $request->user_id)->exists()){ 
                $user_data = User::with('payments')->find($request->user_id);
                //dd($user_data->payments[0]->token_id);
                //para pagos recurrentes hacer un ciclo en el array de tokens del user_id
                Conekta::setApiKey(config('conekta.secret_key'));
                Conekta::setApiVersion("2.0.0");
                //$tokencard = $request->conektaTokenId; //-- esto se usa si despues de dar de alta la tarjeta generas el cobro
                try {
                    $items = [
                        ['name' => 'Cuota de estacionamiento Car-E', 'unit_price' => number_format($request->tocharge,2, '', ''), 'quantity' => 1,]
                        //['name' => 'Product 2', 'unit_price' => number_format(999.99, 2, '', ''), 'quantity' => 1,],
                    ];
                    $customer = [
                        'name'  => $user_data->name,
                        'email' => $user_data->email,
                        'phone' => $user_data->cellphone,
                    ];
                    $metadata = [
                        'reference' => 'Pago estacionamiento '. Carbon::now('America/Mexico_City')->toDateTimeString(),
                        'more_info' => 'Pago mediante la pasarela de pagos Conekta.io',
                    ];
                    $info_charge = [
                        [
                            'payment_method' => [ 
                                'type' => 'card',
                                'token_id' => $user_data->payments[0]->token_id, 
                                //NOTA: el usuario sólo debe de tener una tarjeta dada de alta o tomara siempre la primera en dado caso que tenga más de una 
                            ],
                        ],
                    ];

                    $info_order = [
                        'line_items'        => $items,
                        'currency'          => 'MXN',
                        'customer_info'     => $customer,
                        'metadata'          => $metadata,
                        'charges'           => $info_charge,
                    ];

                    $order = Order::create($info_order);
                    //actualizar status del parking a closed 
                    DB::table('rentals')
                    ->where('user_id', $request->user_id)
                    ->where('parking_id', $request->parking_id)
                    ->where('car_id', $request->car_id)
                    ->where('rental_status', 'charging')
                    ->update([
                        'rental_status' => 'closed',
                        'conekta_order_id' => $order->id,
                        'updated_at' => Carbon::now()
                    ]);
                    return response()->json('Successful Payment', 200); 
                } catch (\Conekta\ProcessingError $error) {
                    return response()->json($error->getMessage(), 404); 
                    //echo $error->getMessage();
                }catch (\Conekta\ParameterValidationError $error){
                    return response()->json($error->getMessage().' parameter', 404);
                    //echo $error->getMessage().' parameter';
                } catch (\Conekta\Handler $error){
                    return response()->json($error->getMessage(), 404);
                    //echo $error->getMessage();
                }  
            }else{
                return response()->json('Do not have Credit cards Added', 404); 
            } 
        }  
       
    }

    public function addClient(){ 
        Conekta::setApiKey(config('conekta.secret_key'));
        Conekta::setApiVersion("2.0.0");
        try{       
        $customer = \Conekta\Customer::create(
            array(
              'name'  => "Mario Perez",
              'email' => "usuario@example.com",
              'phone' => "+5215555555555",
              'payment_sources' => array(array(
                  'token_id' => "tok_test_visa_4242",
                  'type' => "card"
              ))
              /*,
              'shipping_contacts' => array(array(
                'phone' => "+5215555555555",
                'receiver' => "Marvin Fuller",
                'address' => array(
                  'street1' => "Nuevo Leon 4",
                  'street2' => "fake street",
                  'country' => "MX",
                  'postal_code' => "06100"
                )
              ))*/
            )
          );
        }catch (\Conekta\ProcessingError $error) {
            echo $error->getMessage();
        }catch (\Conekta\ParameterValidationError $error){
            echo $error->getMessage().' parameter';
        } catch (\Conekta\Handler $error){
            echo $error->getMessage();
        } 
        dd($customer);
    }

    public function token(Request $request){
        //dd('en Token controller');
        Conekta::setApiKey(config('conekta.secret_key'));
        Conekta::setApiVersion("2.0.0");
        $tokencard = $request->conektaTokenId;
        dd($tokencard);
    }

    public function APIhasCreditcards(Request $request){
        //revisar si tiene saldo pendiente por pagar el usuario 
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric'
        ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            if (Payment::where('user_id', '=', $request->user_id) // cajon al que se quiere hacer el checkin
                ->exists()) {                
                    $token_id = Payment::where('user_id', '=', $request->user_id)
                    ->get('token_id');
                return response()->json([
                    'CreditCarsToken' => $token_id,
                ], 200); 
            }else{
                return response()->json('Do not have Credit cards', 404); 
            }
        } 
    }

    public function APIaddCreditcards(Request $request){
        //revisar si tiene saldo pendiente por pagar el usuario 
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'token_id' => 'required',
        ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            if (Payment::where('user_id', '=', $request->user_id) // cajon al que se quiere hacer el checkin
                ->exists()) {
                
                    DB::table('conekta')
                    ->where('user_id', $request->user_id)
                    ->update([
                        'token_id' => $request->token_id,
                        'updated_at' => Carbon::now()
                    ]);
                    return response()->json('The token has benn updated successfully', 200); 
                }else{
                    Payment::create($request->all());
                    return response()->json('The User and token has benn created successfully', 200); 
                }
        } 
    }
}
