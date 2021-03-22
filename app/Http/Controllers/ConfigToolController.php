<?php

namespace App\Http\Controllers;

use App\ConfigTool;
use App\ConfigWeb;
use Illuminate\Http\Request;

class ConfigToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $list_web = ConfigWeb::all();
         $list_token = ConfigTool::all();
        return view('pages.config_admin',['list_web'=>$list_web, 'list_token' =>$list_token]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createToken(Request $request)
    {
    $data = $request->except('_token');
    ConfigTool::create($data);
    return redirect()->route('adminHome');

    }
    public function deleteToken($id){
        $row = ConfigTool::find($id);
        $row->delete();
        return redirect()->route('adminHome');
    }
    public function createWeb(Request $request)
    {
     $data = $request->except('_token');
    ConfigWeb::create($data);
    return redirect()->route('adminHome');

    }
    public function deleteConfigWeb($id){
        $row = ConfigWeb::find($id);
        $row->delete();
        return redirect()->route('adminHome');
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
     * @param  \App\ConfigTool  $configTool
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigTool $configTool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConfigTool  $configTool
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigTool $configTool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConfigTool  $configTool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfigTool $configTool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConfigTool  $configTool
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigTool $configTool)
    {
        //
    }
}
