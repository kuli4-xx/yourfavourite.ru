<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Example 1</title>
<?php
require('includes/html_form.class.php');
require('includes/html_table.class.php');
require('includes/ex1.inc.php');
?>
<link rel="stylesheet" href="includes/order_form.css" type="text/css" />
<script src="includes/order_form.js" type="text/javascript"></script>
<script type="text/javascript">
var PRODUCT_ABBRS = <?php echo json_encode( getProductAbbrs() ) ?>;
</script>
</head>
<body>

<h1>Order Form - Example 1</h1>

<?php
echo getOrderForm();
?>

</body>
</html>