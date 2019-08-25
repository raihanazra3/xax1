<?php

//http://egift.id/BU9S09H4220002
$linkAwal = 'http://egift.id/';
function getRandomWord($len = 10) {
    $word = array_merge(range(0, 9), range("A", "Z"), range('a', 'z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}
$udah = array();
$f = file_get_contents("udahan.txt");
if(!empty($f)) {
    $ex = explode("\n", $f);
    for($i=0;$i<count($ex);$i++) {
        array_push($udah, array($ex[$i] => "HEHE"));
    }
}
for($i=0;$i<99999;$i++) {
    if($i % 100 == 0 && $i > 0) {
        echo "....\n";
        sleep(5);
    }
    
    $rand = getRandomWord(8);
    $link = $linkAwal.$rand;
    if(!empty($udah[$rand])) {

    } else {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);
      
        curl_close($ch);

        if(preg_match("/class=\"grayscaleOn\"/", $res)) {
            $fp = fopen('udahan.txt', 'a+');
            fwrite($fp, $link."\n");
            fclose($fp);
            array_push($udah, array($link => "HEHE"));
        } else if(!strpos($res, '<html>') !== FALSE) {
            $fp = fopen('udahan.txt', 'a+');
            fwrite($fp, $link."\n");
            fclose($fp);
            array_push($udah, array($link => "HEHE"));
            echo "[$i/99999] $link => EMPTY \n";
        } else {
            $fp = fopen('mantap.txt', 'a+');
            fwrite($fp, $link."=> [".$nominal[1]."]\n");
            fclose($fp);
            preg_match("/id=\"p_item_name\">(.*?)<\/span/", $res, $nominal);
            echo "[$i/99999] $link => LIVE [".$nominal[1]."]\n";
            exit();
        }
    }
}
