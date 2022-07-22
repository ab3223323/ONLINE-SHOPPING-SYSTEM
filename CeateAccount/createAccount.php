<?php
if (isset($_POST["create"])) {
    if (
        //必須輸入所有個人資訊
        $_POST['name'] != "" && $_POST['street'] != "" && $_POST['city'] != ""
        && $_POST['zip'] != "" && $_POST['state'] != "" && $_POST['phone'] != ""
        && $_POST['email'] != "" && $_POST['password'] != ""
    ) {
        // 開啟MySQL的資料庫連接
        $link = @mysqli_connect("localhost", "root", "")
            or die("無法開啟MySQL資料庫連接!<br/>");
        mysqli_select_db($link, "shopping_system");  // 選擇資料庫
        $sql = "INSERT INTO customers(cname,street,city,state,zip,phone,email,PASSWORD)  ";
        $sql .= "values('" .$_POST['name'] . "','".$_POST['street']."','";
        $sql .= $_POST['city'] . "','".$_POST['state']."',";
        $sql .= $_POST['zip'] . ",'".$_POST['phone']."','";
        $sql .= $_POST['email'] . "','".$_POST['password']."')";
        mysqli_query($link, 'SET NAMES utf8');
        if (mysqli_query($link, $sql)) {// 執行SQL指令
            //抓取最後一筆資料
            $sql ="select * from customers ORDER BY cno DESC LIMIT 0 , 1";
            $result = @mysqli_query($link, $sql);
            $rows = mysqli_fetch_array($result,MYSQLI_NUM);
            echo "<script> alert('創建成功，您的ID: ".$rows[0]."');parent.location.href='../Login(Index)/Index.html'; </script>";
        }else{
        echo "<script> alert('創建失敗');parent.location.href='createAccount.html'; </script>";
        /*if (mysqli_errno($link) != 0) {
            echo "<script> alert('".mysqli_errno($link). "');parent.location.href='createAccount.html'; </script>";
        } 查詢錯誤代號 */   
    }
        mysqli_close($link);      // 關閉資料庫連接
    } else {
        echo "<script> alert('請填入所有資訊');parent.location.href='createAccount.html'; </script>";
    }
}
?>