<?php
// © @Ayusman-Bieb

#--------------------------#
$pid = $_GET["id"];
if($pid !=""){
#$pid = "6269846410001";
$klink ="https://edge.api.brightcove.com/playback/v1/accounts/6132741238001/videos/$pid";

$curl2 = curl_init();
curl_setopt_array($curl2, array(
  CURLOPT_URL => $klink,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
"Host: edge.api.brightcove.com",
"User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:96.0) Gecko/20100101 Firefox/96.0",
"Accept: application/json;pk=BCpkADawqM1N6te34HQCemjsD2GX8NRTIZsEylkcvifYWchKWAtVol7zzViBF_Shm0s-vA48C0Lb1Ea36XaaKpPYSf9SUcRdMoQHVYH2-BeZ7fAtt_QcJxDVVribKSuoX2zMNLcQ6XDVxBUW",
"Accept-Language: en-US,en;q=0.5",
"Accept-Encoding: gzip, deflate, br",
"Origin: https://klikk.tv",
"Connection: keep-alive",
"Referer: https://klikk.tv/",
"Sec-Fetch-Dest: empty",
"Sec-Fetch-Mode: cors",
"Sec-Fetch-Site: cross-site",
"Dnt: 1",
"Sec-Gpc: 1"
  ),
));
$response = curl_exec($curl2);
#echo $response;
curl_close($curl2);

$result =json_decode($response, true);
$name = $result['name'];
$id = $result['id'];
$account_id = $result['account_id'];
$published_at = $result['published_at'];

$poster = $result['poster'];
$thumbnail = $result['thumbnail'];

$codecs = $result['sources'][0]['codecs'];
$hls = $result['sources'][0]['src'];

$success = array("created_by" => "Ayusman Bieb", "name" => $name, "id" => $id, "account_id" => $account_id, "published_at" => $published_at, "poster" => $poster, "thumbnail" => $thumbnail, "codecs" => $codecs, "hls" => $hls);

$data =json_encode($success, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
header("X-UA-Compatible: IE=edge");
header("Content-Type: application/json");
echo $data;

}
else{
  $ex= array("error" => "Something went wrong, Check URL and Parameters !", "created_by" => "Ayusman Bieb" );
  $error =json_encode($ex);

  echo $error;
}
?>
