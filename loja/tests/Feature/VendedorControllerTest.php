<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\VendedoresController;

class VendedoresControllerTest extends TestCase
{
    private $vendedor;

    public function __construct()
    {
        parent::__construct();
        $this->vendedor = new VendedoresController;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCheckVendedor()
    {

        $this->assertTrue( $this->vendedor->checkVendedor(-1) );
        $this->assertTrue( $this->vendedor->checkVendedor(1) );
        $this->assertFalse( $this->vendedor->checkVendedor(2) );
        $this->assertFalse( $this->vendedor->checkVendedor(222) );
    }

    public function testExisteVendedor()
    {
        $this->assertTrue($this->vendedor->existeVendedor('Paula'));
        $this->assertFalse($this->vendedor->existeVendedor('Marcos'));
    }

    public function testGetVendedor()
    {
        $this->assertEquals('Romeu', $this->vendedor->getVendedor(2) );
        $this->assertNotEquals('Romeu', $this->vendedor->getVendedor(4) );
    }

    public function testGetVendedorJSON()
    {
        $this->assertJson( $this->vendedor->getVendedorJSON(3) );
    }

    public function testGetLogin()
    {
        $response = $this->get('login');
        $response->assertOk();
    }


}