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
class InstantArticles extends Controller
{
    public function index(){
        
    }
    public function test_api(){

        $userAccessToken = 'EAAKGZAc6bPdUBAGDRoVeZCzvlKeho0TjNCXiMalSEfIRobrNXBoiTp2oj040vCF30gDyzQvR2IELa971jmlLSxroTInZBsODlverFyAWnOsmCYyf1DIl69cYmqYC6yD8OFSBT0AdU39ucPFWzhT6bodVSIFaBwbZAyMuoJ68gZBV5kPUY5waZCN5tf6VfpZCVc3tagWqwXiYwZDZD';
        $app_id =  '710721769520597';
        $app_secret = '490f939d0a0d39df163acededd229c4b';
            
    }
    function GetBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return 'false' ;
    }

    public function test(Request $request){
        $post_id = $request->toArray()['post_id'];
        $link = 'https://24h.xaluanvn.net/wp-json/wp/v2/posts/'.$post_id;
        $response = Http::get($link);
        //  dd($response->json());
        $CanonicalUrl =  $response->json()['link'];
        $title = $response->json()['title']['rendered']; 
        $time = $response->json()['date'];
        $time = str_replace("T"," ",$time);
        $time_current =  date("Y-m-d h:i:s");
        $content = $response->json()['content']['rendered'];
        $content =  strip_tags($content, '<p> <img>');
        $content = str_ireplace('<p></p>','',$content);
        $content = str_ireplace('<p><img','<img',$content);
        $content = str_ireplace('></p>','>',$content);
        // var_dump($content);
        //  dd($content);
        ///// anh cover
        $content_phu = $content;
        for ($i=0; $i<5; $i++) { 
            $img[$i] =  $this->GetBetween($content_phu,'<img','>');
            $content_phu = str_ireplace('<img'.$img[$i],'',$content_phu);
        }
        // dd($img);
        foreach ($img as $key => $in_img) {
            
            if(strpos("data-src",$in_img)==true) {
                $src = $this->GetBetween($in_img,'data-src="','"');
            }
            else {
                $src = $this->GetBetween($in_img,'src="','"');
                
            }
            
            $content = str_ireplace('<img'.$in_img,'<figure><img'.$in_img,$content);
            $content = str_ireplace($in_img.'>',$in_img.'></figure>',$content);
            $content = str_ireplace('<img'.$in_img,'<img src="'.$src.'"/',$content);
        }
       
        // dd($content);
    
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
        //khai bao analytics
        $Analytics = "<script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        var analyticID = 'UA-158174168-3';
        ga('create',analyticID, 'auto');
        ga('require', 'displayfeatures');
        ga('set', 'campaignSource', 'Facebook');
        ga('set', 'campaignMedium', 'Social Instant Article');
        ga('set', 'title', 'IA: '+ia_document.title);
        ga('send', 'pageview'); 
      </script>"  ;
        $document = new \DOMDocument();
        $fragment = $document->createDocumentFragment();
        $fragment->appendXML($Analytics);

    
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
                        ->withName('Author Name')
                        ->withDescription('Author more detailed description')
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
        $ads = '<figure class="op-ad"><iframe src="https://www.facebook.com/adnw_request?placement=389373932077460_389373962077457&adtype=banner300x250" width="300" height="250"></iframe></figure>';
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

    //    var_dump($instant_article );
    //    dd($instant_article);

    $access_token = 'EAAKGZAc6bPdUBAPWnNeDWOLZCRSTpZB2ZCoyAq5vClZBeuxIREmK8w1bBpBouTLu2w318SYC9t57hlRewZCmh6KUSV3CBuH8MCNK5QwiqmgFxBSn27U5hLDLtxls7ZBrAMeYFOVpCKmxNbVUZAGDMTSkG6qcIex8149Jn4gGhz58tQZDZD ';
    $response = Http::get('https://graph.facebook.com/104651187547290?fields=access_token&access_token='. $access_token);
    $token_page = $response->json()['access_token'];
  
    $response = Http::post('https://graph.facebook.com/104651187547290/instant_articles', [
        'access_token' => $token_page,
        'html_source' => $instant_article,
        'published'=> 'false',
        'development_mode'=> 'true',
        
    ]);
    // var_dump($response->json());
    $response = Http::get('https://graph.facebook.com/'.$response->json()['id'].'?fields=errors,html_source,instant_article,status&access_token='.$token_page);
    dd($response->json());
               
    }
}
