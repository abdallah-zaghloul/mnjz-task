<?php

namespace Modules\User\Tests\Feature;

use Modules\User\Database\Seeders\ProductSeeder;
use Modules\User\Repositories\ProductRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Products extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testExample(): void
    {
        app(ProductSeeder::class)->run(10);
        $products = app(ProductRepository::class)->paginate();
        $this->assertNotEmpty($products);
    }
}
