<?php

require "AwsProductAdvertisingApiHelper.php";

$private_key = '';
$AssociateTag = '';
$AWSAccessKeyId = '';
$ItemId = '';

$item = new AwsProductAdvertisingApiHelper($private_key, $AssociateTag, $AWSAccessKeyId, $ItemId);

echo $item->generate_signature();

echo "<br clear='all'/>";

echo $item->get_product_review_iframe_url('B01NAWBY12');





