<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckOut</title>
    <link rel="stylesheet" href="CheckOut.css">
</head>

<body>
    <?php
    $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_select_db($link, "shopping_system");  // 選擇資料庫 
    mysqli_query($link, 'SET NAMES utf8');
    //查詢此次購物的pno
    $sql = "SELECT distinct pno FROM cart ";
    $sql .= " WHERE cno = " . $_GET["id"] . "";
    $result = @mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);
    //購物車沒商品 不建立訂單
    if ($total_records > 0) {
        //抓取今日日期
        $getDate = date("Y-m-d");
        //兩天後運送
        $shipdate = date("Y-m-d", strtotime("+2 days"));
        $sql2 = "INSERT INTO orders(cno,received,shipped) values( ";
        $sql2 .= $_GET['id'] . ",'" . $getDate . "','" . $shipdate . "')";
        //將訂單儲存
        mysqli_query($link, $sql2);
        //儲存訂單資訊
        while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $sql = "SELECT SUM(qty) FROM cart WHERE pno = " . $rows[0];
            $result2 = @mysqli_query($link, $sql);
            $rows2 = mysqli_fetch_array($result2, MYSQLI_NUM);
            $sql = "select * from orders ";
            $sql .= " WHERE cno = " . $_GET["id"] . " ORDER BY ono DESC LIMIT 0 , 1";
            $result2 = @mysqli_query($link, $sql);
            $rows3 = mysqli_fetch_array($result2, MYSQLI_NUM);
            $sql = "INSERT INTO odetails(ono,pno,qty) values( " . $rows3[0] . "," . $rows[0] . "," . $rows2[0] . ")";
            mysqli_query($link, $sql);
            //echo mysqli_error($link);
        }
        //清空購物車
        $sql = "Delete from cart where cno = " . $_GET['id'];
        mysqli_query($link, $sql);
        //echo mysqli_error($link);
    }

    ?>
    <div class="title">Invoice for Raj Sunderraman</div>

    <div class="information">
        <div class="AddrBox">
            <p class="addr">Shipping Address:</p>
            <?php
            //顯示customers住址
            $sql = "SELECT * FROM customers WHERE cno = " . $_GET['id'];
            $result = @mysqli_query($link, $sql);
            $rows = mysqli_fetch_array($result, MYSQLI_NUM);
            echo "<p>" . $rows[2] . "," . $rows[3] . "," . $rows[4] . "&nbsp" . $rows[5] . "</p>";
            ?>
        </div>
    </div>
    <div class="table">
        <caption class="OrderNumber">
            <?php
            if ($total_records > 0) {
                $sql = "select * from orders ";
                $sql .= " WHERE cno = " . $_GET["id"] . " ORDER BY ono DESC LIMIT 0 , 1";
                $result2 = @mysqli_query($link, $sql);
                $rows3 = mysqli_fetch_array($result2, MYSQLI_NUM);
                echo "OrderNumber: " . $rows3[0];
            }
            ?>
        </caption>
        <table>
            <thead>
                <?php
                if ($total_records > 0) {
                    echo "<tr>";
                    echo "<th scope='col'>PNO</th>";
                    echo "<th scope='col'>PNAME</th>";
                    echo "<th scope='col'>PRICE</th>";
                    echo "<th scope='col'>QTY</th>";
                    echo "<th scope='col'>Cost</th>";
                    echo "</tr>";
                } else {
                    echo "<h1 style='text-align:center'>購物車目前無商品</h2>";
                }
                ?>

            </thead>
            <tbody>
                <?php
                if ($total_records > 0) {
                    $sql = "select * from orders ";
                    $sql .= " WHERE cno = " . $_GET["id"] . " ORDER BY ono DESC LIMIT 0 , 1";
                    $result2 = @mysqli_query($link, $sql);
                    $rows3 = mysqli_fetch_array($result2, MYSQLI_NUM);
                    $sql = "select * from odetails where ono =  " . $rows3[0];
                    $result2 = @mysqli_query($link, $sql);
                    $tatal = 0;
                    while ($rows = mysqli_fetch_array($result2, MYSQLI_NUM)) {
                        echo "<tr>";
                        $sql = "select * from parts ";
                        $sql .= " WHERE pno = " . $rows[1];
                        $result = @mysqli_query($link, $sql);
                        $rows3 = mysqli_fetch_array($result, MYSQLI_NUM);
                        echo "<td>" . $rows3[0] . "</td>";
                        echo "<td>" . $rows3[1] . "</td>";
                        echo "<td>" . $rows3[3] . "</td>";
                        echo "<td>" . $rows[2] . "</td>";
                        $cost = $rows[2] * $rows3[3];
                        $tatal += $cost;
                        echo "<td>" . $cost . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <?php
                if ($total_records > 0) {
                    echo "<tr>";
                    echo "<td colspan='4'>Total Cost:</td>";
                    echo "<td>" . $tatal . "</td>";
                    echo "</tr>";
                }
                ?>
            </tfoot>
        </table>
        <?php 
        mysqli_close($link);      // 關閉資料庫連接
        ?>
    </div>
    <div class="Note">Please print a copy of the invoice for your records</div>
</body>

</html>