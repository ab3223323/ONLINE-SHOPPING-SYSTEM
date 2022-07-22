<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>html11</title>
    <link rel="stylesheet" href="SearchResult.css">
</head>

<body>
    <?php
    if ($_GET['p'] != "") {
        $link = @mysqli_connect("localhost", "root", "")
            or die("無法開啟MySQL資料庫連接!<br/>");
        mysqli_select_db($link, "shopping_system");  // 選擇資料庫
        //從parts搜尋關鍵字
        $sql = "SELECT * FROM parts ";
        $sql .= " WHERE pname like '%" . $_GET["p"] . "%'";
        mysqli_query($link, 'SET NAMES utf8');
        $result = @mysqli_query($link, $sql);
        $total_records = mysqli_num_rows($result);
    }
    ?>
    <div class="title">Search Results</div>
    <div class="table">
        <form action="Add_to_Cart.php" method="post">
            <input id="hiddenText" type="text" name="id" value=<?php echo $_GET['id']; ?> style="display:none" />
            <input id="hiddenText" type="text" name="p" value=<?php echo $_GET['p']; ?> style="display:none" />
            <table>
                <thead>
                    <?php
                    //如果有查詢到建立表格
                    if ($total_records > 0) {
                        echo "<th scope='col'>PNO</th>";
                        echo "<th scope='col'>PNAME</th>";
                        echo "<th scope='col'>PRICE</th>";
                        echo "<th scope='col'>QTY</th>";
                    } else
                        echo "<h1 style='text-align:center'>查無此商品</h2>";
                    ?>

                </thead>
                <tbody>
                    <?php
                    $i=0;
                    //根據搜尋到的筆數建立表格
                    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        $i++;
                        echo "<tr>";
                        echo "<td>" . $rows[0] . "</td>";
                        echo "<td>" . $rows[1] . "</td>";
                        echo "<td>" . $rows[3] . "</td>";
                        //只能輸入數字
                        echo "<td>" . "<input oninput=".'"'."value=value.replace(/[^\d]/g,'')"
                        .'"'."type='text' name='QTY".$i."'>" . "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
            <?php
            if ($total_records > 0) {
                echo "<input class='btn' type='submit' value='Add to Cart'>";
            }
            mysqli_close($link);      // 關閉資料庫連接
            ?>

        </form>
    </div>
</body>

</html>