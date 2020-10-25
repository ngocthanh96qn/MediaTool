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
    	$listArticle = $this->getAllArtice($this->id_page);
    	
    	foreach ($listArticle['data'] as $key => $Article) {
    		$url = $Article['canonical_url'];
    		$infoArticle = infoArticle::where('url','=',$url)->get();
    		if($infoArticle->toArray() == null)
    		{
    			$status = '--'	;
    		}
    		else {
    			
    			$status = $infoArticle[0]->status;
    		}
    		$id = $Article['id'];
    		$title = $this->GetBetween($Article['html_source'],"<h1>","</h1>");
    		$web =  $this->GetBetween($url,"//","/");
    		$listView[] = ['title'=>$title ,'idFB'=>$id , 'nameWeb'=> $web , 'url'=>$url, 'status'=>$status] ;   		 
    	}
    	 return view('pages.home',['list_web'=>$list_web,'listView'=>$listView]);
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
