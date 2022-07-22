<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>createAccount</title>
    <link rel="stylesheet" href="UpdateProfile.css">
</head>

<body>
    <?php
    $link = @mysqli_connect("localhost", "root", "")
        or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_select_db($link, "shopping_system");  // 選擇資料庫
    $sql = "SELECT * FROM customers ";
    $sql .= " WHERE cno = " . $_GET["id"] . "";
    mysqli_query($link, 'SET NAMES utf8');
    $result = @mysqli_query($link, $sql);
    $rows = mysqli_fetch_array($result, MYSQLI_NUM);
    ?>
    <div class="title">Update Profile</div>
    <main class="createAccount">
        <form class="container" action="update_control.php" method="post">
            <?php echo $_GET['id']; ?>
            <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
            <div class="Name">
                <h3>Name</h3>
                <input type="text" name="name" value=<?php echo $rows[1]; ?> placeholder="please enter your Name">
            </div>
            <div class="Street">
                <h3>Street</h3>
                <input type="text" name="street" value=<?php echo $rows[2]; ?> placeholder="please enter your Street">
            </div>
            <div class="City">
                <h3>City</h3>
                <input type="text" name="city" value=<?php echo $rows[3]; ?> placeholder="please enter your City">
            </div>
            <div class="State">
                <h3>State</h3>
                <input type="text" name="state" value=<?php echo $rows[4]; ?> placeholder="please enter your State">
            </div>
            <div class="Zip">
                <h3>Zip</h3>
                <input type="text" name="zip"value=<?php echo $rows[5]; ?> placeholder="please enter your Zip">
            </div>
            <div class="Phone">
                <h3>Phone</h3>
                <input type="text" name="phone" value=<?php echo $rows[6]; ?> placeholder="please enter your Phone">
            </div>
            <div class="email">
                <h3>E-mail</h3>
                <input type="email" name="email"value=<?php echo $rows[7]; ?> placeholder="please enter your email">
            </div>
            <div class="password">
                <h3>password</h3>
                <input type="password" name="password" value=<?php echo $rows[8]; ?> placeholder="please enter your password">
            </div>
            <input type="submit" name="update" value="Update Profile" class="btn">
        </form>
    </main>
    <?php
    mysqli_close($link);      // 關閉資料庫連接 
    ?>
</body>

</html>