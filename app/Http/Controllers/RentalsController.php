<?php

namespace App\Http\Controllers;

use DB;
use App\Parking;
use Carbon\Carbon;
use App\Rental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['pay','APInewReserve','APIcheckIn', 'APIcheckOut','APIcurrentRent','APIcancelReserve','APIgetRentals'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saldo = Rental::where('rental_status', '=', 'charging') // cajon al que se quiere hacer el checkin
        ->where('user_id', '=', Auth::user()->id)
        ->sum('total');
        
        $rentals = Rental::where('rentals.user_id', Auth::user()->id)
        ->select(['rentals.*','parkings.address'])
        ->join('parkings', 'parkings.id', '=', 'rentals.parking_id')
        ->get();

        
        return view('rentals.index', compact('rentals','saldo'));
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
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental $rental)
    {
        //
    }

    public function APInewReserve(Request $request){
        //Waiting status for the RENTAL
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'parking_id' => 'required|numeric', 
            'car_id' => 'required|numeric',        
        ]);
        //si no hay errores en los campos solicitados, se hace el insert
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            if (
                Rental::selectRaw("parking_id")
                ->where('parking_id', '=', $request->parking_id)
                ->where(function($q){
                    $q->where('rental_status', '=', 'waiting');
                    $q->orWhere('rental_status', '=', 'busy'); })
                ->exists()
                ) {
                return response()->json('This parkings is already taken', 404);   
            }else{
                Rental::create($request->all() + ['date' => Carbon::now('America/Mexico_City'), 'waiting_time' => Carbon::now('America/Mexico_City')->format('H:i:s')]);
                return response()->json('The reserve has created successfully, 15 minuts to check in', 200);  
            }
        }       
    }
    
    public function APIcheckIn(Request $request){        
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'parking_id' => 'required|numeric', 
            'car_id' => 'required|numeric',
        ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            if (Rental::where('parking_id', '=', $request->parking_id) // cajon al que se quiere hacer el checkin
                ->where('user_id', '=', $request->user_id)
                ->where('car_id', '=', $request->car_id)
                ->where('rental_status', '=', 'waiting')
                ->exists()) {
                
                DB::table('rentals')
                ->where('parking_id', $request->parking_id)
                ->where('user_id', $request->user_id)
                ->where('rental_status', 'waiting')
                ->update([
                    'start_time' => Carbon::now('America/Mexico_City')->format('H:i:s'),
                    'rental_status' => 'busy',
                    'updated_at' => Carbon::now()
                ]);
                return response()->json('The CheckIn has created successfully', 200); 
            }else{
                return response()->json('This Parkings is already taken', 404); 
            }
        }  
    }

    public function APIcheckOut(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'parking_id' => 'required|numeric', 
            'car_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            if (Rental::where('parking_id', '=', $request->parking_id) // cajon al que se quiere hacer el checkout
                ->where('user_id', '=', $request->user_id)
                ->where('car_id', '=', $request->car_id)
                ->where('rental_status', '=', 'busy')
                ->exists()) {
                    $parking_id = $request->parking_id;
                    DB::table('rentals')
                    ->where('parking_id', $request->parking_id)
                    ->where('user_id', $request->user_id)
                    ->where('rental_status', 'busy')
                    ->update([
                        'end_time' => Carbon::now('America/Mexico_City')->format('H:i:s'),
                        'rental_status' => 'timing',
                        'updated_at' => Carbon::now(),
                    ]);
                    
                    return $this->calcularCostos($parking_id); 
                    //return response()->json('The CheckOut successfully', 200);
            }else{
                return response()->json('This information for the CheckOut dosent exist', 404); 
            }
        
        }
        
        //return $this->calcularCostos(1); 
    }

    public function calcularCostos($parking_id){
        
        $rental_settings = Rental::where('parking_id', $parking_id)->get();
        
        $inicio = Carbon::parse($rental_settings[0]->start_time);
        $final = Carbon::parse($rental_settings[0]->end_time);

        //calculos 
        //$diferencia_min = ceil($final->diffInMinutes($inicio)/15);
        //$diferencia_humans = $final->diffForHumans($inicio); // 41 minutos despues
        //$diferencia_tot =  ($final->diff($inicio))->format('%H:%I:%S'); // 00:41:56 

        $parking_settings = Parking::find($parking_id);
        
        $total_min_x_cobrar = ceil($final->diffInMinutes($inicio)/$parking_settings->rentaltime); //rentaltime cada cuanto se cobra la comisión
        //dd($total_min_x_cobrar);
        $costo_total = $total_min_x_cobrar*$parking_settings->cost;
        //dd($costo_total);
       //dd($rental_settings);
        if (Rental::where('parking_id', '=', $parking_id) // cajon al que se quiere hacer el checkin
                ->where('user_id', '=', $rental_settings[0]->user_id)
                ->where('car_id', '=', $rental_settings[0]->car_id)
                ->where('rental_status', '=', 'timing')
                ->exists()) {
                    
                    DB::table('rentals')
                    ->where('parking_id', $parking_id)
                    ->where('user_id', $rental_settings[0]->user_id)
                    ->where('car_id', '=', $rental_settings[0]->car_id)
                    ->where('rental_status', 'timing')
                    ->update([
                        'total_time' => $final->diff($inicio)->format('%H:%I:%S'),
                        'total_minuts' => $total_min_x_cobrar,
                        'rental_status' => 'charging',
                        'cost' => $costo_total-($costo_total*.17),
                        'fee' => $costo_total*.17,
                        'user_fee' => $costo_total*.03,
                        'total' => $costo_total,
                        'updated_at' => Carbon::now(),
                    ]);
            return response()->json(['message' => 'The timing has been successfully', 'costo_total'=> $costo_total], 200); 
        }else{
            return response()->json('Error on timing process', 404); 
        }
    }
    
    public function APIcurrentRent(Request $request){
        $now = Carbon::parse(Carbon::now('America/Mexico_City')->format('H:i:s'));
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            if(Rental::where('user_id', '=', $request->user_id)
            ->where('rental_status', '=', $request->status)
            ->exists()){
                $listof = Rental::where('user_id', '=', $request->user_id)
                ->where('rental_status', '=', $request->status)
                ->get();
                $waiting_time_start_at = Carbon::parse($listof[0]->waiting_time);
                return $now->diff($waiting_time_start_at)->format('%H:%I:%S'); 
            }else{
                return response()->json('EL usuario no tiene rentas activas', 404); 
            }
              
        }
        
    }

    public function APIcancelReserve(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'parking_id' => 'required|numeric', 
            'car_id' => 'required|numeric',        
        ]);
        //si no hay errores en los campos solicitados, se hace el insert
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            if (Rental::where('parking_id', '=', $request->parking_id) // cajon al que se quiere hacer el checkin
                ->where('user_id', '=', $request->user_id)
                ->where('car_id', '=', $request->car_id)
                ->where('rental_status', '=', 'busy')
                ->exists()) { 
                return response()->json('This parkings is already taken can cancel reserve', 404);   
            }else{
                Rental::where('parking_id', '=', $request->parking_id) // cajon al que se quiere hacer el checkin
                ->where('user_id', '=', $request->user_id)
                ->where('car_id', '=', $request->car_id)
                ->where('rental_status', '=', 'waiting')
                ->update([
                    'rental_status' => 'cancel',
                    'updated_at' => Carbon::now()
                ]);
                return response()->json('The rental has canceled successfully', 200);  
            }
        }       
    }

    public function APIgetRentals(Request $request){
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',        
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            $rentals = Rental::where('user_id', '=', $request->user_id)
            ->get();
            //dd($rentals);
        }
        if(count($rentals)==0){
            return response()->json(
                'User do not have rentals yet'
            , 404);
        }else{
            return response()->json([
                'rental' => $rentals,
            ], 200); 
        }
        
    }

    public function pay(){
        app(PaymentsController::class)->index();
    }

    
}
