<?php

namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;

class BNPLAuthorizationRequestTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_simple_BNPL_Authorization_Request()
    {
        $hash_in = array(
            'id' => '1211',
            'orderId' => '2111',
            'reportGroup' => 'Planets',
            'amount' => '1000',
            'provider' => 'AFFIRM',
            'postCheckoutRedirectUrl' => 'www.abc.com',
            'customerInfo' => array(
                'accountUsername' => 'username123',
                'userAccountNumber' => '7647326235897',
                'userAccountEmail' => 'dummtemail@abc.com',
                'membershipId' => '23874682304',
                'membershipPhone' => '16818807607551094758',
                'membershipEmail' => 'email@abc.com',
                'membershipName' => 'member123',
                'accountCreatedDate' => '2050-07-17',
                'userAccountPhone' => '1392345678',
            ),
            'billToAddress' => array(
                'name' => 'Jonathan Ross',
                'addressLine1' => '10th Floor',
                'addressLine2' => 'Tower 2',
                'addressLine3' => '900 Chelmsford Street',
                'city' => 'Lowell',
                'state' => 'MA',
                'zip' => '01851',
                'country' => 'USA',
                'email' => 'jross@litle.com<',
                'phone' => '800-548-5326'),
            'shipToAddress' => array(
                'name' => 'Raymond J. Johnson Jr. B',
                'addressLine1' => '123 Main Street',
                'city' => 'McLean',
                'state' => 'VA',
                'zip' => '22102',
                'country' => 'USA',
                'email' => 'ray@rayjay.com',
                'phone' => '978-275-0000',
                'sellerId' => '21234234A2',
                'url' => 'www.google.com',
            ),
            'enhancedData' => array(
                'customerReference' => 'cust ref sale1',
                'salesTax' => '1000',
                'discountAmount' => '0',
                'shippingAmount' => '0',
                'dutyAmount' => '0',
                'lineItemData' => array(
                    'itemSequenceNumber' => '1',
                    'itemDescription' => 'Clothes',
                    'productCode' => 'TB123',
                    'quantity' => '1',
                    'unitOfMeasure' => 'EACH',
                    'lineItemTotal' => '9900',
                    'lineItemTotalWithTax' => '10000',
                    'itemDiscountAmount' => '0',
                    'commodityCode' => '301',
                    'unitCost' => '31.02',
                    'itemCategory' => 'Aparel',
                    'itemSubCategory' => 'Clothing',
                    'shipmentId' => '12222222',
                    'subscription' => array(
                        'subscriptionId' => 'subscription',
                        'nextDeliveryDate' => '2023-01-01',
                        'periodUnit' => 'YEAR',
                        'numberOfPeriods' => '123',
                        'regularItemPrice' => '123',
                        'currentPeriod' => '123',
                    )
                )
            ),

        );
        $initialize = new CnpOnlineRequest();
        $BNPLAuthorizationResponse = $initialize->BNPLAuthorizationRequest($hash_in);
        $response = XmlParser::getNode($BNPLAuthorizationResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($BNPLAuthorizationResponse, 'location');
        $this->assertEquals('sandbox', $location);

    }

}