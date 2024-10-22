<?php

namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;

class finicityUrlRequestTest extends \PHPUnit_Framework_TestCase
{

    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_finicity_Url_Request()
    {
        $hash_in = array(
            'id' => '1211',
            'firstName' => 'abc',
            'lastName' => 'xyz',
            'phoneNumber' => '123456789',
            'email' => 'abc@gmail.com',

        );
        $initialize = new CnpOnlineRequest();
        $finicityUrlResponse = $initialize->finicityUrlRequest($hash_in);
        $response = XmlParser::getNode($finicityUrlResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($finicityUrlResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }

    public function test_encrypted_finicity_Url_Request()
    {
        $hash_in = array(
            'id' => '1211',
            'firstName' => 'abc',
            'lastName' => 'xyz',
            'phoneNumber' => '123456789',
            'email' => 'abc@gmail.com',
            'oltpEncryptionPayload' => true
        );
        $initialize = new CnpOnlineRequest();
        $finicityUrlResponse = $initialize->finicityUrlRequest($hash_in);
        $response = XmlParser::getNode($finicityUrlResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($finicityUrlResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }
}