<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>html13</title>
    <link rel="stylesheet" href="CheckOrderStatus.css">
</head>

<body>
    <?php
    $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_select_db($link, "shopping_system");  // 選擇資料庫 
    mysqli_query($link, 'SET NAMES utf8');
    $sql = "SELECT * FROM orders ";
    $sql .= " WHERE cno = " . $_GET["id"] . "";
    $result = @mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);
    $sql2 = "SELECT * FROM customers ";
    $sql2 .= " WHERE cno = " . $_GET["id"] . "";
    $result2 = @mysqli_query($link, $sql2);
    $rows2 = mysqli_fetch_array($result2, MYSQLI_NUM);
    ?>
    <div class="title">Order List</div>
    <?php 
         if ($total_records > 0) {
            while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
                echo '<div class="wrap">';
                    echo '<div class="information">';
                        echo '<div class="onoBox">';
                            echo "<p class='ono'>OrderNumber: ".$rows[0]."</p>";
                        echo '</div>';
                        echo '<div class="AddrBox">';
                            echo "<p class='Addr'>Receive Address: ".$rows2 [2],",".$rows2[3].",".$rows2[4]."</p>";
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="container">';
                        echo '<div class="item" style ="background-color:rgb(235, 255, 144);">';
                            echo '<ion-icon name="receipt-outline"></ion-icon>';
                            echo '<div class="text"  >Receive</div>';
                        echo '</div>';
                        echo '<div class="item" style ="background-color:rgb(235, 255, 144);">';
                            echo '<ion-icon name="cube-outline"></ion-icon>';
                            echo '<div class="text">Packing</div>';
                        echo '</div>';
                        if($rows[3]==date("Y-m-d")){
                            echo '<div class="item" style ="background-color:rgb(235, 255, 144);">';
                                echo '<ion-icon name="bus-outline"></ion-icon>';
                                echo '<div class="text">Shipping</div>';
                            echo '</div>';
                        }
                        else{
                        echo '<div class="item">';
                            echo '<ion-icon name="bus-outline"></ion-icon>';
                            echo '<div class="text">Shipping</div>';
                        echo '</div>';
                        }
                        echo '<div class="item">';
                            echo '<ion-icon name="checkmark-circle-outline"></ion-icon>';
                            echo '<div class="text">Delivery</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
         }
    ?>
  

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>