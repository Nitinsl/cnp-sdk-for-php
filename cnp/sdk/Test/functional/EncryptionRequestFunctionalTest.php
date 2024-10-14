<?php

namespace cnp\sdk\Test\functional;
namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;


class EncryptionRequestFunctionalTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_encryption_key_Request()
    {
        $hash_in = array('encryptionKeyRequest' => 'CURRENT');

        $initialize = new CnpOnlineRequest();
        $encryptionKeyResponse = $initialize->encryptionKeyRequest($hash_in);
        $response = XmlParser::getNode($encryptionKeyResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($encryptionKeyResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }

    public function test_simple_payload_Request()
    {
        $hash_in = array('encryptionKeySequence' => '12',
            'payload' => '12345678912345'
        );


        $initialize = new CnpOnlineRequest();
        $encryptionPayloadResponse = $initialize->encryptedPayload($hash_in);
        $response = XmlParser::getNode($encryptionPayloadResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($encryptionPayloadResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }
}