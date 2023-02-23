<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PessoasTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('pessoa');

        $response->assertStatus(200);
    }

    public function test_Cria_USers(){

        $user = new \App\Models\User();
        $user->email = 'test2e@teste.com';
        $user->password= \Illuminate\Support\Facades\Hash::make('teste');
        $user->name='Teste';
        $user->save();
        $this->assertDatabaseHas('users',['name'=>'Teste']);
    }
}

