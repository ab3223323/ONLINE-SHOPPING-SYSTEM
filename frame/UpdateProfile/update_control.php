<?php
if (isset($_POST["update"])) {
    if (
        //全部都有值才更新
        $_POST['name'] != "" && $_POST['street'] != "" && $_POST['city'] != ""
        && $_POST['zip'] != "" && $_POST['state'] != "" && $_POST['phone'] != ""
        && $_POST['email'] != "" && $_POST['password'] != ""
    ) {
        // 開啟MySQL的資料庫連接
        $link = @mysqli_connect("localhost", "root", "")
            or die("無法開啟MySQL資料庫連接!<br/>");
        mysqli_select_db($link, "shopping_system");  // 選擇資料庫
        $sql = "UPDATE customers  ";
        $sql .= "SET cname ='" .$_POST['name'] . "',street = '".$_POST['street']."',city ='";
        $sql .= $_POST['city'] . "',state ='".$_POST['state']."',zip = ";
        $sql .= $_POST['zip'] . ",phone ='".$_POST['phone']."',email ='";
        $sql .= $_POST['email'] . "',PASSWORD = '".$_POST['password']."'";
        $sql .= "where cno =".$_POST['id']  ;
        mysqli_query($link, 'SET NAMES utf8');
        if (mysqli_query($link, $sql)) {// 執行SQL指令
            
            echo "<script> alert('更新成功');parent.location.href='../../main/main.php?id=".$_POST['id'] ."'; </script>";
        }else{
        echo "<script> alert('更新失敗');parent.location.href='../../main/main.php?id=".$_POST['id'] ."'; </script>";
        /*if (mysqli_errno($link) != 0) {
            echo "<script> alert('".mysqli_errno($link). "');parent.location.href='createAccount.html'; </script>";
        } 查詢錯誤代號 */   
    }
        mysqli_close($link);      // 關閉資料庫連接
    } else {
        echo "<script> alert('請填入所有資訊');parent.location.href=' ../../main/main.php?id=".$_POST['id'] ."'; </script>";
    }
}
?>