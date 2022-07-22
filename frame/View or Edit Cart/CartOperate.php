<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>html11</title>
    <link rel="stylesheet" href="CartOperate.css">
</head>
<body>
<?php
    if ($_GET['id'] != "") {
        $link = @mysqli_connect("localhost", "root", "")
            or die("無法開啟MySQL資料庫連接!<br/>");
        mysqli_select_db($link, "shopping_system");  // 選擇資料庫
        $sql = "SELECT * FROM cart ";
        $sql .= " WHERE cno =" . $_GET["id"] . "";
        mysqli_query($link, 'SET NAMES utf8');
        $result = @mysqli_query($link, $sql);
        $total_records = mysqli_num_rows($result);
    }
    ?>
    <div class="title">Cart Contents</div>
    <div class="table">
        <form action="Modify_Cart.php" method="post">
        <input id="hiddenText" type="text" name="id" value=<?php echo $_GET['id']; ?> 
        style="display:none" />
            <table>
                <thead>
                <?php
                        //購物車有商品才顯示
                    if ($total_records > 0) {
                        echo "<th scope='col'>PNO</th>";
                        echo "<th scope='col'>PNAME</th>";
                        echo "<th scope='col'>PRICE</th>";
                        echo "<th scope='col'>QTY</th>";
                        echo "<th scope='col'>Cost</th>";
                    } else
                        echo "<h1 style='text-align:center'>購物車目前無商品</h2>";
                    ?>
                </thead>
                <tbody>
                    <?php
                      $i=0;
                      $total=0;
                      //將每筆資料列出
                      while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
                          $i++;
                          //查詢parts
                          $sql2 = "SELECT * FROM parts where pno =".$rows[2];
                          $result2 = @mysqli_query($link, $sql2);
                          $rows2 = mysqli_fetch_array($result2, MYSQLI_NUM);
                          echo "<tr>";
                          echo "<td>" . $rows[2] . "</td>";
                          echo "<td>" . $rows2[1] . "</td>";
                          echo "<td>" . $rows2[3] . "</td>";
                          //只能輸入數字
                          echo "<td>" . "<input oninput=".'"'."value=value.replace(/[^\d]/g,'')"
                          .'"'." type='text' value='".$rows[3]."' name='QTY".$i."'>" . "</td>";
                          $cost = $rows[3]*$rows2[3];
                          $total +=$cost;
                          echo "<td>" . $cost . "</td>";
                          echo "</tr>";
                      }
                    ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <?php
                        if ($total_records > 0) {
                            echo "<td colspan='4'>Total Cost:</td>";
                            echo "<td>".$total."</td>";
                        }
                        ?>
                    </tr>
                </tfoot>
            </table>
            <?php 
            if ($total_records > 0) {
                echo "<input class='btn' type='submit' value='Modify Cart'>";
            }
            mysqli_close($link);      // 關閉資料庫連接s
            ?>
      
        </form>
    </div>
    <div class="Note">If you are done shopping, click <b>CheckOut</div>
</body>
</html>