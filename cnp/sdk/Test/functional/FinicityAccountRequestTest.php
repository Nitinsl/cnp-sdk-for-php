<?php

namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;

class finicityAccountRequestTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_finicity_Account_Request()
    {
        $hash_in = array('id' => 'id',
            'id' => '1211',
            'reportGroup' => 'Planets',
            'echeckCustomerId' => 'abcdef'
        );
        $initialize = new CnpOnlineRequest();
        $finicityAccountResponse = $initialize->finicityAccountRequest($hash_in);
        $response = XmlParser::getNode($finicityAccountResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($finicityAccountResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }

}