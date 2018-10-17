<?php 
    require "fun.php";
    $sj = $_GET['sj'];
    $rq = $_GET['rq'];
    if($sj=='tr'){
        $sql = mysqli_query($conn,"select rq from trsj where rq like '$rq %'");
        while($row = mysqli_fetch_row($sql)){
            $a[] = $row[0];
        }
        $json = array($a);
        echo json_encode($json); 
    }else if($sj=='kq'){
        $sql = mysqli_query($conn,"select rq from kqsj where rq like '$rq %'");
        while($row = mysqli_fetch_row($sql)){
            $a[] = $row[0];
        }
        $json = array($a);
        echo json_encode($json); 
    }else if($sj=='sz'){
        $sql = mysqli_query($conn,"select rq from szsj where rq like '$rq %'");
        while($row = mysqli_fetch_row($sql)){
            $a[] = $row[0];
        }
        $json = array($a);
        echo json_encode($json);  
    }else{
        echo "请求数据错误";
    }
?>