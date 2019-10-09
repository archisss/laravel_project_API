<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use JD\Cloudder\Facades\Cloudder;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::check()) {
            $user = Auth::user();
            if(Auth::user()->typeOf == 'webadmin'){
                //echo "si";
                $users = $this->list();
                return view('user.list', compact('users'));
            }else{                
                return view('user.index', compact('user'));
            } 
        }else {
            return view('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'avatar' => 'sometimes', //|file|image|max:5000',
            'facebookID' => 'sometimes|string',
            'cellphone' => 'required|numeric|min:10',
        ]);
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'typeOf' => 'api',
            'api_token' => str_random(60),
            'avatar'    => $request->avatar,
            'facebookID'=> $request->facebookID,
            'cellphone'    => $request->cellphone,
        ]);
        $user->save();

        return response()->json([
           // 'message' => 'Successfully created user!',
           // 'newUser' => $user
           $user
        ], 201);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::all();
        return $users;
        //dd(Auth::user());
        /*$user = Auth::findOrFaild(Auth::user()->id);

        return view('user.index', compact('user'));*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('user.edit', compact('user'));
        }else {
            return view('/home');
        }
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
        //dd($request->avatar);
        $request->validate([
            'name'  => 'required|string',
            'cellphone' => 'required|numeric|min:10',
            'avatar' => 'sometimes', //|file|image|max:5000',
        ]);
        
        if(request()->has('avatar')){
            $actual_Avatar = User::where('id','=', $id)->get('avatar');
            if(isset($actual_Avatar[0]->avatar)){
                Cloudder::delete($actual_Avatar[0]->avatar);
            }
            
            $filename = $request->file('avatar')->getRealPath();
            Cloudder::upload($filename); //, array('folder' => 'Car-E/ProfilePictures'));

            DB::table('users')->where('id', $id)->update([
                'avatar' => Cloudder::getPublicId(), 
                'updated_at' => Carbon::now()
            ]);
        }
        $user = Auth::user();
        //$user->update($request->all());

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'cellphone' => $request->cellphone,
            'updated_at' => Carbon::now()
        ]);
    
        //$this->storeImage($user); //save image in local storage
        
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list(){
        //echo "list";
        //$users = User::where('id', '!=', Auth::user()->getId());
        $users = User::all();
        return $users;
    }

    public function storeImage($user){
        if(request()->has('avatar')){

        $avatarfolder = public_path('storage/uploads/'.$user->id.'/avatar');

        if (File::exists($avatarfolder)) { // unlink or remove previous image from folder
            File::deleteDirectory($avatarfolder);
        }
            $user->update([
                'avatar' => request()->avatar->store('uploads/'.$user->id.'/avatar','public'),
            ]);
            $avatar_user = Image::make(public_path('storage/'.$user->avatar))->fit(160,160);
            $avatar_user->save();
        }
    }

    public function getUser(Request $request){
        switch($request->with){
            case 'facebookID':
                $info = User::where('facebookID','=',$request->data)->get();
                break;
            case 'email':
                $info = User::where('email','=',$request->data)->get();
                break;
            default:
                $info = response()->json([
                    'message' => 'Falta información para busqueda'], 404);
        }
        if($info->isempty()){
            $info = response()->json(['message' => 'usuario no localizado'], 404);
        }
        return $info;
    }

    public function documentos(){
        $user = Auth::user();
        return view('user.documentos', compact('user'));
    }

    public function documentos_upload(Request $request, $id){
        
        $request->validate([
            'identificacion'  => 'required|file',
            'docprobatorio' => 'required|file',
        ]);
        if(request()->has('identificacion')){
            $actual_identificacion = User::where('id','=', $id)->get('identificacion');
            if(isset($actual_identificacion[0]->identificacion)){
                Cloudder::delete($actual_identificacion[0]->identificacion);
            }
            
            $filename = $request->file('identificacion')->getRealPath();
            Cloudder::upload($filename); 
            $identificacion_publicid_cloudinary = Cloudder::getPublicId();
        }
        if(request()->has('docprobatorio')){
            $actual_docprobatorio = User::where('id','=', $id)->get('docprobatorio');
            if(isset($actual_docprobatorio[0]->docprobatorio)){
                Cloudder::delete($actual_docprobatorio[0]->docprobatorio);
            }
            
            $filename = $request->file('docprobatorio')->getRealPath();
            Cloudder::upload($filename); 
            $docprobatorio_publicid_cloudinary = Cloudder::getPublicId();
        }
        $user = Auth::user();

        DB::table('users')->where('id', $id)->update([
            'identificacion' => $identificacion_publicid_cloudinary,
            'docprobatorio' => $docprobatorio_publicid_cloudinary,
            'updated_at' => Carbon::now()
        ]);
        
        return redirect('user');
    }
}
