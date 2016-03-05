<?php
/* 
    Example php order form created using form and table classes from dyn-web.com
    For demos, documentation and updates, visit http://www.dyn-web.com/code/order_form/
    
    Released under the MIT license
    http://www.dyn-web.com/business/license.txt
*/

$PRODUCTS = array(
    // product abbreviation, product name, unit price
    // follow valid name/ID rules for product abbreviation 
    array('choc_cake', 'Chocolate Cake', 15),
    array('carrot_cake', 'Carrot Cake', 12),
    array('cheese_cake', 'Cheese Cake', 20),
    array('banana_bread', 'Banana Bread', 14)
);

// functions for example 1 order form

function getOrderForm() {
    global $PRODUCTS;
    $tbl = new HTML_Table('', 'demoTbl');
    $frm = new HTML_Form();
    
    // header row
    $tbl->addRow();
        $tbl->addCell('Product', 'first', 'header');
        $tbl->addCell('Price', '', 'header');
        $tbl->addCell('Quantity', '', 'header');
        $tbl->addCell('Totals', '', 'header');
    
    // display product info/form elements
    foreach($PRODUCTS as $product) {
        list($abbr, $name, $price) = $product;
        
        // quantity text input
        $qty_el = $frm->addInput('text', $abbr . '_qty', 0, 
            array('size'=>4, 'class'=>'cur', 'pattern'=>'[0-9]+', 'placeholder'=>0, 
                  'onchange'=>'getProductTotal(this)',
                  'onclick'=>'checkValue(this)', 'onblur'=>'reCheckValue(this)') );
        
        // total text input
        $tot_el = $frm->addInput('text', $abbr . '_tot', 0, array('readonly'=>true, 'size'=>8, 'class'=>'cur') );
        
        // price hidden input
        $price_el = $frm->addInput('hidden', $abbr . '_price', $price);
        
        $tbl->addRow();
            $tbl->addCell($name);
            $tbl->addCell('$' . number_format($price, 2) . $price_el, 'cur' );
            $tbl->addCell( $qty_el, 'qty');
            $tbl->addCell( $tot_el );
    }
    
    // total row
    $tbl->addRow();
        $tbl->addCell( 'Total: ', 'total', 'data', array('colspan'=>3) );
        $tbl->addCell( $frm->addInput('text', 'total', 0, array('readonly'=>true, 'size'=>8, 'class'=>'cur') ) );
    
    // submit button
    $tbl->addRow();
        $tbl->addCell( $frm->addInput('submit', 'submit', 'Submit'),
                'submit', 'data', array('colspan'=>4) );
        
    $frmStr = $frm->startForm('ex1_result.php', 'post', '', array('onsubmit'=>'return checkSubmit(this);') ) .
        $tbl->display() . $frm->endForm();
    
    return $frmStr;
}


// for js
function getProductAbbrs() {
    global $PRODUCTS;
    foreach ( $PRODUCTS as $product ) {
        $ar[] = $product[0];
    }
    return $ar;
}


// functions for example 1 order form submission result page

function getPayPalBtn($total) {
    $paypal_email = 'your_paypal_email@your.com';
    $desc = 'Your order description'; // could be based on order, or static
    $return_url = 'http://www.your_url.com/orders/thankyou.html'; // thank you page
    $cancel_url = 'http://www.your_url.com'; // if user cancels rather than paying
    // could build string of order details (product abbr, qty)
    $custom = ''; // up to 256 chars
    
    $str = <<<EOS
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="business" value="$paypal_email" />
    <input type="hidden" name="amount" value="$total" />
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="item_name" value="$desc" />
    <input type="hidden" name="custom" value="$custom" />
    <input type="hidden" name="return" value="$return_url" />
    <input type="hidden" name="cancel_return" value="$cancel_url" />
    <input type="image" name="submit "border="0" 
        src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
        alt="PayPal - The safer, easier way to pay online" /> 
</form>
EOS;
    return $str;
}

function getOrderInfo() {
    global $PRODUCTS;;
    $str = ''; $total = 0;
    
    while ( list($key, $val) = each($_POST) ) {
        // Check for valid quantity entries
        if ( ( strpos($key, '_qty') !== false ) && is_int((int)$val) && $val > 0  ) { 
            $pt = strrpos($key, '_qty'); 
            $name_pt = substr( $key, 0, $pt); // product abbr
            
            foreach($PRODUCTS as $product) {
                list($prod_abbr, $prod_name, $prod_price) = $product;
                if ($prod_abbr == $name_pt) {
                    $sub_tot = $val * $prod_price;
                    // build string to display order info
                    $str .= "<p>$val $prod_name at $" . number_format($prod_price, 2) . 
                        ' each for $' . number_format($sub_tot, 2) . '</p>';
                    $total += $sub_tot;
                }
            }
        }
    }
    if ( $str === '' ) {
        $str = '<p>You didn\'t order anything.</p>';
    } else {
        $str = '<h2>Your Order:</h2>' . $str . '<p>Total: $' .  number_format($total, 2) . '</p>' . getPayPalBtn($total);
    }
    
    return $str;
}
?>