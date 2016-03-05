<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Your Order</title>
<link rel="stylesheet" href="includes/order_form.css" type="text/css" />
</head>
<body>

<?php
require('includes/ex1.inc.php');

echo getOrderInfo();
?>
    
    
<p>The PayPal button code would need to be configured for your use. See code comments in ex1.inc.php and PayPal's documentation.</p>

<p>Back to <a href=".">index</a></p>
</body>
</html>