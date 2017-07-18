# Simple Amazon Product Advertising API Helper
It was really stressful really get started with Amazon Product Advertising API. I figure out all the steps, hence thought to put it here, might help few other people.

I will explain the entire step by step:
### Step 1
-> First you need to register to become an associate, more details are available on the following link:
http://docs.aws.amazon.com/AWSECommerceService/latest/DG/becomingAssociate.html

-> Login to your account, here you'll get the "AssociateTag", check http://i.imgur.com/3OhFGnU.png

### Step 2
Register at https://affiliate-program.amazon.in/gp/advertising/api/detail/main.html

### Step 3
After signup follow all the steps written http://docs.aws.amazon.com/AWSECommerceService/latest/DG/becomingDev.html
By following these steps you will get "Access Key ID" and  "Secret Access Key"

### Step 4
Login https://console.aws.amazon.com/iam/home 

-> Click on "Users" from left menu 

-> Click on the user you have created in last step 

-> Click on add permission 

-> Choose "AmazonProductAdvertisingAPIFullAccess" and Save

## Generate signature
```php
require "AwsProductAdvertisingApiHelper.php";
$private_key = '';  //Secret Access Key
$AssociateTag = ''; //AssociateTag
$AWSAccessKeyId = ''; //Access Key ID
$ItemId = ''; // Product ASIN http://i.imgur.com/aCgutfX.png
$item = new AwsProductAdvertisingApiHelper($private_key, $AssociateTag, $AWSAccessKeyId, $ItemId);

echo $item->generate_signature();
```

## Get Amazon Product Review Iframe Url
```php
require "AwsProductAdvertisingApiHelper.php";
$private_key = '';  //Secret Access Key
$AssociateTag = ''; //AssociateTag
$AWSAccessKeyId = ''; //Access Key ID
$ItemId = ''; // Product ASIN http://i.imgur.com/aCgutfX.png
$item = new AwsProductAdvertisingApiHelper($private_key, $AssociateTag, $AWSAccessKeyId, $ItemId);

echo $item->get_product_review_iframe_url($ItemId);
```