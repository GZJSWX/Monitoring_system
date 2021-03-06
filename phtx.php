<html>
<head>
   <meta charset="UTF-8" />
   <title>水质PH查询</title>
   <script src="JS/jquery.min.js"></script>
   <script src="JS/highcharts.js"></script>
</head>
<body>
  <div align = "center">
         <font size = "5" color = "#008000"><b>水质PH查询</b></font>
      </div>
      <form name = "frm1" method = "post" action = "phtx.php" style = "margin:0">
         <table width = "360" align = "center">
         <tr>
            <td width = "200"><span class = "STYLE1">根据日期查询PH信息:</span></td>
            <td>
               <input name = "rq" id = "rq" type = "text" size = "10">
               <input type = "submit" name = "test" class = "STYLE1" value = "查找"> 
            </td>
         </tr>
         </table>
      </form>
   <?php 
     require "fun.php";
      $sj = $_POST['rq'];
      $a=array();
      $a2 = array();
      $sql1 = mysqli_query($conn,"select ph from szsj where rq like '$sj %'");
      $sql2 = mysqli_query($conn,"select rq from szsj where rq like '$sj %'");
      while ($row = mysqli_fetch_array($sql2)) {
         $a[] = $row[0];
       } 
      while($row = mysqli_fetch_array($sql1)){
         $a2[] = floatval($row[0]);
      }
   ?>
<div id="container" style="width: 1100px; px; height: 400px; margin: 0 auto"></div>
<script language="JavaScript">
$(document).ready(function() {
   var title = {
      text: '水体PH值'   
   };
   var subtitle = {
      text: ''
   };
   var xAxis = {
      categories: <?php echo json_encode($a); ?>
   };
   var yAxis = {
      title: {
         text: 'PH值'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
      valueSuffix: ''
   }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [
      {
         name: 'PH',
         data: <?php echo json_encode($a2); ?>
      }
   ];
   var json = {};
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   $('#container').highcharts(json);
});
</script>
</body>
</html>