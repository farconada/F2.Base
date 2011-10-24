<?php 
/**
$goo = new Googl(); 
//$goo = new Googl("APIKey");//if you have an api key 

//$r = $goo->set_short("http://eslam.me"); 
//print_r($r); 

//send true to get analytics about the short URL  
$r = $goo->get_long("http://goo.gl/pTgKg",true); 
print_r($r); 
**/

/** 
 * Googl 
 * 
 * @author Eslam Mahmoud 
 * @url http://eslam.me/ 
 * @copyright Creative Commons Attribution-ShareAlike 3.0 Unported License. 
 * @version 0.2 
 * @access public 
 */ 
class Googl{ 
    //application key 
    private $APIKey; 
    //api url 
    private $API = "https://www.googleapis.com/urlshortener/v1/url"; 
     
  /** 
   * Googl::Googl() 
   * 
   * @param string $apiKey 
   * @return void 
   */ 
    function Googl($apiKey=""){ 
        if ($apiKey != ""){ 
            $this->APIKey = $apiKey; 
        } 
    } 
     

  /** 
   * Googl::get_long() 
   * 
   * @param url as string $shortURL 
   * @return result as array 
   */ 
    function get_long($shortURL , $analytics = false){ 
        $url = $this->API.'?shortUrl='.$shortURL; 
         
        if ($this->APIKey){ 
            $url .= '&key='.$this->APIKey; 
        } 
        if ($analytics){ 
            $url .= '&projection=FULL'; 
        } 
        $ch = curl_init($url); 
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $result=curl_exec($ch);   
        curl_close($ch); 
        $array = json_decode($result, true); 
        return $array;     
    } 
     
  /** 
   * Googl::set_short() 
   * 
   * @param url as string $longURL 
   * @return result as array 
   */ 
    function set_short($longURL){ 
        $vars = ""; 
        if ($this->APIKey){ 
            $vars .= "?key=$this->APIKey"; 
        } 
         
        $ch = curl_init($this->API.$vars);   
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json')); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false ); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"longUrl": "' . $longURL . '"}'); 
        $result=curl_exec($ch);   
        curl_close($ch); 
        $array = json_decode($result, true); 
        return $array; 
    } 
} 
