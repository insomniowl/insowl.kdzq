<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hp</title>
</head>
<body>
<?php
$curlobj = curl_init();
curl_setopt($curlobj,CURLOPT_URL,"http://m.hupu.com/soccer");
curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
$output = curl_exec($curlobj);
curl_close($curlobj);
$html = new DOMDocument();
$html->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$output);
$a = $html->getElementsByTagName("a");
echo mysql_connect('localhost','root','qwe12345') ? 'connect success'.'<br>' : mysql_error().'<br>';
echo mysql_select_db('dbtest') ? 'link db success'.'<br>' : mysql_error().'<br>';
mysql_query("set names utf8");
for ($i = 0;$i < $a->length;$i++) {
    if($a->item($i)->getAttribute('class') == 'list smail-pic-list'){
        $url = $a->item($i)->getAttribute('href');
        $title = ltrim($a->item($i)->childNodes->item(3)->childNodes->item(1)->nodeValue);
        $time = date('Y-m-d H:i:s', time());
        $sql = "insert into news values ('$title','$url','$time','hp')";
        if(mysql_query($sql)){
            echo $title.' insert success'.'<br>';
        }
//        else echo mysql_error().'<br>'.'<br>';
    }
}
?>
</body>
</html>
