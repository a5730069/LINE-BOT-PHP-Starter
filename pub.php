 <?php
 
   function pubMqtt($topic,$msg){
       
      put("https://api.netpie.io/topic/jadetest/$topic?retain",$msg);
 
  }
  function getMqttfromlineMsg($lineMsg){
 
   include "httpful.phar";
        // กำหนด uri
        $uri = "https://api.netpie.io/microgear/jadetest/NodeMCU1?retain&auth=jJhs4OCpicDIGTT:kWNwUoBoEZenL50J2h8Th8XGT";
        
        // สั่งให้เรียก uri โดยใช้คำสั่ง GET เพื่อขออ่านค่าจาก netpie
        $response = \Httpful\Request::put($uri)->send(1);
  }
 
  function put($url,$tmsg)
{
      
    $ch = curl_init($url);
 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
     
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $tmsg);
 
    curl_setopt($ch, CURLOPT_USERPWD, "{jJhs4OCpicDIGTT}:{kWNwUoBoEZenL50J2h8Th8XGT}");
     
    $response = curl_exec($ch);
     
    curl_close ($ch);
     
    return $response;
}
 
?>
