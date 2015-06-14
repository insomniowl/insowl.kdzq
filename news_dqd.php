<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>dqd</title>
</head>
<body>
<?php
$curlobj = curl_init();
curl_setopt($curlobj,CURLOPT_URL,"http://www.dongqiudi.com/");
curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
$output = curl_exec($curlobj);
curl_close($curlobj);
$html = new DOMDocument();
$html->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$output);
$h2 = $html->getElementsByTagName("h2");
echo mysql_connect('localhost','root','qwe12345') ? 'connect success'.'<br>' : mysql_error().'<br>';
echo mysql_select_db('dbtest') ? 'link db success'.'<br>' : mysql_error().'<br>';
mysql_query("set names utf8");
for ($i = 3;$i < $h2->length;$i++) {
    $url = 'http://m.dongqiudi.com/article.html?id='.substr($h2->item($i)->childNodes->item(1)->getAttribute('href'),9).'&type=undefined';
    $title = ltrim($h2->item($i)->nodeValue);
    $time = date('Y-m-d H:i:s', time());
    $sql = "insert into news values ('$title','$url','$time','dqd')";
    if(mysql_query($sql)){
        echo $title.' insert success'.'<br>';
    }
//    else echo mysql_error().'<br>'.'<br>';
}
?>
</body>
</html>

</html>
