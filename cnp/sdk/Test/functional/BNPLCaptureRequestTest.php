<?php

namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;

class BNPLCaptureRequestTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_BNPL_Capture_Request()
    {
        $hash_in = array(
            'id' => '1211',
            'orderId' => '2111',
            'reportGroup' => 'Planets',
            'amount' => '1000',
            'cnpTxnId' => '011210745239575421',
        );
        $initialize = new CnpOnlineRequest();
        $BNPLCaptureResponse = $initialize->BNPLCaptureRequest($hash_in);
        $response = XmlParser::getNode($BNPLCaptureResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($BNPLCaptureResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }

}