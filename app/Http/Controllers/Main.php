<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigTool;
use App\ConfigWeb;
use App\infoArticle;
use DB;
use Illuminate\Support\Facades\Http;

class Main extends Controller
{
	public $id_page='104651187547290';

    public function home(){
    	$list_web = ConfigWeb::all();
    	 return view('pages.home',['list_web'=>$list_web]);
    }
    public function GetBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '' ;
    }
    public function updateIa($url){
    	$url = str_replace("-","/",$url);
    	$Ia = infoArticle::where('url','=',$url)->get();
    	if($Ia->toArray() == null)
    		{
    			return Redirect()->back();
    			
    		}
    		else {
    			
    			$id_import = $Ia[0]->id_import;
    			$instantArticle = new InstantArticles;
    			$status = $instantArticle->getStatus($this->id_page,$id_import);
    			infoArticle::where('url','=',$url)->update(['status'=>$status['status']]);
    		}
    	
    	return redirect()->route('pagehome');
    }
    public function updateArticle($url){
    	$url=$url.'#';
    	for($i=0;$i<5;$i++){
    		$result = $this->getBetween($url,"--","-");
    	$url = str_replace($result.'-','',$url);
    	}
    	$idArticle = $this->getBetween($url,"--","#");
    	$instantArticle = new InstantArticles;
    	dd($idArticle);
    }

    public function getAccessPage($idPage){
    	$access_token = ConfigTool::find(1)->access_token;
    	$response = Http::get('https://graph.facebook.com/'.$idPage.'?fields=access_token&access_token='.$access_token);
       return   $token_page = $response->json()['access_token'];
    }

    public function getAllArtice($idPage){
    	$token_page = $this->getAccessPage($idPage);
    	$ApiGetAllArtice = "https://graph.facebook.com/".$idPage."/instant_articles?access_token=".$token_page;
    	$response = Http::get($ApiGetAllArtice);
    	return $response->json();
    }
}
