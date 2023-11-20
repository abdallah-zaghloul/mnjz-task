<?php

namespace Modules\User\Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Modules\User\Database\Seeders\ProductSeeder;
use Modules\User\Models\CartItem;
use Modules\User\Models\User;
use Modules\User\Repositories\CartItemRepository;
use Modules\User\Repositories\ProductRepository;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\Web\Components\CartService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Cart extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testExample(): void
    {
        app(ProductSeeder::class)->run(10);
        $user = app(UserRepository::class)->create(['email'=> 'test@gmail.com','name'=> 'test', 'password'=> Hash::make('12345678')]);
        app(CartItemRepository::class)->create(['user_id'=> $user->id, 'product_id'=> app(ProductRepository::class)->first()->id]);
        $this->assertNotEmpty(app(CartItemRepository::class)->first());
    }
}
