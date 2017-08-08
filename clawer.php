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
echo "---------------------------------------------------\n";
$countriesJson='["PR","PS","PT","PW","PY","QA","AD","AE","AF","AG","AI","AL","AM","AN","AO","AQ","AR","AS","AT","RE","AU","AW","AX","AZ","RO","BA","BB","RS","BD","BE","RU","BF","BG","RW","BH","BI","BJ","BL","BM","BN","BO","SA","SB","BQ","BR","SC","BS","SE","BT","SG","BV","BW","SH","SI","BY","SJ","SK","BZ","SL","SM","SN","SO","CA","SR","SS","CC","CD","ST","SV","CF","CG","CH","SX","CI","SZ","CK","CL","CM","CN","CO","CR","TC","TD","TF","TG","CV","TH","CW","CX","CY","TJ","CZ","TK","TL","TM","TN","TO","TR","TT","DE","TV","TW","TZ","DJ","DK","DM","DO","UA","UG","DZ","UM","US","EC","EE","EG","EH","UY","UZ","VA","VC","ER","ES","VE","ET","VG","VI","VN","VU","FI","FJ","FK","FM","FO","FR","WF","GA","GB","WS","GD","GE","GF","GG","GH","GI","GL","GM","GN","GP","GQ","GR","GS","GT","GU","GW","GY","XK","HK","HM","HN","HR","YE","HT","HU","ID","YT","IE","IL","IM","IN","IO","ZA","IQ","IS","IT","ZM","JE","ZW","JM","JO","JP","KE","KG","KH","KI","KM","KN","KP","KR","KW","KY","KZ","LA","LB","LC","LI","LK","LR","LS","LT","LU","LV","LY","MA","MC","MD","ME","MF","MG","MH","MK","ML","MM","MN","MO","MP","MQ","MR","MS","MT","MU","MV","MW","MX","MY","MZ","NA","NC","NE","NF","NG","NI","NL","NO","NP","NR","NU","NZ","OM","PA","PE","PF","PG","PH","PK","PL","PM","PN"]';
$countries=json_decode($countriesJson);
foreach ($countries as $country) {
    $country=strtolower($country);
    $country="us";
    $storeUrl = "https://itunes.apple.com/{$country}/genre/ios/id36?mt=8";
    $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
    $ch = curl_init();
    curl_setopt_array($ch, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $storeUrl,
			    CURLOPT_USERAGENT => $userAgent 
			    ));
    $resp = curl_exec($ch);
    //print_r($resp);
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->preserveWhiteSpace = false;
    @$dom->loadHTML($resp);

	$postalCodesList = $dom->getElementsByTagName('ul');
	//$div_a_class_nodes=getElementByClass($postalCodesList, 'div', 'list column first');
	//print_r($div_a_class_nodes);
	//die;
    //foreach ($postalCodesList as $node) {
        for ($i=0;$i<sizeof($postalCodesList);$i++) {
        foreach ($postalCodesList->item(6)->getElementsByTagName('li') as $postalCodesList) {
            echo $postalCodesList->nodeValue.'<br />';
            echo $postalCodesList->getElementsByTagName('a')->item(0)->getAttribute('href');
        }
    }



    die;
    //$postalCodesList = $dom->getElementsByTagName('ul');
    //foreach ($postalCodesList->item(6)->getElementsByTagName('li') as $postalCodesList) {
        //echo $postalCodesList->nodeValue.'<br />';
        //echo $postalCodesList->getElementsByTagName('a')->item(0)->getAttribute('href');
    //}



    $div=$dom->getElementById('genre-nav')->children(0)->outertext;
    echo $div;
    die;
    $uls = $div->item(0)->getElementsByTagName('div'); 
    print_r($uls);
    die;

    $html = $dom->saveHTML($dom->getElementById('genre-nav'));
    //print_r($html);
    $tables=$dom->loadHTML($html);
    $rows = $tables->item(0)->getElementsByTagName('ul'); 
    print_r($rows);
    die;
    $newHtml=$dom->getElementsByTagName('ul');
    print_r($newHtml->item(0)->getElementsByTagName('li')->nodeValue);
    die;
    foreach ($newHtml->item(0)->getElementsByTagName('li') as $liNode) {
        $liNode = $liNode->getElementByTagName('a');
        print_r($liNode->nodeValue);
    }
    die;
    $dom->loadHTML($html);
    
    echo $html;
    die;
    $node = $dom->getElementsByTagName('div')->item(1);    
    $outerHTML = $node->ownerDocument->saveHTML($node);  
    print_r($outerHTML);
    die;



    if (file_get_contents($storeUrl)) {
    } else {
        echo "country:${country} can`t get context\n";
        die;
    }

}

function getElementById($domDocument, $id) {
    $xpath = new DOMXPath($domDocument);
    return $xpath->query("//*[@id='$id']")->item(0);
}

function getElementsByClass(&$parentNode, $tagName, $className) {
    $nodes=array();

    $childNodeList = $parentNode->getElementsByTagName($tagName);
    for ($i = 0; $i < $childNodeList->length; $i++) {
            $temp = $childNodeList->item($i);
            if (stripos($temp->getAttribute('class'), $className) !== false) {
                $nodes[]=$temp;
                        }
        }

    return $nodes;
}

function getElementByClass(&$parentNode, $tagName, $className, $offset = 0) {
    $response = false;

    $childNodeList = $parentNode->getElementsByTagName($tagName);
    $tagCount = 0;
    for ($i = 0; $i < $childNodeList->length; $i++) {
        $temp = $childNodeList->item($i);
        if (stripos($temp->getAttribute('class'), $className) !== false) {
            if ($tagCount == $offset) {
                $response = $temp;
                break;
            }

            $tagCount++;
        }

    }

    return $response;
}

