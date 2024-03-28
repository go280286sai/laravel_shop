<?php

namespace Tests\Feature;

use Tests\TestCase;

class LinkTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_link(): void
    {
        //Main page
        $response = $this->get('/');
        $response->assertStatus(200);
        //Product page
        $response = $this->get('/product/1');
        $response->assertStatus(200);
        $response->assertSee('Product');
        //Category page
        $response = $this->get('/category/1');
        $response->assertStatus(200);
        $response->assertSee('Category');
        //Main page
        $response = $this->get('/parent/1');
        $response->assertStatus(200);
        $response->assertSee('Category');

    }
}
