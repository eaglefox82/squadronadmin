<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\OtherItemMapping;



class OtherItemsController extends Controller
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
        return view('settings.item');
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
            'item' => 'required',
        ]);
        if ($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData)->withInput();
        }

        $item = new Otheritemmapping();
        $item->item = $request->get('item');
        $item->active = "Y";
        $item->amount = $request->get('amount');
        $item->type = "F";
        $item->save();

        return Redirect(action('SettingsController@index'))->with('success','Item Added');
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

    public function inactive($id)
    {
        $setting = OtherItemMapping::find($id);

        if($setting != null)

        {
            $setting->active = "N";
            $setting->save();

            return Redirect(action('SettingsController@index'))->with('success','Item Added');
        }

        return Redirect(action('SettingsController@index'));
    }
}
