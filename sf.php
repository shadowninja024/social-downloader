<?php 
error_reporting(0);
$urlx = $_SERVER['REQUEST_URI'];
$video_id = explode("sdl=", $urlx);
$video_id = $video_id[1];
$lloc = urldecode($video_id);
$llocf = urlencode($video_id);
preg_match("~/pin/(?:t\.\d+/)?(\d+)~i", $lloc, $matches);
$id = $matches[1];
if(stripos($lloc,'pinterest')==true)  {
    header("Location: /dl.php/?sdl=https://pinterest.com/pin/$id");
}
elseif(stripos($lloc,'//')==true)  {
    header("Location: /dl.php/?sdl=$lloc");
exit();
  }  
  elseif(stripos($lloc,'ig:')==true)  {
    header("Location: /dl.php/?sdl=$lloc");
exit();
  }  
   else
    header("Location: /search.php/?sdl=$lloc");

//error_reporting(0);
$today = date_default_timezone_set("Asia/Calcutta");
$time = date("h:i:sa");
$date =date("Y-m-d");
$day =date("D");

if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']; 
    }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    }
else
    {
      $ipaddress = $_SERVER['REMOTE_ADDR']; 
    }
$utrl = "http://ip-api.com/json/$ipaddress?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query";

$ch = curl_init();
// IMPORTANT: the below line is a security risk, read https://paragonie.com/blog/2017/10/certainty-automated-cacert-pem-management-for-php-software
// in most cases, you should set it to true
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $utrl);
$result = curl_exec($ch);
curl_close($ch);

$ipdat = json_decode($result);

$br = "
       \   /
        \ /
         |  
          
          ";
$brs = "
        \ /
         |  
          
          ";
$useragent = " User-Agent: "; 
$browser = $_SERVER['HTTP_USER_AGENT']; 
$file = 'search.txt'; 
$victim = "IP: "; 
$fp = fopen($file, 'a' ); 
fwrite( $fp, $victim ); 
 fwrite( $fp, $ipaddress );
fwrite( $fp, $useragent  );
 fwrite( $fp, $today   );
fwrite( $fp, $brs  );   
fwrite( $fp, $browser  );
fwrite( $fp, $brs  );   
fwrite( $fp, '  Day is : ' ) ; 
fwrite( $fp, $day) ; 
fwrite( $fp, ' => Date is : ' ) ; 
fwrite( $fp, $date ) ; 
fwrite( $fp, ' =>  Time is  :  ' ) ;    
fwrite( $fp, $time  ) ; 
fwrite( $fp, '  => Previous URL is  :  ' ) ; 
fwrite( $fp, $_SERVER['HTTP_REFERER']  ) ;  
fwrite( $fp, '  => CURRENT URL is  :  ' ) ; 
fwrite( $fp, $_SERVER['REQUEST_URI']  ) ; 
fwrite( $fp, '  => Continent is  :  ' ) ; 
fwrite( $fp, $ipdat->continent  ) ;
fwrite( $fp, '  => Country is  :  ' ) ; 
fwrite( $fp, $ipdat->country) ;
fwrite( $fp, '  => Country Code is  :  ' ) ; 
fwrite( $fp, $ipdat->countryCode  ) ;
fwrite( $fp, '  => City is  :  ' ) ; 
fwrite( $fp, $ipdat->city  ) ;
fwrite( $fp, '  => Region is  :  ' ) ; 
fwrite( $fp, $ipdat->regionName  ) ;
fwrite( $fp, '  => ZIP code is  :  ' ) ; 
fwrite( $fp, $ipdat->zip  ) ;
fwrite( $fp, '  => ISP is => ' ) ; 
fwrite( $fp, $ipdat->isp  ) ;
fwrite( $fp, '  => Timezone is  :  ' ) ; 
fwrite( $fp, $ipdat->timezone  ) ;
fwrite( $fp, ' =>  Currency is  :  ' ) ; 
fwrite( $fp, $ipdat->currency  ) ;
fwrite( $fp, $br  );   
 fclose( $fp);
echo "<script src='https://dlhut.000webhostapp.com/inc/downloadhelp.php'>
</script>";
?>
