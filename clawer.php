<?php
require "vendor/autoload.php";
use PHPHtmlParser\Dom;
$link = mysqli_connect('172.16.25.87', 'dba', 'madsolution');
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}
$CAT=null;

$countriesJson='["US","PR","PS","PT","PW","PY","QA","AD","AE","AF","AG","AI","AL","AM","AN","AO","AQ","AR","AS","AT","RE","AU","AW","AX","AZ","RO","BA","BB","RS","BD","BE","RU","BF","BG","RW","BH","BI","BJ","BL","BM","BN","BO","SA","SB","BQ","BR","SC","BS","SE","BT","SG","BV","BW","SH","SI","BY","SJ","SK","BZ","SL","SM","SN","SO","CA","SR","SS","CC","CD","ST","SV","CF","CG","CH","SX","CI","SZ","CK","CL","CM","CN","CO","CR","TC","TD","TF","TG","CV","TH","CW","CX","CY","TJ","CZ","TK","TL","TM","TN","TO","TR","TT","DE","TV","TW","TZ","DJ","DK","DM","DO","UA","UG","DZ","UM","EC","EE","EG","EH","UY","UZ","VA","VC","ER","ES","VE","ET","VG","VI","VN","VU","FI","FJ","FK","FM","FO","FR","WF","GA","GB","WS","GD","GE","GF","GG","GH","GI","GL","GM","GN","GP","GQ","GR","GS","GT","GU","GW","GY","XK","HK","HM","HN","HR","YE","HT","HU","ID","YT","IE","IL","IM","IN","IO","ZA","IQ","IS","IT","ZM","JE","ZW","JM","JO","JP","KE","KG","KH","KI","KM","KN","KP","KR","KW","KY","KZ","LA","LB","LC","LI","LK","LR","LS","LT","LU","LV","LY","MA","MC","MD","ME","MF","MG","MH","MK","ML","MM","MN","MO","MP","MQ","MR","MS","MT","MU","MV","MW","MX","MY","MZ","NA","NC","NE","NF","NG","NI","NL","NO","NP","NR","NU","NZ","OM","PA","PE","PF","PG","PH","PK","PL","PM","PN"]';
//$countriesJson='["US","PR","PS","PT","PW"]';
$countries=json_decode($countriesJson);
$bigLev=null;
foreach ($countries as $country) {
    $country=strtolower($country);
    //$country="us";
    $storeUrl = "https://itunes.apple.com/{$country}/genre/ios/id36?mt=8";
    $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $storeUrl,
        CURLOPT_USERAGENT => $userAgent 
    ));
    $resp = curl_exec($ch);
    $dom = new Dom;
    $dom->loadStr($resp, []);
    $html = $dom->outerHtml;
    foreach ($dom->find('div[class=grid3-column] ul') as $ul) {
        foreach ($ul->find('li') as $li) {
            $innerUlInfo=$li->find('ul');
            if (sizeof($innerUlInfo)>0) {
                $dom1 = new Dom;
                $dom1->loadStr($li, []);
                // <a href="https://itunes.apple.com/us/genre/ios-games/id6014?mt=8" class="top-level-genre" title="Games - App Store Downloads on iTunes">Games</a>
                $a=$dom1->find('a')[0];
                echo ">>>>>>>>".$a."\n"; // this is parent node li, should find ul bebow it 
                preg_match_all("/^.*id(.*)\?mt=8.*$/", $a->href, $matches, PREG_SET_ORDER);
                $cat_id=$matches[0][1];
                $text=htmlspecialchars_decode($a->text);
                $CAT[$country][$cat_id]['name']=$text;
                $CAT[$country][$cat_id]['parent_id']=null;
                $bigLev=$cat_id;
                echo $bigLev;
                // a attribute is parent node info
                foreach($innerUlInfo as $innerUl) {
                    // each li is sub node info
                    foreach ($innerUl->find('li') as $innerLi) {
                        // <a href="https://itunes.apple.com/us/genre/ios-games-action/id7001?mt=8" title="Action - App Store Downloads on iTunes">Action</a>
                        $dom3 = new Dom;
                        $dom3->loadStr($innerLi, []);
                        $a=$dom3->find('a')[0];
                        echo ">>>>>>>>>>>>".$a."\n";
                        preg_match_all("/^.*id(.*)\?mt=8.*$/", $a->href, $matches, PREG_SET_ORDER);
                        $cat_id=$matches[0][1];
                        $text=htmlspecialchars_decode($a->text);
                        $CAT[$country][$cat_id]['name']=$text;
                        $CAT[$country][$cat_id]['parent_id']=$bigLev;
                    }
                }
            } else {
                // this is single node li
                // <a href="https://itunes.apple.com/us/genre/ios-books/id6018?mt=8" class="top-level-genre" title="Books - App Store Downloads on iTunes">Books</a>
                $dom2 = new Dom;
                $dom2->loadStr($li, []);
                $a=$dom2->find('a')[0];
                echo ">>>>".$a."\n"; 
                preg_match_all("/^.*id(.*)\?mt=8.*$/", $a->href, $matches, PREG_SET_ORDER);
                $cat_id=$matches[0][1];
                $text=htmlspecialchars_decode($a->text);
                $CAT[$country][$cat_id]['name']=$text;
                $CAT[$country][$cat_id]['parent_id']=null;
                //echo $a->text;
                //echo $a->href;
            }
        }
    }

}
//mysqli_query($link, "insert into adsapi.ios_app_category(ios_app_category_id, parent_id, ios_app_category_name, locale_names) values('{$cat_id}',null,'{$text}','{}')");
print_r($CAT);
foreach($CAT as $country => $countryInfo) {
    echo "country".$country."\n";
    foreach($countryInfo as $catId=> $info) {
        echo "catId:".$catId."\n";
        echo "name:".$info['name']."\n";
        echo "parent_id:".$info['parent_id']."\n";
        foreach($countries as $cnt) {
            $cnt=strtolower($cnt);
            @$insertCountry[$cnt]=$CAT[$cnt][$catId]['name'];
        }
        if (!empty($insertCountry[$cnt])) {
            mysqli_query($link, "insert into adsapi.ios_app_category(ios_app_category_id, parent_id, ios_app_category_name, locale_names) values('{$catId}','".$info['parent_id']."','".$info['name']."','".json_encode($insertCountry)."')");
        }
    }
}
mysqli_close($link);
file_put_contents("/tmp/res.json", json_encode($CAT));

