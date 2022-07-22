<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="Logout.css">
</head>
<body>
    <div class="title">LogOut Page</div>
    <div class="Note">
        <p>Your Shopping Cart has item in it!</p>
    </div>

    <form action="Logout_control.php" method="post">
    <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
        <p>Please choose one of the following options before logging out.</p>
        <div class="radio">
            <input class = "subradio" type="radio" id="" name="Option" value="CheckOut">
            <label for="Checkout">CheckOut</label><br>
            <input class = "subradio" type="radio" id="" name="Option2" value="SaveCartandLogout">
            <label for="SaveCartandLogout">Save Cart and Logout</label><br>
            <input class = "subradio" type="radio" id="" name="Option3" value="EmptyCartandLogOut">
            <label for="EmptyCartandLogOut">Empty Cart and LogOut</label>
        </div>
        <input class="btn" type="submit" value="submit">
    </form>
</body>
</html>