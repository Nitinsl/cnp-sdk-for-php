<?php

namespace cnp\sdk\Test\unit;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;

class FinicityUnitTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_finicity_url_request()
    {
        $hash_in = array(
            'id' => '1211',
            'reportGroup' => 'Planets',
            'firstName' => 'abcd',
            'lastName' => 'wxyz',
            'phoneNumber' => '1234567890',
            'email' => 'abcd@gmail.com',

        );
        $mock = $this->getMock('cnp\sdk\CnpXmlMapper');
        $mock	->expects($this->once())
            ->method('request')
            ->with($this->matchesRegularExpression('/.*<firstName>abcd.*<lastName>wxyz.*<phoneNumber>1234567890.*<email>abcd@gmail.com.*/'));

        $cnpTest = new CnpOnlineRequest();
        $cnpTest->newXML = $mock;
        $cnpTest->finicityUrlRequest($hash_in);
    }

    public function test_simple_finicity_account_request()
    {
        $hash_in = array(
            'id' => '1212',
            'reportGroup' => 'Planets',
            'echeckCustomerId' => 'abcdefg'

        );
        $mock = $this->getMock('cnp\sdk\CnpXmlMapper');
        $mock	->expects($this->once())
            ->method('request')
            ->with($this->matchesRegularExpression('/.*<echeckCustomerId>abcdefg.*/'));

        $cnpTest = new CnpOnlineRequest();
        $cnpTest->newXML = $mock;
        $cnpTest->finicityAccountRequest($hash_in);
    }

}