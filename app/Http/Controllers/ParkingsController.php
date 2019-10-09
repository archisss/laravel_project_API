<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Parking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use JD\Cloudder\Facades\Cloudder;

class ParkingsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['APIgetParking', 'APIgetNearParkings','APIgetParkingAll', 'distanc', 'APIgetNearParkingsbyLL'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $parkings = Parking::all();
            return view('parkings.index', compact('user','parkings'));

            /*if(Auth::user()->typeOf == 'webadmin'){
                //echo "si";
                //$users = $this->list();
                return view('parkings', compact('users'));
            }else{
                return view('parkings.index', compact('user'));
            } */
        }else {
            return view('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('parkings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request);
        $request->validate([
            'latitud'  => 'required|numeric',
            'longitud' => 'required|numeric',
            'address' => 'required|string',
            'zipcode' => 'required|numeric',
            'hasgate' => 'required',
            'image_front' => 'sometimes|file|image|max:5000',
            'image_inside' => 'sometimes|file|image|max:5000',
            'image_both' => 'sometimes|file|image|max:5000',
        ]);
        if (request()->hasFile('image_front')){
            request()->validate([
                'image_front' => 'file|image|max:5000', //maximo 5mb de peso
            ]);
        }
        if (request()->hasFile('image_inside')){
            request()->validate([
                'image_inside' => 'file|image|max:5000', //maximo 5mb de peso
            ]);
        }
        if (request()->hasFile('image_both')){
            request()->validate([
                'image_both' => 'file|image|max:5000', //maximo 5mb de peso
            ]);
        }
        $parking = new Parking([
            'user_id' => Auth::user()->getId(),
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'hasgate' => $request->hasgate,
            'size' => $request->size,
            /* Como son valores fijos se mandan por el modelo fijos
            'cost' => 15.00,
            'rentaltime' => 15.00,
            'waitingtime' => 15.00,
            'validated' => 0,*/
        ]);
        
        $parking->save(); 
        
        $this->cloudinaryUpload($parking->id, $request);

        //$this->storeImage($parking); // store images in local directory

        //funciona return redirect()->route('parkings.index'); 
        //Session::put('parkingid', $parking->id);
        //return redirect()->route('parking_schedule.store');
        return redirect()->route('parking_schedule.index')->with( ['action'=> 'create', 'parking_id' => $parking->id] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Parkings $id)
    {
        //$parkings = Parking::findOrFail($id);
        //dd($parkings);
        return view('parkings.show', compact('parkings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parkings = Parking::findOrFail($id);
        //dd($parkings);
        return view('parkings.edit', compact('parkings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'latitud'  => 'required|numeric',
            'longitud' => 'required|numeric',
            'address' => 'required|string',
            'zipcode' => 'required|numeric',
            'hasgate' => 'required',
            'image_front' => 'sometimes',//|file|image|max:5000',
            'image_inside' => 'sometimes',//|file|image|max:5000',
            'image_both' => 'sometimes',//|file|image|max:5000',
        ]);
        
        DB::table('parkings')->where('id', $id)->update([
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'hasgate' => $request->hasgate,
            'size' => $request->size,
            "updated_at" => Carbon::now()
        ]);
        $idpublicpic = Parking::where('id','=', $id)->get('pic_front');
        
        Cloudder::delete($idpublicpic);
        $this->cloudinaryUpload($id, $request);  
        

        //$this->storeImage(Parking::findOrFail($id));
        // session()->flash('message', 'Texto del message flash en la sesión');
        
        return redirect()->route('parkings.index');
    }

    public function cloudinaryUpload($parking, $request){
        if($request->has('image_front')){
            $todelete = Parking::where('id','=', $parking)->get('pic_front');
            if(isset($todelete[0]->pic_front)){
                Cloudder::delete($todelete[0]->pic_front);
            }

            $filename = $request->file('image_front')->getRealPath();
            Cloudder::upload($filename);
            DB::table('parkings')->where('id', $parking)->update([
                'pic_front' => Cloudder::getPublicId(),
                'updated_at' => Carbon::now()
            ]);
        }
        if($request->has('image_inside')){
            $todelete = Parking::where('id','=', $parking)->get('pic_inside');
            if(isset($todelete[0]->pic_inside)){
                Cloudder::delete($todelete[0]->pic_inside); 
            }

            $filename = $request->file('image_inside')->getRealPath();
            Cloudder::upload($filename);
            DB::table('parkings')->where('id', $parking)->update([
                'pic_inside' => Cloudder::getPublicId(),
                'updated_at' => Carbon::now()
            ]);
        }
        if($request->has('image_both')){
            $todelete = Parking::where('id','=', $parking)->get('pic_both');
            if(isset($todelete[0]->pic_both)){
                Cloudder::delete($todelete[0]->pic_both);   
            }
            

            $filename = $request->file('image_both')->getRealPath();
            Cloudder::upload($filename);
            DB::table('parkings')->where('id', $parking)->update([
                'pic_both' => Cloudder::getPublicId(),
                'updated_at' => Carbon::now()
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('en detroy');
        //Session::put('parkingiddelete', $id);
        //dd($id);
        $parkings = Parking::findOrFail($id);

        //$imagefolder = public_path('storage/uploads/'.$parkings->user_id.'/parkings/'.$parkings->id);

        $parkings->delete();

        /*if (File::exists($imagefolder)) { // unlink or remove previous image from folder
            File::deleteDirectory($imagefolder);
        } */   
        //dd(Session::put('parkingiddelete', $id));
        return redirect()->route('parking_schedule.index')->with( ['action'=> 'drop', 'parking_id' => $parkings->id] );
    }

    public function deleteParking($id){
        dd($id);
    }

    public function list(){
        $parkings = Parking::all();
        return $parkings;
    }

    public function storeImage($parking){
        //dd($parking);        
        if(request()->has('image_front')){
            $parking->update([
                'pic_front' => request()->image_front->store('uploads/'.$parking->user_id.'/parkings/'.$parking->id,'public'),
            ]);
            $image_front = Image::make(public_path('storage/'.$parking->pic_front))->fit(1234,706);
            $image_front->save();
        }
        if(request()->has('image_inside')){
            $parking->update([
                'pic_inside' => request()->image_inside->store('uploads/'.$parking->user_id.'/parkings/'.$parking->id,'public'),
            ]);
            $image_inside = Image::make(public_path('storage/'.$parking->pic_inside))->fit(1234,706);
            $image_inside->save();
        }
        if(request()->has('image_both')){
            $parking->update([
                'pic_both' => request()->image_both->store('uploads/'.$parking->user_id.'/parkings/'.$parking->id,'public'),
            ]);
            $image_inside = Image::make(public_path('storage/'.$parking->pic_both))->fit(1234,706);
            $image_inside->save();
        }
    }

    public function APIgetParkingAll(){
        $parking_info_JSON = Parking::all();
        if(count($parking_info_JSON)==0){
            return response()->json([
                'message' => 'Not Parkings found',
            ], 404);
        }else{
            return response()->json([
                'parking' => $parking_info_JSON,
            ], 200); 
        }
    }

    public function APIgetParking(Request $request){
        //dd($request->parking_id);
        $parking_info_JSON = Parking::with('user','schedules')->where('id','=', $request->parking_id)->get();//->toJSON(); //<- regresa en formato JSON
        //$parking = collect($parking_info_JSON)->toArray();
        //dd(count($parking_info_JSON)==0);

        if(count($parking_info_JSON)==0){
            return response()->json([
                'message' => 'Not Parking found',
            ], 404);
        }else{
            return response()->json([
                'parking' => $parking_info_JSON,
            ], 200); 
        }
    }

    public function APIgetNearParkings(Request $request){
        $parking = Parking::find($request->parking_id); //Parking send by API
        $parkings = DB::table('parkings')
            ->where('id','!=', $parking->id)
            ->whereRaw('calc_distance(parkings.latitud,parkings.longitud, '.$parking->latitud.', '.$parking->longitud.') <= 15')
            ->select('id','address','zipcode',
            \DB::Raw('calc_distance(parkings.latitud, parkings.longitud, '.$parking->latitud.','.$parking->longitud.') as distance'))
            ->orderBy('distance', 'desc')
            ->tosql();
            dd($parkings);

        if(count($parkings)==0){
            return response()->json(
                'Not Parkings around found'
            , 404);
        }else{
            return response()->json(
                $parkings
            , 200); 
        }
        //return response()->json($parkings, 200, [], JSON_PRETTY_PRINT);
    }

    public function APIgetNearParkingsbyLL(Request $request){
        $parkings = DB::table('parkings')
            //->where('id','!=', $parking->id)
            ->whereRaw('(6353 * 2 * ASIN(SQRT( POWER(SIN((parkings.latitud - abs('.$request->latitud.')) * pi()/180 / 2),2) + COS(parkings.latitud * pi()/180 ) * COS( abs('.$request->latitud.') * pi()/180) * POWER(SIN((parkings.longitud - '.$request->longitud.') * pi()/180 / 2), 2) )))<=15')
            ->select('*',
            \DB::Raw('(6353 * 2 * ASIN(SQRT( POWER(SIN((parkings.latitud - abs('.$request->latitud.')) * pi()/180 / 2),2) + COS(parkings.latitud * pi()/180 ) * COS( abs('.$request->latitud.') *  pi()/180) * POWER(SIN((parkings.longitud - '.$request->longitud.') * pi()/180 / 2), 2) ))) as distance'))
            ->orderBy('distance', 'desc')
            ->get();

        if(count($parkings)==0){
            return response()->json(
                'Not Parkings around found'
            , 404);
        }else{
            return response()->json(
                $parkings
            , 200); 
        }
    }

    public function distanc(Request $request){
        $parking = Parking::find($request->parking_id); //Parking send by API
        $parkings = DB::table('parkings')
            ->where('id','!=', $parking->id)
            ->whereRaw('(6353 * 2 * ASIN(SQRT( POWER(SIN((parkings.latitud - abs('.$parking->latitud.')) * pi()/180 / 2),2) + COS(parkings.latitud * pi()/180 ) * COS( abs('.$parking->latitud.') * pi()/180) * POWER(SIN((parkings.longitud - '.$parking->longitud.') * pi()/180 / 2), 2) )))<=15')
            ->select('*',
            \DB::Raw('(6353 * 2 * ASIN(SQRT( POWER(SIN((parkings.latitud - abs('.$parking->latitud.')) * pi()/180 / 2),2) + COS(parkings.latitud * pi()/180 ) * COS( abs('.$parking->latitud.') *  pi()/180) * POWER(SIN((parkings.longitud - '.$parking->longitud.') * pi()/180 / 2), 2) ))) as distance'))
            ->orderBy('distance', 'desc')
            ->get();

        if(count($parkings)==0){
            return response()->json(
                'Not Parkings around found'
            , 404);
        }else{
            return response()->json(
                $parkings
            , 200); 
        }
    }

    public function qrcode($parking){
        return view('parkings/qrcode', compact('parking'));
    }

    public function pdfqrcode($parking){
        $data = [
            'id' => $parking,
            ];
        $pdf = PDF::loadview('parkings/pdfqrcode', $data);
        return $pdf->stream();
    }

}
