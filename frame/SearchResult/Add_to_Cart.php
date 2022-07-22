<?php
    $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_select_db($link, "shopping_system");  // 選擇資料庫
    $sql = "SELECT * FROM parts ";
    $sql .= " WHERE pname like '%" . $_POST["p"] . "%'";
    mysqli_query($link, 'SET NAMES utf8');
    $result = @mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);
    $i=0;
    $n=0;
    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $i++;
        //有輸入數量的商品才加入到cart
       if($_POST['QTY'.$i]!=""){
        $sql2 ="INSERT INTO cart(cno,pno,qty) values(";
        $sql2 .= $_POST["id"].",".$rows[0].",".$_POST['QTY'.$i].")";
        mysqli_query($link, $sql2);
       }
       else{
           $n++;
       }
     }
     if($n==$total_records){
        mysqli_close($link);      // 關閉資料庫連接
        echo "<script>alert('Add unsuccessful');parent.location.href='../../main/main.php?id=".$_POST["id"]."';</script>";
     }
     else{
     mysqli_close($link);      // 關閉資料庫連接
     echo "<script>alert('Add successful');parent.location.href='../../main/main.php?id=".$_POST["id"]."';</script>";
     }
?>