<?php

namespace Tests\Feature\penjualan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Penjualan;

class test extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/penjualan/31');

        $response->assertStatus(200);
    }

    public function test_example1()
    {
        $response = $this->get('/penjualan/47');

        $response->assertStatus(200);
    }
}
