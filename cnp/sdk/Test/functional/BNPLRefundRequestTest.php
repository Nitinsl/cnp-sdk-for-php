<?php

namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;

class BNPLRefundRequestTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_BNPL_Refund_Request()
    {
        $hash_in = array('id' => 'id',
            'id' => '1291',
            'orderId' => '2191',
            'reportGroup' => 'Planets',
            'amount' => '2000',
            'cnpTxnId' => '011210745239575422',
        );
        $initialize = new CnpOnlineRequest();
        $BNPLRefundResponse = $initialize->BNPLRefundRequest($hash_in);
        $response = XmlParser::getNode($BNPLRefundResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($BNPLRefundResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }

}