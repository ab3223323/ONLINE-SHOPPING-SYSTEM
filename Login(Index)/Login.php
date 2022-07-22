<?php
// 是否是表單送回
if (isset($_POST['login'])) {
    if($_POST['account']!=""&&$_POST['passward']!=""){
    // 開啟MySQL的資料庫連接
    $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_select_db($link, "shopping_system");  // 選擇資料庫
    $sql = "SELECT * FROM customers ";
        $sql .= " WHERE cno = " . $_POST["account"] . "";
        //送出UTF8編碼的MySQL指令
        mysqli_query($link, 'SET NAMES utf8');
        $result = @mysqli_query($link, $sql);
        $total_records = mysqli_num_rows($result);
        //確認有此帳號
        if ($total_records > 0) {
            $rows = mysqli_fetch_array($result, MYSQLI_NUM);
            //確認密碼
            if($_POST['passward']==$rows[8]){
            $id=$_POST["account"];
            //成功跳轉到main page
            header("Location:../main/main.php?id=".$id);    
            }
            //錯誤跳出提示訊息並重新載入頁面
            else{
                echo "<script> alert('帳號或密碼錯誤');parent.location.href='Index.html'; </script>";
            }                
        }
        else{
            echo "<script> alert('帳號或密碼錯誤');parent.location.href='Index.html'; </script>";
            
        }
        mysqli_close($link);      // 關閉資料庫連接
    }
    else{
        echo "<script> alert('未輸入帳號或密碼');parent.location.href='Index.html'; </script>";
    }
}
?>