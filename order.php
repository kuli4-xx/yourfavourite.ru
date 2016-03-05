echo
<!DOCTYPE html>
<html lang="ru">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Поздравляем! Ваш заказ принят!</title>
    <link type="text/css" rel="stylesheet" href="success_files/style000.css"/>
</head> 
<body>
<?php
    function sendAdminEmail() {
        $admin_email = 'kuli4-xx@mail.ru';
        $subject = 'Yourfavourite.ru Order Information';
        
        $visitor_name = stripslashes( strip_tags( $_POST['name'] ) );
        $visitor_phone = stripslashes( strip_tags( $_POST['phone'] ) );        
        $order_info = stripslashes( strip_tags( $_POST['info'] ) );

        $msg_body = "Order placed for: 
        $order_info
        
        Name: $visitor_name
        Phone: $visitor_phone";
        
        echo nl2br($msg_body); // for testing
        
        //mail($admin_email, $subject, $msg_body );
    }

    sendAdminEmail();
?>
<meta charset="UTF-8" />
<script language = 'javascript'>
alert("Ваша заявка успешно отправлена!");
  var delay =2000;
  setTimeout("document.location.href='index.html'", delay);
</script>
<div class="wrap_block_success">
    <div class="block_success">
        <h2>Поздравляем! Ваш заказ принят!</h2>
        <!-- <p class="order_number">Код заказа:  <span></span></p> -->
        <p class="success">В ближайшее время с вами свяжется оператор для подтверждения заказа. Пожалуйста, включите ваш
            контактный телефон.</p>
    </div>
</div>
</body>
</html>