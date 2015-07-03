<?php
header("Content-Type: text/plain; charset=utf-8");
//建立数据库连接
$link = mysqli_connect('localhost','root','','test');
echo $link ? 'connect success'.'</br>' : mysql_error().'</br>';
mysqli_query($link,"set names utf8");

//抓取懂球帝新闻
$curlobj = curl_init();
curl_setopt($curlobj,CURLOPT_URL,"http://www.dongqiudi.com/");
curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
$html1 = curl_exec($curlobj);
curl_close($curlobj);
$dom1 = new DOMDocument();
$dom1->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$html1);
$h2 = $dom1->getElementsByTagName("h2");
for ($i = 3;$i < $h2->length;$i++) {
    $url = 'http://m.dongqiudi.com/article.html?id='.substr($h2->item($i)->childNodes->item(1)->getAttribute('href'),9).'&type=undefined';
    $title = ltrim($h2->item($i)->nodeValue);
    $time = date('Y-m-d H:i:s', time());
    $sql = "insert into news values ('$title','$url','$time','dqd')";
    if(mysqli_query($link,$sql)){
        echo $title.' insert at '.$time.'<br>';
    }
}

//抓取虎扑足球新闻
$curlobj = curl_init();
curl_setopt($curlobj,CURLOPT_URL,"http://m.hupu.com/soccer");
curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
$html2 = curl_exec($curlobj);
curl_close($curlobj);
$dom2 = new DOMDocument();
$dom2->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$html2);
$a = $dom2->getElementsByTagName("a");
for ($i = 0;$i < $a->length;$i++) {
    if($a->item($i)->getAttribute('class') == 'list smail-pic-list'){
        $url = $a->item($i)->getAttribute('href');
        $title = ltrim($a->item($i)->childNodes->item(3)->childNodes->item(1)->nodeValue);
        $time = date('Y-m-d H:i:s', time());
        $sql = "insert into news values ('$title','$url','$time','hp')";
        if(mysqli_query($link,$sql)){
            echo $title.' insert at '.$time.'<br>';
        }
    }
}

//抓取直播吧足球新闻
$curlobj = curl_init();
curl_setopt($curlobj,CURLOPT_URL,"http://m.zhibo8.cc/news/web/zuqiu/");
curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
$html3 = curl_exec($curlobj);
curl_close($curlobj);
$dom3 = new DOMDocument();
$dom3->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$html3);
$li = $dom3->getElementsByTagName("li");
for ($i = 5;$i < $li->length;$i++){
    $url = $li->item($i)->firstChild->firstChild->getAttribute('href');
    $title = $li->item($i)->nodeValue;
    $time = date('Y-m-d H:i:s',time());
    $sql = "insert into news values ('$title','$url','$time','zhb8')";
    if(mysqli_query($link,$sql)){
        echo $title.' insert at '.$time.'<br>';
    }
}
mysqli_close($link);