<?
session_start();
include('data_base.php');

?>
<script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" ></script>
<!DOCTYPE html>
<html>
<head>
<script>
var priceList = {
    "001" : {"id" : "001", "subid" : {}, "name" : "IPhone 5", "price" : "20500"},
    "002" : {"id" : "002", "subid" : {}, "name" : "IPad MINI", "price" : "10500"},
    "003" : {"id" : "002", "subid" : {}, "name" : "IPod 6", "price" : "6500"}
    };
</script>  

<script>
var cart;
var config;
var wiNumInputPrefID;

$(document).ready(function(){  
 
    cart = new WICard("cart");
    cart.init("basketwidjet", config);
    
    
});    
document.addEventListener('visibilitychange', function(e) {
cart.init("basketwidjet", config);
}, false);
</script>
<title>
Корзина
</title>
</head>
<body>
<h1>Корзина</h1>
<?php 
        /*$result = $mysql->query("SELECT 'korzina', 'tovar'
        FROM `korzina`,`tovar`
        WHERE korzina.tovar_id=tovar.id" );*/

        $res_korzina = $mysql->query("SELECT `tovar_id` FROM `korzina` WHERE `user_id` = '" . $_SESSION['id'] . "'");


		while ($korzina = mysqli_fetch_assoc($res_korzina)):
            
            $tovar = $mysql->query("SELECT * FROM `tovar` WHERE `id` = '" . $korzina['tovar_id'] . "'");

            $tovar = $tovar->fetch_assoc();
     ?>
       

        <p><?=$korzina['tovar_id']; ?></p>
        <img src="<?=$tovar['image']; ?>" height="250px" class="imga"/> 

		<h3>	<?=$tovar['name']; ?></h3>
		
            <p><?=$tovar['price'] . ' COM'; ?></p>    
        <?php endwhile; ?> 
<div>
<span>Корзина: </span>
<a href="#" onclick="cart.clearBasket()" style="float: right;">Очистить</a>
<a href="#" id="basketwidjet" onclick="cart.showWinow('bcontainer', 1)"></a> <span style="font: normal 11px Arial"></span>
</div>
3) Форма заказа
<div id="order" class="popup">
<a href="#" onclick="cart.closeWindow('order', 0)" style="float:right"><img src="img/close.png" /></a>
<h4>Введите ваши контактные данные</h4></p>
<p><form id="formToSend">
<input id="fio" type="text" placeholder="Ваши фамилия и имя"  class="" />
<input id="city" type="text" placeholder="Город"  class=""/>
<input id="phone" type="text" placeholder="Контактный телефон номер 2" class=""/>
<input id="email" type="text" placeholder="Электронная почта" class="" />
</form>
<button onclick="cart.sendOrder('formToSend,overflw,bsum');" href="#">Отправить заказ</button>
</div>
</body>
</html>
