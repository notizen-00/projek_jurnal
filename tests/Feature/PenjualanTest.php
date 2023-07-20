<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Penjualan;

class test_penjualan extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetPenjualan()
    {
        $response = $this->get('/penjualan');

        $response->assertStatus(200);
    }

    public function testGetPenjualanShow()
    {
        $response = $this->get('/penjualan/47');

        $response->assertStatus(200);
    }
}
