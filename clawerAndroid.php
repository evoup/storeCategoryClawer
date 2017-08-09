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
require "vendor/autoload.php";
use PHPHtmlParser\Dom;
$CAT=null;

//language code from http://www.lingoes.net/en/translator/langcode.htm
$languageCode = array(
	'af'=>'Afrikaans',
	'af-ZA'=>'Afrikaans (South Africa)',
	'ar'=>'Arabic',
	'ar-AE'=>'Arabic (U.A.E.)',
	'ar-BH'=>'Arabic (Bahrain)',
	'ar-DZ'=>'Arabic (Algeria)',
	'ar-EG'=>'Arabic (Egypt)',
	'ar-IQ'=>'Arabic (Iraq)',
	'ar-JO'=>'Arabic (Jordan)',
	'ar-KW'=>'Arabic (Kuwait)',
	'ar-LB'=>'Arabic (Lebanon)',
	'ar-LY'=>'Arabic (Libya)',
	'ar-MA'=>'Arabic (Morocco)',
	'ar-OM'=>'Arabic (Oman)',
	'ar-QA'=>'Arabic (Qatar)',
	'ar-SA'=>'Arabic (Saudi Arabia)',
	'ar-SY'=>'Arabic (Syria)',
	'ar-TN'=>'Arabic (Tunisia)',
	'ar-YE'=>'Arabic (Yemen)',
	'az'=>'Azeri (Latin)',
	'az-AZ'=>'Azeri (Latin) (Azerbaijan)',
	'az-AZ'=>'Azeri (Cyrillic) (Azerbaijan)',
	'be'=>'Belarusian',
	'be-BY'=>'Belarusian (Belarus)',
	'bg'=>'Bulgarian',
	'bg-BG'=>'Bulgarian (Bulgaria)',
	'bs-BA'=>'Bosnian (Bosnia and Herzegovina)',
	'ca'=>'Catalan',
	'ca-ES'=>'Catalan (Spain)',
	'cs'=>'Czech',
	'cs-CZ'=>'Czech (Czech Republic)',
	'cy'=>'Welsh',
	'cy-GB'=>'Welsh (United Kingdom)',
	'da'=>'Danish',
	'da-DK'=>'Danish (Denmark)',
	'de'=>'German',
	'de-AT'=>'German (Austria)',
	'de-CH'=>'German (Switzerland)',
	'de-DE'=>'German (Germany)',
	'de-LI'=>'German (Liechtenstein)',
	'de-LU'=>'German (Luxembourg)',
	'dv'=>'Divehi',
	'dv-MV'=>'Divehi (Maldives)',
	'el'=>'Greek',
	'el-GR'=>'Greek (Greece)',
	'en'=>'English',
	'en-AU'=>'English (Australia)',
	'en-BZ'=>'English (Belize)',
	'en-CA'=>'English (Canada)',
	'en-CB'=>'English (Caribbean)',
	'en-GB'=>'English (United Kingdom)',
	'en-IE'=>'English (Ireland)',
	'en-JM'=>'English (Jamaica)',
	'en-NZ'=>'English (New Zealand)',
	'en-PH'=>'English (Republic of the Philippines)',
	'en-TT'=>'English (Trinidad and Tobago)',
	'en-US'=>'English (United States)',
	'en-ZA'=>'English (South Africa)',
	'en-ZW'=>'English (Zimbabwe)',
	'eo'=>'Esperanto',
	'es'=>'Spanish',
	'es-AR'=>'Spanish (Argentina)',
	'es-BO'=>'Spanish (Bolivia)',
	'es-CL'=>'Spanish (Chile)',
	'es-CO'=>'Spanish (Colombia)',
	'es-CR'=>'Spanish (Costa Rica)',
	'es-DO'=>'Spanish (Dominican Republic)',
	'es-EC'=>'Spanish (Ecuador)',
	'es-ES'=>'Spanish (Castilian)',
	'es-ES'=>'Spanish (Spain)',
	'es-GT'=>'Spanish (Guatemala)',
	'es-HN'=>'Spanish (Honduras)',
	'es-MX'=>'Spanish (Mexico)',
	'es-NI'=>'Spanish (Nicaragua)',
	'es-PA'=>'Spanish (Panama)',
	'es-PE'=>'Spanish (Peru)',
	'es-PR'=>'Spanish (Puerto Rico)',
	'es-PY'=>'Spanish (Paraguay)',
	'es-SV'=>'Spanish (El Salvador)',
	'es-UY'=>'Spanish (Uruguay)',
	'es-VE'=>'Spanish (Venezuela)',
	'et'=>'Estonian',
	'et-EE'=>'Estonian (Estonia)',
	'eu'=>'Basque',
	'eu-ES'=>'Basque (Spain)',
	'fa'=>'Farsi',
	'fa-IR'=>'Farsi (Iran)',
	'fi'=>'Finnish',
	'fi-FI'=>'Finnish (Finland)',
	'fo'=>'Faroese',
	'fo-FO'=>'Faroese (Faroe Islands)',
	'fr'=>'French',
	'fr-BE'=>'French (Belgium)',
	'fr-CA'=>'French (Canada)',
	'fr-CH'=>'French (Switzerland)',
	'fr-FR'=>'French (France)',
	'fr-LU'=>'French (Luxembourg)',
	'fr-MC'=>'French (Principality of Monaco)',
	'gl'=>'Galician',
	'gl-ES'=>'Galician (Spain)',
	'gu'=>'Gujarati',
	'gu-IN'=>'Gujarati (India)',
	'he'=>'Hebrew',
	'he-IL'=>'Hebrew (Israel)',
	'hi'=>'Hindi',
	'hi-IN'=>'Hindi (India)',
	'hr'=>'Croatian',
	'hr-BA'=>'Croatian (Bosnia and Herzegovina)',
	'hr-HR'=>'Croatian (Croatia)',
	'hu'=>'Hungarian',
	'hu-HU'=>'Hungarian (Hungary)',
	'hy'=>'Armenian',
	'hy-AM'=>'Armenian (Armenia)',
	'id'=>'Indonesian',
	'id-ID'=>'Indonesian (Indonesia)',
	'is'=>'Icelandic',
	'is-IS'=>'Icelandic (Iceland)',
	'it'=>'Italian',
	'it-CH'=>'Italian (Switzerland)',
	'it-IT'=>'Italian (Italy)',
	'ja'=>'Japanese',
	'ja-JP'=>'Japanese (Japan)',
	'ka'=>'Georgian',
	'ka-GE'=>'Georgian (Georgia)',
	'kk'=>'Kazakh',
	'kk-KZ'=>'Kazakh (Kazakhstan)',
	'kn'=>'Kannada',
	'kn-IN'=>'Kannada (India)',
	'ko'=>'Korean',
	'ko-KR'=>'Korean (Korea)',
	'kok'=>'Konkani',
	'kok-IN'=>'Konkani (India)',
	'ky'=>'Kyrgyz',
	'ky-KG'=>'Kyrgyz (Kyrgyzstan)',
	'lt'=>'Lithuanian',
	'lt-LT'=>'Lithuanian (Lithuania)',
	'lv'=>'Latvian',
	'lv-LV'=>'Latvian (Latvia)',
	'mi'=>'Maori',
	'mi-NZ'=>'Maori (New Zealand)',
	'mk'=>'FYRO Macedonian',
	'mk-MK'=>'FYRO Macedonian (Former Yugoslav Republic of Macedonia)',
	'mn'=>'Mongolian',
	'mn-MN'=>'Mongolian (Mongolia)',
	'mr'=>'Marathi',
	'mr-IN'=>'Marathi (India)',
	'ms'=>'Malay',
	'ms-BN'=>'Malay (Brunei Darussalam)',
	'ms-MY'=>'Malay (Malaysia)',
	'mt'=>'Maltese',
	'mt-MT'=>'Maltese (Malta)',
	'nb'=>'Norwegian (Bokm?l)',
	'nb-NO'=>'Norwegian (Bokm?l) (Norway)',
	'nl'=>'Dutch',
	'nl-BE'=>'Dutch (Belgium)',
	'nl-NL'=>'Dutch (Netherlands)',
	'nn-NO'=>'Norwegian (Nynorsk) (Norway)',
	'ns'=>'Northern Sotho',
	'ns-ZA'=>'Northern Sotho (South Africa)',
	'pa'=>'Punjabi',
	'pa-IN'=>'Punjabi (India)',
	'pl'=>'Polish',
	'pl-PL'=>'Polish (Poland)',
	'ps'=>'Pashto',
	'ps-AR'=>'Pashto (Afghanistan)',
	'pt'=>'Portuguese',
	'pt-BR'=>'Portuguese (Brazil)',
	'pt-PT'=>'Portuguese (Portugal)',
	'qu'=>'Quechua',
	'qu-BO'=>'Quechua (Bolivia)',
	'qu-EC'=>'Quechua (Ecuador)',
	'qu-PE'=>'Quechua (Peru)',
	'ro'=>'Romanian',
	'ro-RO'=>'Romanian (Romania)',
	'ru'=>'Russian',
	'ru-RU'=>'Russian (Russia)',
	'sa'=>'Sanskrit',
	'sa-IN'=>'Sanskrit (India)',
	'se'=>'Sami (Northern)',
	'se-FI'=>'Sami (Northern) (Finland)',
	'se-FI'=>'Sami (Skolt) (Finland)',
	'se-FI'=>'Sami (Inari) (Finland)',
	'se-NO'=>'Sami (Northern) (Norway)',
	'se-NO'=>'Sami (Lule) (Norway)',
	'se-NO'=>'Sami (Southern) (Norway)',
	'se-SE'=>'Sami (Northern) (Sweden)',
	'se-SE'=>'Sami (Lule) (Sweden)',
	'se-SE'=>'Sami (Southern) (Sweden)',
	'sk'=>'Slovak',
	'sk-SK'=>'Slovak (Slovakia)',
	'sl'=>'Slovenian',
	'sl-SI'=>'Slovenian (Slovenia)',
	'sq'=>'Albanian',
	'sq-AL'=>'Albanian (Albania)',
	'sr-BA'=>'Serbian (Latin) (Bosnia and Herzegovina)',
	'sr-BA'=>'Serbian (Cyrillic) (Bosnia and Herzegovina)',
	'sr-SP'=>'Serbian (Latin) (Serbia and Montenegro)',
	'sr-SP'=>'Serbian (Cyrillic) (Serbia and Montenegro)',
	'sv'=>'Swedish',
	'sv-FI'=>'Swedish (Finland)',
	'sv-SE'=>'Swedish (Sweden)',
	'sw'=>'Swahili',
	'sw-KE'=>'Swahili (Kenya)',
	'syr'=>'Syriac',
	'syr-SY'=>'Syriac (Syria)',
	'ta'=>'Tamil',
	'ta-IN'=>'Tamil (India)',
	'te'=>'Telugu',
	'te-IN'=>'Telugu (India)',
	'th'=>'Thai',
	'th-TH'=>'Thai (Thailand)',
	'tl'=>'Tagalog',
	'tl-PH'=>'Tagalog (Philippines)',
	'tn'=>'Tswana',
	'tn-ZA'=>'Tswana (South Africa)',
	'tr'=>'Turkish',
	'tr-TR'=>'Turkish (Turkey)',
	'tt'=>'Tatar',
	'tt-RU'=>'Tatar (Russia)',
	'ts'=>'Tsonga',
	'uk'=>'Ukrainian',
	'uk-UA'=>'Ukrainian (Ukraine)',
	'ur'=>'Urdu',
	'ur-PK'=>'Urdu (Islamic Republic of Pakistan)',
	'uz'=>'Uzbek (Latin)',
	'uz-UZ'=>'Uzbek (Latin) (Uzbekistan)',
	'uz-UZ'=>'Uzbek (Cyrillic) (Uzbekistan)',
	'vi'=>'Vietnamese',
	'vi-VN'=>'Vietnamese (Viet Nam)',
	'xh'=>'Xhosa',
	'xh-ZA'=>'Xhosa (South Africa)',
	'zh'=>'Chinese',
	'zh-CN'=>'Chinese (S)',
	'zh-HK'=>'Chinese (Hong Kong)',
	'zh-MO'=>'Chinese (Macau)',
	'zh-SG'=>'Chinese (Singapore)',
	'zh-TW'=>'Chinese (T)',
	'zu'=>'Zulu',
	'zu-ZA'=>'Zulu (South Africa)');


//curl 'https://play.google.com/store/apps' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: zh-CN,zh;q=0.8' -H 'upgrade-insecure-requests: 1' -H 'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36' -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8' -H 'cache-control: max-age=0' -H 'authority: play.google.com' -H 'cookie: PLAY_PREFS=CvMGCAAS7gYKAlVTEIaIua3cKxqvBhESExQV1AHVAacCxATjBeUF6AXXBtgG3gbfBpCVgQaRlYEGkpWBBpeVgQa3lYEGuJWBBsCVgQbBlYEGxJWBBtSVgQbZlYEG8pWBBviVgQabloEGnZaBBp6WgQafloEGoJaBBu6XgQaCmIEGhZiBBomYgQaKmIEGi5iBBr6YgQarm4EGrZuBBsmbgQbKm4EGy5uBBtWbgQbwm4EGvJ2BBt2dgQbenYEG552BBpCegQbiooEG86KBBvyigQaLo4EGmqSBBuqlgQbGpoEG1KaBBtWmgQbWpoEG_qaBBoCngQaCp4EGhKeBBoangQaIp4EGiqeBBs6ogQbyqIEG9KiBBrysgQbWr4EGwbCBBqSxgQalsYEGh7KBBomygQbWsoEGsbSBBr-5gQbWuYEGosCBBsDAgQbywIEGwcGBBtbCgQaMxYEGj8WBBsrGgQbLxoEG-MeBBqrKgQbYzIEG3MyBBt3NgQaGzoEGoc-BBsTSgQaV1YEG2tiBBuLYgQbL2YEG8tuBBtjkgQaX5YEGuOiBBs_rgQaw7IEG1_WBBrr7gQa7_4EGyf-BBtWDggbIhIIG3oWCBrmGggamh4IGp4eCBrOHggbsh4IG7YeCBuuNggb7jYIGiY6CBo-RggbLkYIGlZiCBraZgga9mYIGj5qCBpmaggbBmoIG95qCBp2eggbVnoIGu6CCBvaiggbipIIGkqWCBvKnggaeqIIGtKiCBoG0ggaDtIIGhrSCBq22ggbCu4IG8b6CBo-_ggbqwIIGvMGCBufJggaRy4IGzcuCBtHLggbczIIG2NCCBvPRggaB2IIGm9iCBqbYggaj2oIGrduCBsXbggax3IIG6t2CBvjdggaJ3oIG5N-CBu_fggbQ4YIG0eGCBuXhggam5oIGlumCBqPtggaF7oIGnu6CBrDuggaF8IIGjfCCBpzwggax8IIGvfGCBuv2ggat-IIGs_iCBvb6ggbe-4IG4_uCBoT8ggav_IIG2_yCBt38ggaB_4IGgICDBtyBgwbygYMGkIWDBp2IgwbQiIMG8IiDBsaLgwaQj4MGuJWDBtqagwaNm4MGhqCDBv2ggwbMoYMGKN2Iua3cKzokMTEwZDQxYjctMTFmOS00ZDdlLWFiNDEtYjc0NzU1Y2M3ZTkzQAFIAA:S:ANO1ljJMsw4lNvhS_Q; NID=109=jHT4Rgn_B8y4YVsFp_B_E5vry75fk8e486DeU4v_3xMN-DTyLOZN3dtSatcdDNFqXRvPjweDBCmUm2nhR8yMu0SnicPLwfzQVVFQE3rZNfKadUrbC3RQTLR8sOwdowHs; _ga=GA1.3.705957279.1502260239; _gid=GA1.3.1898251535.1502260239; S=billing-ui-v3=Pk8JXgmffSZfbT5eNYFCIli-fbYRMzrd:billing-ui-v3-efe=Pk8JXgmffSZfbT5eNYFCIli-fbYRMzrd' -H 'referer: https://play.google.com/store' --compressed


$proxy="172.16.25.62:8123";
$proxy = explode(':', $proxy);
$storeUrl="https://play.google.com/store/apps";
$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';

//$languageCode=array('zh'=>'121');
foreach (array_keys($languageCode) as $code) {
    grab($storeUrl,$userAgent,$proxy,$code);
}

function grab($storeUrl,$userAgent,$proxy,$code) {
    echo "processing {$code}...\n";
    global $CAT;
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $storeUrl,
        CURLOPT_USERAGENT => $userAgent ,
        CURLOPT_PROXY => $proxy[0],
        CURLOPT_PROXYPORT => $proxy[1],
        CURLOPT_HTTPHEADER => ["Accept-Language: {$code}"]
    ));
    $resp = curl_exec($ch);
    $dom = new Dom;
    $dom->loadStr($resp, []);
    $html = $dom->outerHtml;
    $contentSection = null;
    foreach ($dom->find('div[class=action-bar-dropdown-children-container]') as $div) {
        $contentSection=$div;
        break; // just first section
    }
    echo "############\n";
    $dom->loadStr($contentSection, []);
    foreach ($dom->find('div ul li') as $ul) { // will get 3 section,which is finace,game,family 
        $dom1 = new Dom;
        $dom1->loadStr($ul, []);
        foreach($dom1->find('li ul li') as $li) {
            $dom2 = new Dom;
            $dom2->loadStr($li, []);
            foreach ($dom2->find('li a') as $app_detail_link) {
                $dom3 = new Dom;
                $dom3->loadStr($app_detail_link, []);
                $a=$dom2->find('a')[0];
                preg_match_all("/^.*\/store\/apps\/category\/(.*)$/", $a->href, $matches, PREG_SET_ORDER);
                if (isset($matches[0][1])) {
                    echo htmlspecialchars_decode($a->text)."\n";
                    $cat_id=$matches[0][1]; // android cat_id like GAME_SIMULATION 
                    $CAT[$code][$cat_id]['name']=htmlspecialchars_decode($a->text);
                }
            }
        }
        echo "---------\n"; // next section 
    } 
}

print_r($CAT);
file_put_contents("/tmp/res1.ser", serialize($CAT));



