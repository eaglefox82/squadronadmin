<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\User;
use Alert;
use Auth;
use Image;
use DefaultProfileImage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        $img = DefaultProfileImage::create($request->get('firstname')." ".$request->get('lastname'),300);
        $filename = time() . '.png';
        Storage::disk('profile')->put($filename, $img->encode());


        $e = New User();
        $e->firstname = $request->get('firstname');
        $e->lastname = $request->get('lastname');
        $e->username = $request->get('username');
        $e->password = bcrypt($request->get('password'));
        $e->role_id = '1';
        $e->avatar = $filename;
        $e->save();

        Alert::Success('Member has been added')->autoclose(1500);
        return redirect(action('SettingsController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);

        return view('profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function update_avatar(Request $request){
        // Logic for user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.png';
            $img = Image::make($avatar)->resize(300, 300);
            Storage::disk('profile')->put($filename, $img->encode());
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile', ['user' => Auth::user()] );
    }
}
