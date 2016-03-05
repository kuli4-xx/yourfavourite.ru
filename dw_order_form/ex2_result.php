<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Your Order</title>
<link rel="stylesheet" href="includes/order_form.css" type="text/css" />
</head>
<body>
<?php
require('includes/ex2.inc.php');

echo handleOrderInfo();
?>
    
    
<p>&nbsp;</p>
<p>A <code>sendAdminEmail</code> function is included in ex2.inc.php. You will need to place your email address there (<code>$admin_email</code>) and uncomment the <code>mail</code> function to send the emails.</p>

<p>Back to <a href=".">index</a></p>

</body>
</html>