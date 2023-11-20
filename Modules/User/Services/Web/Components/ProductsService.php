<?php

namespace Modules\User\Services\Web\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\User\Repositories\ProductRepository;
use Modules\User\Traits\Response;

/**
 *
 */
class ProductsService extends Component
{
    use WithPagination;
    use Response;

    /**
     * @var ProductRepository|Application|\Illuminate\Foundation\Application|mixed
     */
    protected ProductRepository $productRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * @return Renderable
     */
    public function render(): Renderable
    {
        return view('user::components.products', [
            'products' => $products = $this->productRepository->latest()->paginate(),
            'response' => $this->dataResponse(data: compact('products'), options: JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        ]);
    }

    /**
     * @param int|string $product_id
     * @return void
     */
    public function addProductToCart(int|string $product_id): void
    {
        $this->dispatch('addProductToCart', $product_id)->to(CartService::class);
    }

    /**
     * @param int|string $product_id
     * @return void
     */
    public function removeProductFromCart(int|string $product_id): void
    {
        $this->dispatch('removeProductFromCart', $product_id)->to(CartService::class);
    }
}
