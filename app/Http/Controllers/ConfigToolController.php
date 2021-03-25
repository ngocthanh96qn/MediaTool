<?php

namespace App\Http\Controllers;

use App\ConfigTool;
use App\ConfigWeb;
use App\TokenWeb;
use Illuminate\Http\Request;
use App\Http\Requests\EditWeb;
use App\Http\Requests\CreateWeb;
use App\Http\Requests\CreateToken;
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
          $mangNameToken= [];
         foreach ($list_web as $key => $value) {
            $token_web = TokenWeb::where('web_id',$value->id)->get();
            $mangNameToken[$value->id] = ConfigTool::find($token_web[0]->token_id)->name;
            
         }
        return view('pages.config_admin',['list_web'=>$list_web, 'list_token' =>$list_token,'mangNameToken'=>$mangNameToken]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createToken(CreateToken $request)
    {
    $data = $request->except('_token');
    ConfigTool::create($data);
    return redirect()->route('adminHome');

    }
    public function deleteToken(Request $request){

        $row = ConfigTool::find($request->tokenid)->delete();
        $tokenWeb = TokenWeb::where('token_id',$request->tokenid)->get();
        foreach ($tokenWeb as $key => $value) {
            ConfigWeb::find($value->web_id)->delete();
            TokenWeb::find($value->id)->delete();
        }
        
        return redirect()->route('adminHome');
    }
    public function editToken(Request $request){
        $data = ['access_token'=>$request->accessToken,'name'=>$request->tokenName];
        $row = ConfigTool::find($request->token_id);
        $row->update($data);
        return redirect()->route('adminHome');
    }

    public function createWeb(CreateWeb $request)
    {
     $data = $request->except('_token');
    $web = ConfigWeb::create($data);
    $dataTokenWeb = ['web_id'=>$web->id,'token_id'=>$request->token_id];
    TokenWeb::create($dataTokenWeb);
    return redirect()->route('adminHome');

    }
    public function editConfigWeb(EditWeb $request){
        // dd($request->toArray());
        $data = ['id_page'=>$request->idPage,'page_name'=>$request->page_name,'domain'=>$request->domain,'web_name'=>$request->webName,'id_ads'=>$request->idAds,'id_analytics'=>$request->idAnalytics];
        $row = ConfigWeb::find($request->web_id);
        // dd($data);
        $row->update($data);
        $dataTokenWeb = ['web_id'=>$request->web_id,'token_id'=>$request->token_id];
        $tokenWeb = TokenWeb::where('web_id',$request->web_id)->get();
        TokenWeb::find($tokenWeb[0]->id)->update($dataTokenWeb);
        return redirect()->route('adminHome')->with('status', 'updated!');
    }
    
    public function deleteConfigWeb(Request $request){
        $id = $request->webid;
        $row = ConfigWeb::find($id);
        TokenWeb::where('web_id','=',$id)->delete();
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
