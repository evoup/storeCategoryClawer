<?php
/*
  +----------------------------------------------------------------------+
  | Name:
  +----------------------------------------------------------------------+
  | Comment:
  +----------------------------------------------------------------------+
  | Author:Evoup     evoex123@gmail.com                                                     
  +----------------------------------------------------------------------+
  | Create:
  +----------------------------------------------------------------------+
  | Last-Modified:
  +----------------------------------------------------------------------+
*/
$countriesJson='["PR","PS","PT","PW","PY","QA","AD","AE","AF","AG","AI","AL","AM","AN","AO","AQ","AR","AS","AT","RE","AU","AW","AX","AZ","RO","BA","BB","RS","BD","BE","RU","BF","BG","RW","BH","BI","BJ","BL","BM","BN","BO","SA","SB","BQ","BR","SC","BS","SE","BT","SG","BV","BW","SH","SI","BY","SJ","SK","BZ","SL","SM","SN","SO","CA","SR","SS","CC","CD","ST","SV","CF","CG","CH","SX","CI","SZ","CK","CL","CM","CN","CO","CR","TC","TD","TF","TG","CV","TH","CW","CX","CY","TJ","CZ","TK","TL","TM","TN","TO","TR","TT","DE","TV","TW","TZ","DJ","DK","DM","DO","UA","UG","DZ","UM","US","EC","EE","EG","EH","UY","UZ","VA","VC","ER","ES","VE","ET","VG","VI","VN","VU","FI","FJ","FK","FM","FO","FR","WF","GA","GB","WS","GD","GE","GF","GG","GH","GI","GL","GM","GN","GP","GQ","GR","GS","GT","GU","GW","GY","XK","HK","HM","HN","HR","YE","HT","HU","ID","YT","IE","IL","IM","IN","IO","ZA","IQ","IS","IT","ZM","JE","ZW","JM","JO","JP","KE","KG","KH","KI","KM","KN","KP","KR","KW","KY","KZ","LA","LB","LC","LI","LK","LR","LS","LT","LU","LV","LY","MA","MC","MD","ME","MF","MG","MH","MK","ML","MM","MN","MO","MP","MQ","MR","MS","MT","MU","MV","MW","MX","MY","MZ","NA","NC","NE","NF","NG","NI","NL","NO","NP","NR","NU","NZ","OM","PA","PE","PF","PG","PH","PK","PL","PM","PN"]';
$countries=json_decode($countriesJson);
foreach ($countries as $country) {
    $country=strtolower($country);
    $country="us";
    $storeUrl = "https://itunes.apple.com/{$country}/genre/ios/id36?mt=8";
    if (file_get_contents($storeUrl)) {
    } else {
        echo "country:${country} can`t get context\n";
        die;
    }

}
