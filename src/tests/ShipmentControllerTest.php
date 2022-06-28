<?php

namespace Tests;

class ShipmentControllerTest extends TestCase
{
    /**
     * ShipmentControllerTest
     *
     * @return void
     */
    public function test_shipment_controller_index()
    {
        $this->get('/api/shipments');
        $response = json_decode($this->response->getContent(), true);

        $this->assertResponseOk();
        $this->assertSame(20160, $response['total']);
    }

    /**
     * ShipmentControllerTest
     *
     * @return void
     */
    public function test_shipment_controller_index_filter_carrier()
    {
        $this->get('/api/shipments?carrier=Lyla Padberg');
        $response = json_decode($this->response->getContent(), true);

        $this->assertResponseOk();
        $this->assertSame(391, $response['total']);
        $this->assertSame('Lyla Padberg', $response['data'][0]['carrier']['name']);
    }

    /**
     * ShipmentControllerTest
     *
     * @return void
     */
    public function test_shipment_controller_index_filter_company()
    {
        $this->get('/api/shipments?company=darrion68@blick.info');
        $response = json_decode($this->response->getContent(), true);

        $this->assertResponseOk();
        $this->assertSame(415, $response['total']);
        $this->assertSame('darrion68@blick.info', $response['data'][0]['company']['email']);
    }

    /**
     * ShipmentControllerTest
     *
     * @return void
     */
    public function test_shipment_controller_index_filter_address()
    {
        $this->get('/api/shipments?address[postcode]=66839');
        $response = json_decode($this->response->getContent(), true);

        $this->assertResponseOk();
        $this->assertSame(1, $response['total']);
        $this->assertSame(66839, $response['data'][0]['stops']['0']['postcode']);
    }
}
