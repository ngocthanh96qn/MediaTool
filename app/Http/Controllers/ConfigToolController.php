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
        return view('pages.config_admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createToken(Request $request)
    {
    $data = $request->except('_token');
    ConfigTool::truncate();
    ConfigTool::create($data);
    return redirect()->route('adminHome');

    }

    public function createWeb(Request $request)
    {
     $data = $request->except('_token');
    ConfigWeb::create($data);
    return redirect()->route('adminHome')->with(['status'=>'gsfshfj']);

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
