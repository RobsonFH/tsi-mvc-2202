<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Clientes;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $cliente = Clientes::create([
            'nome'     => 'Davy Jones',
            'endereco' => 'Holandes Voador',
            'email'    => 'bigodebranco@gmail.com',
            'telefone' => '123123123'
        ]);

        $this->assertDataBaseHas('clientes', ['nome' => 'Davy Jones']);

        /*
        $cliente->destroy($cliente->id);
        $this->assertDatabaseMissing('clientes', ['nome' => 'Davy Jones']);
        */
    }
}