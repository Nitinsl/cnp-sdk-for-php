<?php

namespace cnp\sdk\Test\functional;
namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\exceptions\cnpSDKException;
use cnp\sdk\XmlParser;


class EncryptionRequestFunctionalTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    /**
     * @throws cnpSDKException
     */
    public function test_simple_encryption_key_Request()
    {
        $hash_in = array('encryptionKeyRequest' => 'CURRENT');

        $initialize = new CnpOnlineRequest();
        $encryptionKeyResponse = $initialize->encryptionKeyRequest($hash_in);
        $response = XmlParser::getNode($encryptionKeyResponse, 'encryptionKeySequence');
        $this->assertEquals('10000', $response);

    }
}