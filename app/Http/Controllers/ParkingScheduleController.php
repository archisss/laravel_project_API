<?php

namespace App\Http\Controllers;

use DB;
use App\Parking;
use Carbon\Carbon;  
use App\ParkingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ParkingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('action')=='drop'){
            //dd(Session::get('parking_id'));
            $ParkingSchedule = ParkingSchedule::findOrFail(Session::get('parking_id'));
            if($this->destroy($ParkingSchedule)=='OK'){
                return redirect()->route('parkings.index');
            }else{
                return "Error: in Controller on Destroy";
            }
        }
        if(Session::get('action')=='create'){
            if(ParkingSchedule::where('parking_id', '=', Session::get('parking_id'))->count()>=7){
                session()->forget('parking_id');
            }else{
                if($this->create()=='OK'){
                    return redirect()->route('parkings.index');
                }else{
                    return "Error: in Controller on Create";
                }              
            }
        }
        return redirect()->route('parkings.index');
        


       /* if(Session::get('parkingid')){
            if(ParkingSchedule::where('parking_id', '=', Session::get('parkingid'))->count()>=7){
                session()->forget('parking_id');
            }else{
                $this->create();            
            }
            //return redirect()->route('parkings.index');   
        }
        if(Session::get('parkingiddelete')){
            dd(Session::get('parkingiddelete'));
            $ParkingSchedule = ParkingSchedule::findOrFail(Session::get('parkingiddelete'));
            $this->destroy($ParkingSchedule);
        }    
        dd("no hay nada");
        //return redirect()->route('parkings.index'); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        for ($i = 1; $i <= 7; $i++) {
            if($i>5){
                $parkingSchedule = new ParkingSchedule([
                    'parking_id' => Session::get('parking_id'),
                    'day' => $this->getDia($i),
                    'start_time' => '09:00:00',
                    'end_time' => '14:00:00',
                ]);
                $parkingSchedule->save();
            }else{
                $parkingSchedule = new ParkingSchedule([
                    'parking_id' => Session::get('parking_id'),
                    'day' => $this->getDia($i),
                    'start_time' => '09:00:00',
                    'end_time' => '18:00:00',
                    'active' => 1,
                ]);
                $parkingSchedule->save();   
            }
            
        }        
        Session::forget('parking_id');
        return 'OK';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* if(Session::get('parkingid')){
        return 'crear instancia';
        } 
        return $parkingSchedule;*/  

        return "hola desde el STORE";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParkingSchedule  $parkingSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingSchedule $parkingSchedule)
    {   
        //dd($parkingSchedule);
        $parkingSchedules = ParkingSchedule::where('parking_id', '=' ,$parkingSchedule->parking_id)->findOrFail($parkingSchedule);
        
        //$parkingSchedules = DB::table('parking_schedules')->where('parking_id', $parkingSchedule->parking_id);
        //regresa un array único entonces se tiene que cambiar enl a vista por [] porque no es un objeto
        //dd($parkingSchedules);
        return view('parkings_schedule.show', compact('parkingSchedules'));    
    }

    public function editar(ParkingSchedule $parkingSchedule, $day)
    {  
       $parking = ParkingSchedule::where('id', '=' ,$day)->findOrFail($parkingSchedule);
       return view('parkings_schedule.editar', compact('parking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParkingSchedule  $parkingSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkingSchedule $parkingSchedule)
    {
    // dd($request);

        
        $start =($request->day).'start';
        $end =($request->day).'end';
       // dd($start);
        $request->validate([
            'day_to_update'  => 'required|numeric',
            $start => 'required',
            $end => 'required',
            'active' => 'required|in:0,1',
        ]);
        
        DB::table('parking_schedules')
        ->where('parking_id', $request->father)
        ->where('id', $request->day_to_update)->update([
            'start_time' => $request->$start,
            'end_time' => $request->$end,
            'active' => $request->active,
            "updated_at" => Carbon::now()
        ]); 
        return redirect('parking_schedule/'.$request->father); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParkingSchedule  $parkingSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingSchedule $parkingSchedule)
    {
        //dd($parkingSchedule);
        DB::table('parking_schedules')->where('parking_id', $parkingSchedule->parking_id)->delete();
        return 'OK';      
    }

    public function getDia($dia){       
        $weekMap = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo',
        ];
        return $weekMap[$dia];
    }
}
