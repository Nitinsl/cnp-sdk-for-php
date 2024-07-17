<?php

namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;

class BNPLInquiryRequestTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_BNPL_Inquiry_Request()
    {
        $hash_in = array('id' => 'id',
            'id' => '1491',
            'orderId' => '4191',
            'cnpTxnId' => '011210745239578000',
        );
        $initialize = new CnpOnlineRequest();
        $BNPLInquiryResponse = $initialize->BNPLInquiryRequest($hash_in);
        $response = XmlParser::getNode($BNPLInquiryResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($BNPLInquiryResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }

}