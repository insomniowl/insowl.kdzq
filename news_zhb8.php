<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>zhib8</title>
</head>
<body>
<?php
$curlobj = curl_init();
curl_setopt($curlobj,CURLOPT_URL,"http://m.zhibo8.cc/news/web/zuqiu/");
curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
$output = curl_exec($curlobj);
curl_close($curlobj);
$html = new DOMDocument();
$html->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$output);
$li = $html->getElementsByTagName("li");
echo mysql_connect('localhost','root','qwe12345') ? 'connect success'.'<br>' : mysql_error().'<br>';
echo mysql_select_db('dbtest') ? 'link db success'.'<br>' : mysql_error().'<br>';
mysql_query("set names utf8");
for ($i = 5;$i < $li->length;$i++){
    $url = $li->item($i)->firstChild->firstChild->getAttribute('href');
    $title = $li->item($i)->nodeValue;
    $time = date('Y-m-d H:i:s',time());
    $sql = "insert into news values ('$title','$url','$time','zhb8')";
    if(mysql_query($sql)){
        echo $title.' insert at '.$time.'<br>';
    }
//    else echo mysql_error().'<br>'.'<br>';
}
?>
</body>
</html>
