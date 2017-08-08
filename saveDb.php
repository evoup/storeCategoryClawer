<?php
/*
  +----------------------------------------------------------------------+
  | Name:
  +----------------------------------------------------------------------+
  | Comment:
  +----------------------------------------------------------------------+
  | Author:Evoup     evoex@126.com                                                     
  +----------------------------------------------------------------------+
  | Create:
  +----------------------------------------------------------------------+
  | Last-Modified:
  +----------------------------------------------------------------------+
*/

$CAT=unserialize(file_get_contents('/tmp/res.json'));

$link = mysqli_connect('172.16.25.87', 'dba', 'madsolution');
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}

print_r($CAT);
die;

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
            $x=json_encode($insertCountry);
            mysqli_query($link, "insert into adsapi.ios_app_category(ios_app_category_id, parent_id, ios_app_category_name, locale_names) values('{$catId}','".$info['parent_id']."','".$info['name']."','".json_encode($insertCountry)."')");
        }
    }
}
mysqli_close($link);

