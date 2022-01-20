<?php
//If you use PHP you can make the API functional with CURL and by checking status codes.

$apiurl = "http://localhost:19231/?server=";
$requrl = htmlspecialchars($_GET["server"]);
header('Content-Type: application/json');
$url = $apiurl . $requrl;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_TIMEOUT,10);
$output = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if(empty($requrl)) {
echo '{"status": "failed", "reason": "You have not specified a server to check. For documentation please read https://api.wreeper.top/docs/samp/"}';
exit();
}
if($httpcode == 0) {
echo '{"status": "failed", "reason": "The API seems to be down. Please try again later. -api.wreeper.top"}';
} else if($httpcode == 404) {
echo '{"status": "failed", "reason": "Cannot connect to the specified SAMP server."}';
} else if($httpcode == 200) {
$returnapi = file_get_contents($apiurl . $requrl);
echo $returnapi;
}
?>
