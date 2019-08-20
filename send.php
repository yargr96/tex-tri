<? // #начало Обработчик данных
header("Content-Type: text/html; charset=UTF-8");

if($_POST['name']) { $name = htmlspecialchars ($_POST['name']); }
if($_POST['phone']) { $phone = htmlspecialchars ($_POST['phone']); }
if($_POST['hidden']) { $hidden = htmlspecialchars ($_POST['hidden']); }
if($_POST['mail']) { $mail = htmlspecialchars ($_POST['mail']); }
if($_POST['text']) { $text = htmlspecialchars ($_POST['text']); }

$ip_r = $_SERVER['REMOTE_ADDR'];

$product = "ОДЕЖДА"; // Подпись отправителя

$name1 = substr(htmlspecialchars(trim($name)), 0, 100); 
$phone1 = substr(htmlspecialchars(trim($phone)), 0, 20);

if(empty($name1)) {
echo '<h2><p align=center><font color="red">Внимание! Запрещено отправлять пустые поля.<br> Вернитесь и заполните обязательные поля <b>"Имя"</b> и <b>"Телефон"</b></font><br><br><a href="javascript:history.back()">Вернуться назад</a></p></h2>';
exit; }

if(empty($phone1)) {
echo '<h2><p align=center><font color="red">Внимание! Запрещено отправлять пустые поля.<br> Вернитесь и заполните обязательные поля <b>"Имя"</b> и <b>"Телефон"</b></font><br><br><a href="javascript:history.back()">Вернуться назад</a></p></h2>';
exit; } 

if($_POST['tip']) { 

if($_POST['tip'] == '1') { $model = 'Hover Ball 1 шт'; }
if($_POST['tip'] == '2') { $model = 'Hover Ball 3 шт'; }
if($_POST['tip'] == '3') { $model = 'Hover Ball 6 шт'; }

} else { $model = '<span style="color:grey;">Данных нет</span>'; }

$tema_r = 'ЗАКАЗ: на ИЗГОТОВЛЕНИЕ ОДЕЖДЫ'; 
$to = "texzakaz@tex-tri.ru"; // ЗДЕСЬ МЕНЯЕМ ПОЧТУ НА КОТОРУЮ ПРИХОДЯТ ЗАКАЗЫ!
$from="{$product} <noreply@{$_SERVER['HTTP_HOST']}>"; // Адрес отправителя

$subject="=?utf-8?B?". base64_encode("$tema_r"). "?=";
$header="From: $from"; 
$header.="\nContent-type: text/html; charset=\"utf-8\"";
$message = 'Имя: '.$name.' <br>Телефон: '.$phone.' <br>
E-mail: '.$mail.' <br>
Форма заказа: '.$hidden.' <br>
Описание: '.$text.' <br>
<br>Заказано с лендинга: '.$_SERVER['HTTP_REFERER'].' <br>IP адрес клиента: <a href="http://ipgeobase.ru/?address='.$ip_r.'">'.$ip_r.'</a><br>Время заказа: '.date("Y-m-d H:i:s").'';
?>

<?if(mail($to, $subject, $message, $header)):?>

<!— ========================================================= НАЧИНАЕМ ФОРМИРОВАТЬ HTML СТРАНИЦУ ПОДТВЕРЖДЕНИЯ ======================================================== —> 

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Спасибо за заказ</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&amp;subset=cyrillic" rel="stylesheet">
<style>
a{color:#fff;text-decoration:none}.container{width:100%;height:100%;font-family:'Open Sans',sans-serif}.wrap{width:700px;margin:165px auto 0;text-align:center}.zag{font-size:29px;font-weight:400;margin-bottom:0;margin-top:23px;color:#38382F}.podzag{font-size:20px;color:#7F7F7F;font-weight:300;margin-top:12}.button{background:#38382F;padding:12px 25px;margin:0 auto}.bor{margin-top:45px}.img{width:100px;height:100px;background:url(img/900e8526e8b44b8993f6e4ca19ce7891.png) center center no-repeat;margin:0 auto}
</style>
</head>
<body>
<div class="container">
<div class="wrap">
<div class="img"></div>
<p class="zag">Спасибо. Ваша заявка успешно отправлена.</p>
<p class="podzag">Наш менеджер свяжется с Вами в ближайшее время.</p>
<div class="bor">
<a href="index.html" class="button">Вернуться на сайт</a>
</div> 
</div>
</div>

</body>
</html>

<!— ======================================================== ОКОНЧАНИЕ СТРАНИЦЫ ПОДТВЕРЖДЕНИЯ ======================================================== —> 

<?endif;?>