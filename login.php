<?php
header("Content-type: text/html; charset=utf-8");
//判断是否有输入信息，若有输入信息则进行信息的处理，若无输入信息则返回原本的界面 isset标签判断变量是否存在
if (isset($_POST['submit'])) {
    //接收表单数据 trim标签是去除空格
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //合法性验证 empty标签判断值是否为空
    if(empty($username) || empty($password))
    {
        //header('refresh:3; url=denglujiemian.php');//refresh刷新

        echo "<script>alert('用户名或密码不能为空！');location.href='login.php';</script>";//若用户名或密码为空则跳出警告窗口
        exit;
    }
    //加载公共的数据库封装文件

    include 'shujukuchushihua.php';

    //查询登录的用户名和密码正确性，若正确则跳转到学生管理系统的主界面
    $username = addslashes($username);//转义符号，防止被恶意修改sql语句
    $password = md5($password);//任何地方的md5都是一样的,在php使用MD5加密使之与数据库中已存在的管理员信息比较
    $sql_2 = "select * from pr_admin where username='{$username}' and password='{$password}'";
    $res_2 = my_error($sql_2);
    $user = mysql_fetch_assoc($res_2);
    if(!$user){
        echo "<script>alert('用户名或密码错误，请重新登录！');location.href='login.php';</script>";
    }
    else{
        echo "<script>alert('登录成功！');location.href='main.html';</script>";
    }

}else{
include 'login.html';
}
?>