<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Settings;
use App\OtherItemMapping;
use App\OtherItem;
use App\User;
use App\PointsMaster;
use Alert;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settings = Settings::orderby('id')->get();
        $otheritems = OtherItemMapping::where('active', '=', "Y")->get();
        $users = User::all();
        $points = PointsMaster::all();
        return view('settings.index', compact('settings', 'otheritems', 'users', 'points'));
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
        $validateData = Validator::make($request->all(),[
         'setting' => 'required',
         'value' => 'required',
        ]);

        $e = new Settings();
        $e->setting = $request->get('setting');
        $e->value = $request->get('value');
        $e->save();

        Alert::Success('New Value has been added')->autoclose(2000);
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
        $setting = Settings::find($id);

        if ($setting != null)
        {
            return view('settings.edit', compact('setting'));
        }
        return redirect(action('SettingController@index'));
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
        $validateData = Validator::make($request->all(), [
            'setting' => 'required',
            'value' => 'required',
        ]);

        if ($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData)->withInput();
        }

        $setting = Settings::find($id);
        $setting->setting = $request->get('setting');
        $setting->value = $request->get('value');
        $setting->save();

        /** Sweet Alert */
        Alert::toast('Setting Updated', 'success', 'top');

        return redirect(action('SettingsController@index'))->with('sucess', 'Setting Updated');
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
}
