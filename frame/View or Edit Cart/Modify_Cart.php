<?php
    $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_select_db($link, "shopping_system");  // 選擇資料庫
    $sql = "SELECT * FROM cart ";
    $sql .= " WHERE cno = " . $_POST["id"] . "";
    mysqli_query($link, 'SET NAMES utf8');
    $result = @mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);
    $i=0;
    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $i++;
        //QTY有值才運作
       if($_POST['QTY'.$i]!=""){
           //QTY=0 商品從購物車移除
           if($_POST['QTY'.$i]==0){
            $sql2 ="DELETE FROM cart ";
            $sql2 .= "where cartno =".$rows[0];
            mysqli_query($link, $sql2);
           }
           else{
            $sql2 ="UPDATE cart SET qty=";
            $sql2 .= $_POST['QTY'.$i]." where cartno =".$rows[0];
            mysqli_query($link, $sql2);
           }
       }
     }
     mysqli_close($link);      // 關閉資料庫連接
     echo "<script>alert('Update successful');parent.location.href='../../main/main.php?id=".$_POST["id"]."';</script>";
?>