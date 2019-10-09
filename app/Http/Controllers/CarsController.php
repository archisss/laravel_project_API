<?php

namespace App\Http\Controllers;

use App\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['APIaddCar', 'APIgetUserCars', 'show','APIeditCar'] ]);
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('show');
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
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        $cars = Car::find($car); //<- find an specific card id
        return view('cars.show', compact('cars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }

    public function list()
    {
        //Show the list of cars for the logged user;
        $cars = Car::where('user_id','=', Auth::user()->id)->get();
        return view('cars.show', compact('cars'));
    }

    public function APIaddCar(Request $request){
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'marca' => 'required', 
            'model' => 'required',
            'picture' => 'sometimes', //|file|image|max:5000',
            'year' => 'required',
            'registrationnumber' => 'required', //|unique:cars,matricula',
        ]);

        if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
        }

        Car::create($request->all());

        return response()->json('This Car was created successfully', 200);
    }

    public function APIgetUserCars(Request $request){
        $cars = Car::where('user_id','=', $request->user_id)->get();
        
        if(count($cars)==0){
            return response()->json(
                'No Cars found'
            , 404);
        }else{
            return response()->json(
                $cars
            , 200); 
        }
    }

    public function APIeditCar(Request $request){
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'car_id' => 'required|numeric', 
            'marca' => 'required',
            'model' => 'required',
            'color' => 'required',
            'year' => 'required',
            'picture' => 'sometimes', //|file|image|max:5000',
            'registrationnumber' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }else{
            Car::where('user_id', '=', $request->user_id) // cajon al que se quiere hacer el checkin
                ->where('id', '=', $request->car_id)
                ->update([
                    'marca' => $request->marca,
                    'model' => $request->model,
                    'color' => $request->color,
                    'year' => $request->year,
                    'picture' => $request->picture,
                    'registrationnumber' => $request->registrationnumber,
                    'updated_at' => Carbon::now()
                ]);
                return response()->json('The car has updated successfully', 200);
        }        
    }
}
