<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>口袋足球——Soccer News in Your Pocket</title>
    <meta http-equiv="X-UA-COMPATIBLE" content="IE-edge,chrome=1"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <link rel="stylesheet" href="/c_v0.1.css"/>
</head>
<body>
<div id="main">
    <div id="header">
        <h1>口袋足球</h1>
    </div>
    <div id="body">
        <div id="checkbox">
            <form action="" method="">
                <label><input name="site" type="checkbox" value="" checked="checked"/>直播吧</label>
                <label><input name="site "type="checkbox" value="" checked="checked"/>懂球帝</label>
                <label><input name="site" type="checkbox" value="" checked="checked"/>虎扑</label>
            </form>
        </div>
        <?php
            echo "<div id='list'>";
//            $page = 1;
            mysql_connect('localhost','root','qwe12345');
            mysql_select_db('dbtest');
            mysql_query("set names utf8");
            $sql = "select * from news order by time desc limit 0,100";
            $q = mysql_query($sql);
            echo "<ul>";
            while($res = mysql_fetch_row($q)){
                echo "<li><a href=$res[1]><div class=$res[3]><h3>$res[0]</h3></div></a></li>";
            }
            echo "</ul></div>";
//            echo "<div id='loadmore' style='text-align: center'><a href=".$SERVER['PHP_SELF']."?p=".($page+1).">more...</a></div>";
        ?>
        <div id="loadmore">more...</div>
    </div>
    <div id="footer" style="text-align: center">
        <p>by insowl.</p>
    </div>
</div>
</body>
</html>
