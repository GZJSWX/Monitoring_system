<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.STYLE1{
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
	require "fun.php";
	$sql="select * from kqsj";//得到查询语句
	$result=mysqli_query($conn,$sql);
	$total=mysqli_num_rows($result);//结果集中行的数目
	$page=isset($_GET['page'])?intval($_GET['page']):1;//当前页；获取地址栏中page的值，不存在设为1
	$num=12;//每页显示12条记录
	$bothNum=4;
	$url='KongQiShuJu.php';//本页url
	$pagenum=ceil($total/$num);//总页数，最后一页
	$new_sql=$sql." limit ".($page-1)*$num.",".$num;//按每页记录生成查询语句
	$new_result=mysqli_query($conn,$new_sql);
	$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
	if($new_row=mysqli_fetch_array($new_result)){
		echo "<br><center><font size=8 face=楷体_GB2312 color=#008000>水稻生长信息——空气环境</font></center>";
		echo "<table width=800 border=1 align=center cellpadding=0 cellspacing=0 class=STYLE1>";
		echo "<tr>";
		echo "<td>时间</th>";
		echo "<td>空气温度</td>";
		echo "<td>空气湿度</td>";
		echo "<td>二氧化碳含量</td>";
		echo "<td>PM2.5含量</td>";
		echo "<td>光照强度</td>";
		echo "</tr>";
	do
	{
		list($sj,$kqwd,$kqsd,$co2,$pm,$gzqd)=$new_row;
		$timeTemp=strtotime($sj);//将时间解析为时间戳
		$time=date("Y-n-j H:i:s",$timeTemp);
		echo "<td>$time</td>";
		echo "<td>$kqwd</td>";
		echo "<td>$kqsd</td>";
		echo "<td>$co2</td>";
		echo "<td>$pm</td>";
		echo "<td>$gzqd</td>";
		echo "</tr>";
	}while($new_row=mysqli_fetch_array($new_result));
	echo "</table>";
	$pagenav="";
	if($page==1){
    	$pagestr.='<span>上一页</span>';
	}else{
	    $lastPage=$page-1;
	    $pagenav.="<a href='$url?page=$lastPage'>上一页</a>"."  ";
	}
	if($page-$bothNum>1){
	    $pagenav.="<a href='$url?page=1'>首页</a>";
	    $pagenav.="<span>...</span>";
	}
	//当前页的左边
	for($i=$bothNum;$i>=1;$i--){
	    if(($page - $i) < 1 ) { // 当前页左边花最多 bothnum 个数字
	         continue;
	     }
	    $lastPage=$page-$i;
	    $pagenav.="<a href='$url?page=$lastPage'>$lastPage</a>"."  ";
	}
	//当前页
	$pagenav.="<span>$page</span>"."  ";
	//当前页右边
	for($i=1;$i<=$bothNum;$i++){
	    if(($page + $i) > $pagenum) { // 当前页右边最多 bothnum 个数字
	        break;
	    }
	    $lastPage=$page+$i;
	    $pagenav.="<a href='$url?page=$lastPage'>$lastPage</a>"."  ";
	}
	//尾页
	if(($cur_page+$bothNum)<$pagenum){
	    $pagenav.="<span>...</span>"."  ";
	    $pagenav .= '<a href="?page='.$pagenum.'">尾页</a>'."  ";
	}
	//下一页
	if($pagenum==1){
			$pagenav .='';
	}else if($page == $pagenum) {
    	$pagenav .= '';
	} else {
       $nextPage=$page+1;
       $pagenav .= "<a href='$url?page={$nextPage}'>下一页</a>";
  	}
		$pagenav.="共(".$pagenum.")页";
		//输出分页导航
		echo "<br><div align=center class=STYLE1><b>".$pagenav."</b></div>";
	}else
	echo "<script>alert('无记录！');location.href='KongQiShuJu.php';</script>";
	?>
</body>
</html>