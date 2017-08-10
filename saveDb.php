<?php
/*
 *CREATE TABLE `ios_app_category` (
 *  `id` int(11) NOT NULL AUTO_INCREMENT,
 *  `ios_app_category_id` varchar(45) COLLATE utf8_bin DEFAULT NULL,
 *  `parent_id` varchar(45) COLLATE utf8_bin DEFAULT NULL,
 *  `ios_app_category_name` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'app category engilsh name',
 *  `locale_names` longtext COLLATE utf8mb4_bin COMMENT 'json key value map, if a category has many names of different countries, visit this field to get specify name.',
 *  PRIMARY KEY (`id`),
 *  UNIQUE KEY `category_id` (`ios_app_category_id`),
 *  KEY `parenet_id` (`parent_id`),
 *  KEY `category_parent_id` (`ios_app_category_id`,`parent_id`)
 *) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
 */

$CAT=unserialize(file_get_contents('/tmp/res.json'));

$link = mysqli_connect('172.16.25.87', 'dba', 'madsolution');
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}

$countriesJson='["US","PR","PS","PT","PW","PY","QA","AD","AE","AF","AG","AI","AL","AM","AN","AO","AQ","AR","AS","AT","RE","AU","AW","AX","AZ","RO","BA","BB","RS","BD","BE","RU","BF","BG","RW","BH","BI","BJ","BL","BM","BN","BO","SA","SB","BQ","BR","SC","BS","SE","BT","SG","BV","BW","SH","SI","BY","SJ","SK","BZ","SL","SM","SN","SO","CA","SR","SS","CC","CD","ST","SV","CF","CG","CH","SX","CI","SZ","CK","CL","CM","CN","CO","CR","TC","TD","TF","TG","CV","TH","CW","CX","CY","TJ","CZ","TK","TL","TM","TN","TO","TR","TT","DE","TV","TW","TZ","DJ","DK","DM","DO","UA","UG","DZ","UM","EC","EE","EG","EH","UY","UZ","VA","VC","ER","ES","VE","ET","VG","VI","VN","VU","FI","FJ","FK","FM","FO","FR","WF","GA","GB","WS","GD","GE","GF","GG","GH","GI","GL","GM","GN","GP","GQ","GR","GS","GT","GU","GW","GY","XK","HK","HM","HN","HR","YE","HT","HU","ID","YT","IE","IL","IM","IN","IO","ZA","IQ","IS","IT","ZM","JE","ZW","JM","JO","JP","KE","KG","KH","KI","KM","KN","KP","KR","KW","KY","KZ","LA","LB","LC","LI","LK","LR","LS","LT","LU","LV","LY","MA","MC","MD","ME","MF","MG","MH","MK","ML","MM","MN","MO","MP","MQ","MR","MS","MT","MU","MV","MW","MX","MY","MZ","NA","NC","NE","NF","NG","NI","NL","NO","NP","NR","NU","NZ","OM","PA","PE","PF","PG","PH","PK","PL","PM","PN"]';
$countries=json_decode($countriesJson);

$insertCountry=null;
foreach($CAT as $country => $countryInfo) {
    echo "country".$country."\n";
    foreach($countryInfo as $catId => $info) {
        echo "catId:".$catId."\n";
        echo "name:".$info['name']."\n";
        echo "parent_id:".$info['parent_id']."\n";
        foreach($countries as $cnt) {
            $cnt=strtolower($cnt);
            @$insertCountry[$cnt]=$CAT[$cnt][$catId]['name'];
        }
        if (!empty($insertCountry[$country])) {
            @mysqli_query($link, "insert into adsapi.ios_app_category(ios_app_category_id, parent_id, ios_app_category_name, locale_names) values('{$catId}','".$info['parent_id']."','".$info['name']."','".addslashes(json_encode($insertCountry, JSON_UNESCAPED_UNICODE))."')");
        }
    }
}
mysqli_close($link);

