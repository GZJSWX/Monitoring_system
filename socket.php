<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
</head>
<body>
<?php
ignore_user_abort(); // 后台运行 
set_time_limit(0); // 取消脚本运行时间的超时上限
do{
    require "fun.php";
    $sfd = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); 
    socket_bind($sfd, "192.168.1.4",6589); 
    socket_listen($sfd, 511); 
    socket_set_option($sfd, SOL_SOCKET, SO_REUSEADDR, 1); 
    socket_set_nonblock($sfd); 
    $rfds = array($sfd);
    $wfds = array(); 
    do{ 
        $rs = $rfds; 
        $ws = $wfds; 
        $es = array(); 
        $ret = socket_select($rs, $ws, $es, 3); 
        //read event 
        foreach($rs as $fd){ 
            if($fd == $sfd){ 
                $cfd = socket_accept($sfd); 
                socket_set_nonblock($cfd); 
                $rfds[] = $cfd; 
                echo "new client coming, fd=$cfd\n"; 
            }else{ 
                $msg = socket_read($fd,6589); 
                if($msg <= 0){      
                }else{ 
                    $a = explode(",",$msg);
                    $datetime = date("Y-m-d H:i:s");
                    // echo $datetime;
                    // echo "<br />";
                    // echo $a[0];
                    // echo "<br />";
                    // echo $a[1];
                    // echo "<br />";
                    // echo $a[2];
                    // echo "<br />";
                    // echo $a[3];
                    // echo "<br />";
                    // echo $a[4];
                    // echo "<br />";
                    // echo $a[5];
                    if($a[0]=="11111"){
                        $wd_sql = "insert into szsj values('$datetime','$a[1]','$a[2]','$a[3]','$a[4]')";
                        mysqli_query($conn,$wd_sql);
                    }else if($a[0]=="22222"){
                        $wd_sql = "insert into kqsj values('$datetime','$a[1]','$a[2]','$a[3]','$a[4]','$a[5]')";
                        mysqli_query($conn,$wd_sql);
                    }else if($a[0]=="33333"){
                        $wd_sql = "insert into trsj values('$datetime','$a[1]','$a[2]')";
                        mysqli_query($conn,$wd_sql);
                    }else{
                        echo "数据错误";
                    } 
                }   
            } 
        } 
    }while(true); 
}while(true);
?>
</body>
</html>