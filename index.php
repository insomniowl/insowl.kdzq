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
        <a href="http://testubuntu.com"><h1>口袋足球</h1></a>
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
            $link = mysqli_connect('localhost','root','','test');
            mysqli_query($link,"set names utf8");
            $sql = "select * from news order by time desc limit 0,30";
            $q = mysqli_query($link,$sql);
            echo "<ul id='uli'>";
            while($res = mysqli_fetch_row($q)){
                echo "<li><a href=$res[1]><div class=$res[3]><h3>$res[0]</h3></div></a></li>";
            }
            echo "</ul></div>";
        ?>
        <div id="loadmore" align="center"> 加载更多 </div>
    </div>
    <div id="footer" style="text-align: center">
        <p>by insowl.</p>
    </div>
</div>
<script>
    var p = 0;
    document.getElementById("loadmore").onclick = function(){
        p++;
        var request = new XMLHttpRequest();
        request.open("GET","nextpage.php?p=" + p);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState === 4 && request.status === 200){
                document.getElementById("uli").innerHTML += request.responseText;
            }
        }
    }
</script>
</body>
</html>
