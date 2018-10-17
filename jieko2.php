<?php 
    require "fun.php";
    $sj = $_GET['sj'];
    $jtrq = $_GET['jtrq'];
    if($sj=='tr'){
        $sql = mysqli_query($conn,"select * from trsj where rq = '$jtrq'");
        $a = mysqli_fetch_assoc($sql);
        $json = array($a);
        echo json_encode($json);
    }else if($sj=='kq'){
        $sql = mysqli_query($conn,"select * from kqsj where rq = '$jtrq'");
        $a = mysqli_fetch_assoc($sql);
        $json = array($a);
        echo json_encode($json); 
    }else if($sj=='sz'){
        $sql = mysqli_query($conn,"select * from szsj where rq = '$jtrq'");
        $a = mysqli_fetch_assoc($sql);
        $json = array($a);
        echo json_encode($json);  
    }else{
        echo "请求数据格式错误";
    }
?>