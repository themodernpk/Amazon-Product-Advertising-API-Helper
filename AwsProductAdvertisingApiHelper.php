<?php

class AwsProductAdvertisingApiHelper
{

    public $private_key;
    public $AssociateTag;
    public $Service;
    public $AWSAccessKeyId;
    public $Timestamp;
    public $SignatureMethod;
    public $SignatureVersion;
    public $Version;
    public $ItemId;
    public $Operation;
    public $IdType;
    public $params;


    function __construct($private_key, $AssociateTag, $AWSAccessKeyId, $ItemId, $Timestamp=null,
                         $Operation='ItemLookup', $Service='AWSECommerceService', $IdType='ASIN',
                         $SignatureMethod='HmacSHA256', $SignatureVersion=2, $Version='2013-08-01' )
    {

        $this->private_key = $private_key;
        $this->ItemId = $ItemId;
        $this->AssociateTag = $AssociateTag;
        $this->Service = $Service;
        $this->AWSAccessKeyId = $AWSAccessKeyId;

        if($Timestamp == null)
        {
            $this->Timestamp = gmdate("Y-m-d\TH:i:s\Z");
        } else
        {
            $this->Timestamp = $Timestamp;
        }


        $this->SignatureMethod = $SignatureMethod;
        $this->SignatureVersion = $SignatureVersion;
        $this->Version = $Version;
        $this->Operation = $Operation;
        $this->IdType = $IdType;


    }

    //----------------------------------------------------------------

    public function params()
    {

        $inputs = array(
            "AssociateTag" => $this->AssociateTag,
            "Service" => $this->Service,
            "AWSAccessKeyId" => $this->AWSAccessKeyId,
            "Timestamp" => $this->Timestamp,
            "SignatureMethod" => $this->SignatureMethod,
            "SignatureVersion" => $this->SignatureVersion,
            "Version" => $this->Version,
            "Operation" => $this->Operation,
            "IdType" => $this->IdType,
            "ItemId" => $this->ItemId,
        );

        $params = [];
        foreach ($inputs as $param => $value) {
            $params[$param] = $value;
        }

        ksort($params);


        return $params;

    }

    //----------------------------------------------------------------

    public function generate_query_string()
    {


        $params = $this->params();

        $method = "GET";
        $host = "webservices.amazon.com";
        $uri = "/onca/xml";

        $canonicalized_query = array();
        foreach ($params as $param => $value) {
            $param = str_replace("%7E", "~", rawurlencode($param));
            $value = str_replace("%7E", "~", rawurlencode($value));
            $canonicalized_query[] = $param . "=" . $value;
        }
        $canonicalized_query = implode("&", $canonicalized_query);

        // create the string to sign
        $string_to_sign =
            $method . "\n" .
            $host . "\n" .
            $uri . "\n" .
            $canonicalized_query;

        return $string_to_sign;
    }

    //----------------------------------------------------------------

    public function generate_signature()
    {

        $string_to_sign = $this->generate_query_string();

        $signature = base64_encode(
            hash_hmac("sha256", $string_to_sign, $this->private_key, True));

        // encode the signature for the equest
        $signature = str_replace("%7E", "~", rawurlencode($signature));

        return $signature;

    }

    //----------------------------------------------------------------
    public function get_product_review_iframe_url($asin)
    {
        $this->ItemId = $asin;
        $url = 'https://www.amazon.com/reviews/iframe?akid='.$this->AWSAccessKeyId.'&alinkCode=xm2&asin='.$asin.'&atag='.$this->AssociateTag.'&exp='.$this->Timestamp.'&v='.$this->SignatureVersion.'&sig='.$this->generate_signature();

        return $url;

    }
    //----------------------------------------------------------------
    //----------------------------------------------------------------
    //----------------------------------------------------------------


}