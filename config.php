<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51LOXSREsnbQjivlPqRppXtOyTSLZGVGPR02og8wRfjXcSO9xBxvz19U41G7WeDB4Q8HbkifsZvrYa0OuikduwwCH00uK3lDBQc","publishableKey" => "pk_test_51LOXSREsnbQjivlPiI3D9zIUK25D8dxjJWi34M1DTVuXyf8jM4QbjnOepZZrunrmKO7cLSVYPPTUT72OQY5FpJhF00ihVudTSh"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>