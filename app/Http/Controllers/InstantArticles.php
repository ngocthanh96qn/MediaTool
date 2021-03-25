<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\InstantArticles\Transformer\Transformer;
use Facebook\InstantArticles\Elements\InstantArticle;
use Facebook\InstantArticles\Client\Client;
use Facebook\InstantArticles\Client\Helper;
use Facebook\InstantArticles\Elements\Header;
use Facebook\InstantArticles\Elements\Time;
use Facebook\InstantArticles\Elements\Author;
use Facebook\InstantArticles\Elements\Image;
use Facebook\InstantArticles\Elements\Caption;
use Facebook\InstantArticles\Elements\Sponsor;
use Facebook\InstantArticles\Elements\Paragraph;
use Facebook\InstantArticles\Elements\SlideShow;
use Facebook\InstantArticles\Elements\Ad;
use Facebook\InstantArticles\Elements\Analytics;
use Facebook\InstantArticles\Elements\Footer;
use Illuminate\Support\Facades\Http;
use App\ConfigTool;
use App\ConfigWeb;
use App\infoArticle;
use App\TokenWeb;

class InstantArticles extends Controller

{
    private $access_token;   
    public function __construct(){
        // $this->access_token = 'EAAKGZAc6bPdUBAMbanQGcPDWRV6mvEQ5RhxeoXqtglItvDHBkXbzIMkhr9kULpKT8frGcPACEQbZANCvCNHQeqdskO3yLNemZAzsZCv42ZBRXTVMIBCrC52HsOljV8LvXr7athFzmLS1kzRLTKGCU88PbhzPDYLV4tN888lRuxQZDZD';
        $this->access_token = ConfigTool::all()[0]->access_token;
    }

        public function GetBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return 'false' ;
    }



     public function postArticle(Request $request)
    {
        $id_configWeb = $request->id_configWeb;
        $post_id = $request->post_id;

        $id_token = TokenWeb::where('web_id','=',$id_configWeb)->get();
        $id_token=$id_token[0]->token_id;
        $access_token = ConfigTool::find($id_token);
        $access_token = $access_token->access_token;
        
        $configWeb = ConfigWeb::find($id_configWeb);

        $id_page =  $configWeb->id_page;
        $id_ads =  $configWeb->id_ads;
        $id_analytics = $configWeb->id_analytics;
        $id_analytics = '"'.$id_analytics.'"';
        $domain = $configWeb->domain;       
        $link = 'http://'.$domain.'/wp-json/wp/v2/posts/'.$post_id;
        $add_title = '';

        $response = Http::get($link);
         // dd($response->json());
        if(isset($response->json()['code']))
        {
            dd($response->json()['message']);
        }
        $CanonicalUrl =  $response->json()['link'];
        $title = $response->json()['title']['rendered'];
        $title= $title.$add_title; 
        $time = $response->json()['date'];
        $time = str_replace("T"," ",$time);
        $time_current =  date("Y-m-d h:i:s");
        $content = $response->json()['content']['rendered'];

        $content = str_replace("&#x0069;mg","img",$content);
        
        $content =  strip_tags($content, '<p> <img> <iframe>'); //chi nhận thẻ p và img

        $link = array();
        for ($i=0; $i <150; $i++){
            $iframe='';
            $iframe =  $this->GetBetween($content,'<iframe','</iframe>');
            $link[$i] =  $this->GetBetween($iframe,'daᴛa-src=','?');
            
            $content = str_ireplace('<iframe'.$iframe.'</iframe>',$link[$i],$content);  
        }
        // dd($link);
        foreach ($link as $key => $value) {
            if($value!='false'){
               $tempLink = '<figure class="op-interactive">
               <iframe width="560" height="315" src='.$value.'"></iframe>
               </figure>';
               $content = str_ireplace($value,$tempLink,$content);
           }

       }

        for ($i=0; $i < 150 ; $i++) { 
            $p_class =  $this->GetBetween($content,'<p class','>');
            $content = str_ireplace('<p class'.$p_class,'<p',$content);    
        }

        for ($i=0; $i < 150 ; $i++) { 
            $p_class =  $this->GetBetween($content,'<p style','>');
            $content = str_ireplace('<p style'.$p_class,'<p',$content);    
        }
        
        for ($i=0; $i < 150 ; $i++) { 
            $p_class =  $this->GetBetween($content,'<p daᴛa','>');   
            $content = str_ireplace('<p daᴛa'.$p_class,'<p',$content);    
        }
        for ($i=0; $i < 150 ; $i++) { 
            $p_class =  $this->GetBetween($content,'<p data','>');
            $content = str_ireplace('<p data'.$p_class,'<p',$content);       
        }
        for ($i=0; $i < 150 ; $i++) { 
            $p_img =  $this->GetBetween($content,'<p><img','</p>');
        $content = str_ireplace('<p><img'.$p_img.'</p>','<img'.$p_img,$content);
        }    
         // $content = str_ireplace("\n\n",'',$content);
         // $content = str_ireplace("</p>","</p>\n",$content);
        // dd($content);
         $p_trc = [];
         $p_sau = [];
        $content_phu = $content;  //xử ly thẻ p có nội dung trước img
        for ($i=0; $i < 150 ; $i++) { 
            $text =  $this->GetBetween($content_phu,'<p>','</p>');
            $pos = strpos($text, '<img');
            if ($pos !== false) {

                $text2 =  $this->GetBetween('<p>'.$text,'<p>','<img');
                $p_trc[]=$text2;
                $text3 =  $this->GetBetween('<p>'.$text,'">','</p>');
                $p_sau[]=$text3;
                
            }
           
             $content_phu = str_ireplace('<p>'.$text.'</p>','',$content_phu);          
        }   

        // dd($p_sau);
        foreach ($p_trc as $key => $item) {
            if ($item!==" ") {
               $content = str_ireplace('<p>'.$item,'<p>'.$item.'</p>',$content);
            }
            
        }
         foreach ($p_sau as $key => $item) {
            $content = str_ireplace('">'.$item.'</p>','"><p>'.$item.'</p>',$content);
        }
        ////
        $content = str_ireplace('<p></p>','',$content);
        // $content = str_ireplace('<p><img','<img',$content);
        // $content = str_ireplace('></p>','>',$content);  
        
        // var_dump($content);
        ///// anh cover
        $content_phu = $content;
        for ($i=0; $i<150; $i++) { 
            $img[$i] =  $this->GetBetween($content_phu,'<img','>');
            $content_phu = str_ireplace('<img'.$img[$i],'',$content_phu);
        }

        foreach ($img as $key => $value) {
            
            $pos = strpos($value,'src="daᴛa');
            if ($pos !== false) {
            $img[$key] = 'false';
             $content = str_ireplace('<img'.$value.'>','',$content);
            } 

            // $poss = strpos($value,'aria-d&#x0065;');
            // if ($poss !== false) {
            // $img[$key] = 'false';
            // $content = str_ireplace('<img'.$value.'>','',$content);
            // } 

        }
      // dd($img);
         $content = str_ireplace('<p> <img','<img',$content);
         $content = str_ireplace('>  </p>','>',$content);
        foreach ($img as $key => $in_img) {
            
            if(strpos($in_img,"data-src")==true) {
                $src = $this->GetBetween($in_img,'data-src="','"');

                
            }
            elseif(strpos($in_img,"daᴛa-src")==true) {
                $src = $this->GetBetween($in_img,'daᴛa-src="','"');

                
            }
            else {
                $src = $this->GetBetween($in_img,'src="','"');
                 
            }
            
            $content = str_ireplace('<img'.$in_img,'<figure><img'.$in_img,$content);
            $content = str_ireplace($in_img.'>',$in_img.'></figure>',$content);
            $content = str_ireplace('<img'.$in_img,'<img src="'.$src.'"/',$content);
        }
       
       
    
        if(isset($response->json()['_links']['wp:featuredmedia']))
        {
        $api_image = $response->json()['_links']['wp:featuredmedia'][0]['href'];
        $response = Http::get($api_image);
        $url = $response->json()['source_url'];
        $image = Image::create()
        ->withURL($url);
        }
        
        else {
            $image =Image::create()
            ->withURL("");
        }
        
        /////
  $title_analytic = "replace_title";
        //khai bao analytics
  $analytics = "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
 
  ga('create', ".$id_analytics.", 'auto');
  ga('require', 'displayfeatures');
  ga('set', 'campaignSource', 'Facebook');
  ga('set', 'campaignMedium', 'Social Instant Article');
  ga('set', 'title', 'IA: '+ia_document.title);
  ga('send', 'pageview');";

        $analytics_kdung = 'var qParams= new URL(ia_document.shareURL).searchParams; var source = qParams["utm_source"]; var medium = qParams["utm_medium"] ;
      var url_tid = (new URL(window.location)).searchParams.get("tid");
      var analyticID = "ha";
      document.title = "IA"+((url_tid>0)?url_tid:"")+": " +ia_document.title+"";
      (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");
  ga("create",'.$id_analytics.', "auto"); 
  ga("send", "pageview");
  ga("send", "screenview", { "appName": "FB Intant Article", "appVersion": location.hostname, "screenName": "FBia: "+location.hostname});
  ga("create", '.$id_analytics.', "auto", "clientTracker"); 
  ga("clientTracker.send", "pageview");  
  ga("clientTracker.send", "screenview", {"appName": "FB Intant Article", "appVersion": location.hostname ,"screenName": "FBia: "+location.hostname});';

 $buildAnalytics = '<script> replace_analytics </script>';

        $document = new \DOMDocument();
        $fragment = $document->createDocumentFragment();
        $fragment->appendXML($buildAnalytics);

    
$article =
    InstantArticle::create()
        ->withCanonicalUrl($CanonicalUrl)
        ->withHeader(
            Header::create()
                ->withCover($image)
                ->withTitle($title)
                ->withPublishTime(
                    Time::create(Time::PUBLISHED)
                        ->withDatetime(
                            \DateTime::createFromFormat('Y-m-j G:i:s',$time))
                )
                ->withModifyTime(
                    Time::create(Time::MODIFIED)
                        ->withDatetime( \DateTime::createFromFormat('Y-m-j G:i:s',$time_current) )
                )
                ->addAuthor(
                    Author::create()
                        ->withName('Admin')
                        ->withDescription('- writer - ')
                )                 
        )
        // Paragraph1
        ->addChild(
            Paragraph::create()
                ->appendText('content_replace')
        )       
        // Analytics
     ->addChild(
        Analytics::create()
             ->withHTML($fragment)
     );
  
        // add thêm thẻ meta
        $meta  ='<meta property="op:generator:application" content="facebook-instant-articles-wp"/><meta property="op:generator:application:version" content="4.2.1"/><meta property="op:generator:transformer" content="facebook-instant-articles-sdk-php"/><meta property="op:generator:transformer:version" content="1.10.0"/><meta property="fb:article_style" content="default"/><meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=default"/>';
        
        $instant_article = $article->render("<!doctype html>");
        $instant_article = str_replace('<p>content_replace</p>',$content,$instant_article);
        $instant_article = str_replace('</head>',$meta.'</head>',$instant_article);
        // End add thêm thẻ meta

        // Add thẻ ads
        $ads = '<figure class="op-ad"><iframe src="https://www.facebook.com/adnw_request?placement='.$id_ads.'&adtype=banner300x250" width="300" height="250"></iframe></figure>';
        $instant_article = str_replace("</address>","</address>".$ads,$instant_article);
        // End Add thẻ ads

        // Add thẻ html 
        $instant_article = str_replace("<html>",'<html lang="vi" prefix="op: http://media.facebook.com/op#">',$instant_article);
        // End Add thẻ html

        $instant_article = str_replace("\n",'',$instant_article);
        $instant_article = str_replace('<img',"   <img",$instant_article);
        $instant_article = str_replace('<meta',"  <meta",$instant_article);
        $instant_article = str_replace('<p',"      <p",$instant_article);
       $mang_them = [');','{','>'];
       foreach ($mang_them as $key => $value) {
        $instant_article = str_replace($value,$value."\n",$instant_article);
       }
       $mang_bot = ['<figure>','<a>','<address>','</a>',"\n"];
        foreach ($mang_bot as $key => $value) {
         $instant_article = str_replace($value."\n",$value,$instant_article);
        }
       $instant_article = str_replace("<p>\n","<p>",$instant_article);
       $instant_article = str_replace("\">\n","\">",$instant_article);
       $instant_article = str_replace("<h1>\n","<h1>",$instant_article); 
       $instant_article = str_replace("<iframe>","\n<iframe>",$instant_article);
       $instant_article = str_replace("<img","\n       <img",$instant_article); 
       // $title = html_entity_decode($title);
       $instant_article = str_replace("replace_title",$title,$instant_article); 
       $instant_article = str_replace("&&","&",$instant_article); 
       $instant_article = str_replace("<p><figure","<figure",$instant_article);
       $instant_article = str_replace("</figure>\n</p>","</figure>",$instant_article);

       $instant_article = str_replace("replace_analytics ",$analytics,$instant_article);

       // var_dump($instant_article );
        // dd($instant_article);
   
    
    $response = Http::get('https://graph.facebook.com/'.$id_page.'?fields=access_token&access_token='. $access_token);
    $token_page = $response->json()['access_token'];
    $response = Http::post('https://graph.facebook.com/'.$id_page.'/instant_articles', [
        'access_token' => $token_page,
        'html_source' => $instant_article,
        'published'=> 'true',
        'development_mode'=> 'false',
        
    ]);
    // dd($response->json());
    return redirect()->route('pagehome')->with(['status'=>"success"]);

     } 

     public function getStatus($id_page,$id_import){
        $Main = new Main; 
        $token_page = $Main->getAccessPage($id_page);
        $response = Http::get('https://graph.facebook.com/'.$id_import.'?fields=errors,html_source,instant_article,status&access_token='.$token_page);
        return $response->json();
     }



    public function fixDraft(Request $request){
        $id_configWeb = $request->id_configWeb;
        $post_id = $request->post_id;

        $id_token = TokenWeb::where('web_id','=',$id_configWeb)->get();
        $id_token=$id_token[0]->token_id;
        $access_token = ConfigTool::find($id_token);
        $access_token = $access_token->access_token;
        
        $configWeb = ConfigWeb::find($id_configWeb);

        $id_page =  $configWeb->id_page;
        $id_ads =  $configWeb->id_ads;
        $id_analytics = $configWeb->id_analytics;
        $id_analytics = '"'.$id_analytics.'"';
        $domain = $configWeb->domain;       
        $link = 'http://'.$domain.'/wp-json/wp/v2/posts/'.$post_id;
        $add_title = '';
      

        $response = Http::get('https://graph.facebook.com/'.$id_page.'?fields=access_token&access_token='. $access_token);
        $token_page = $response->json()['access_token'];
        //lay id bai thong qua url
        
        $response = Http::get($link);
        if(isset($response->json()['code']))
        {
            dd($response->json()['message']);
        }
        $url =  $response->json()['link'];

         $response = Http::get("https://graph.facebook.com?id=".$url."&fields=instant_article&access_token=".$token_page);
         $instant_article = $response->json()['instant_article']['html_source'];
          $instant_article = preg_replace('/<h1>(.*?)<\/h1>/is', '<h1> Updating - '.$post_id.' </h1>', $instant_article);
          $content = $this->GetBetween($instant_article,'</header>','<figure class="op-tracker">');
          $instant_article = str_replace($content, "\n<p> Updating </p>\n", $instant_article);
        $id_article = ($response->json()["instant_article"]["id"]);
        //xoa bai
         $response = Http::delete("https://graph.facebook.com/".$id_article."?access_token=".$token_page);
        ///delete  xong
         $response = Http::post('https://graph.facebook.com/'.$id_page.'/instant_articles', [
        'access_token' => $token_page,
        'html_source' => $instant_article,
        'published'=> 'true',
        'development_mode'=> 'false',
        
    ]);
        return redirect()->route('fixDraft')->with(['status'=>"success"]);

    }

}
