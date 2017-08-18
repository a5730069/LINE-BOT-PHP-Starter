 <?php
 
   function pubMqtt($topic,$msg){
       
      put("https://api.netpie.io/topic/jadetest/$topic?retain",$msg);
 
  }
  function getMqttfromlineMsg($lineMsg){
 

  $request = "auth=jJhs4OCpicDIGTT:kWNwUoBoEZenL50J2h8Th8XGT";
  $urlWithoutProtocol = "https://api.netpie.io/microgear/jadetest/NodeMCU1?retain";
  $isRequestHeader = FALSE;
   
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $urlWithoutProtocol);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $lineMsg);
  curl_setopt($ch, CURLOPT_USERPWD, "jJhs4OCpicDIGTT:kWNwUoBoEZenL50J2h8Th8XGT");
  $productivity = curl_exec($ch);
  curl_close($ch);
  echo $productivity;
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
