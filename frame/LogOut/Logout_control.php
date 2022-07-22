<?php 
if(isset($_POST['Option'])){
    header("Location:../CheckOutInvoice/CheckOut.php?id=".$_POST['id']);   
}

if(isset($_POST['Option2'])){
    //header("Location:../../Login(Index)/Index.html");   
    echo "<script> alert('登出成功');parent.location.href='../../Login(Index)/Index.html'; </script>";
}

if(isset($_POST['Option3'])){
    $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_select_db($link, "shopping_system");  // 選擇資料庫
    $sql = "DELETE FROM cart where cno=".$_POST['id'];
    mysqli_query($link, $sql);
    mysqli_close($link);      // 關閉資料庫連接
    echo "<script> alert('登出成功');parent.location.href='../../Login(Index)/Index.html'; </script>";
}
?>