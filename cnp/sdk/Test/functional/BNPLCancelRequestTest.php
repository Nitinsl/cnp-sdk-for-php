<?php

namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;

class BNPLCancelRequestTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_BNPL_Cancel_Request()
    {
        $hash_in = array(
            'id' => '1291',
            'orderId' => '3191',
            'reportGroup' => 'Planets',
            'amount' => '3000',
            'cnpTxnId' => '011210745239578422',
        );
        $initialize = new CnpOnlineRequest();
        $BNPLCancelResponse = $initialize->BNPLCancelRequest($hash_in);
        $response = XmlParser::getNode($BNPLCancelResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($BNPLCancelResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }

}