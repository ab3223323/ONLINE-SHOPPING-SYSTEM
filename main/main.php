<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>html7</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="titleBox">
                <h1 class = "title">Web Shopping Application System</h1>
                <h2 class="subtitle">Welocome Raj Sunderraman</h2>
            </div>
        </div>
    </header>

    <!-- SideBar -->
    <div class="navigation">
        <div class="title" id = "mainTitle">Customer Menu</div>
        <ul>
            <li class="list active">
                <b></b>
                <b></b>
                <a href="#" onclick="goTo(' ../frame/CheckOutInvoice/CheckOut.php?id='+<?php echo $_GET['id']; ?>);">
                    <span class="icon"><ion-icon name="cash-outline"></ion-icon></span>
                    <span class="title">CheckOut</span>
                </a>
            </li>
            <li class="list">
                <b></b>
                <b></b>
                <a href="#" onclick="goTo('../frame/OrderList/CheckOrderStatus.php?id='+<?php echo $_GET['id']; ?>);">
                    <span class="icon"><ion-icon name="clipboard-outline"></ion-icon></span>
                    <span class="title">Check Order Status</span>
                </a>
            </li>
            <li class="list">
                <b></b>
                <b></b>
                <a href="#" onclick="goTo('../frame/UpdateProfile/UpdateProfile.php?id='+<?php echo $_GET['id']; ?>);">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="title">Update Profile</span>
                </a>
            </li>
            <li class="list">
                <b></b>
                <b></b>
                <a href="#" onclick="goTo('../frame/View or Edit Cart/CartOperate.php?id='+<?php echo $_GET['id']; ?>);">
                    <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>
                    <span class="title">View/Edit Cart</span>
                </a>
            </li>
            <li class="list">
                <b></b>
                <b></b>
                <a href="#" onclick="goTo('../frame/LogOut/Logout.php?id='+<?php echo $_GET['id']; ?>);">
                    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
        <form class = "search" action="" method="post">
            <div class="searchBox">
                <span class="title" id = "SecondTitle">Search Keyword</span>
                <div class="searchList">
                    <input type="text" onkeypress="a(event);" name="search" id="search" autocomplete="off" >
                    <input id="hiddenText" type="text" style="display:none" />
                </div>
            </div>
        </form>
    </div>

    <!-- icon網址 -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <script>
        //藉由改變class項目，達成點選後背景反白
        let list = document.querySelectorAll('.list');
        for(let i=0;i<list.length;i++){
            list[i].onclick = function(){
                // 啟動這個之後會先用while迴圈將所有list先reset
                let j = 0;
                while(j < list.length){
                    list[j++].className = 'list';
                }
                // 再將按下的list改成list actice
                list[i].className = 'list active';
            }
        }

        function goTo(src){
            document.getElementById('frame').src = src;
        }
        //search 按 enter 才跳轉
        function a(event){
            if(event.charCode==13){
                let product = document.getElementById('search').value;
                //alert(product);
            document.getElementById('frame').src = '../frame/SearchResult/SearchResult.php?p='+product+"&id="+<?php echo $_GET['id']; ?>;
            }
        }
    </script>
    <!-- SideBar -->
    <!-- Main -->
    <div class="mainFrame">
        <iframe id="frame" src="../frame/HomePage/homePage.html" width="80%" height="96%" name="Login"></iframe>
    </div>
</body>
</html>