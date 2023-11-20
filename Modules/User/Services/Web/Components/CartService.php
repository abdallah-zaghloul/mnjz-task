<?php

namespace Modules\User\Services\Web\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Modules\User\Repositories\CartItemRepository;
use Modules\User\Traits\Response;

/**
 *
 */
class CartService extends Component
{
    use Response;

    /**
     * @var string[]
     */
    protected $listeners = [
        'addProductToCart',
        'removeProductFromCart',
        'changeCount',
    ];

    /**
     * @var CartItemRepository|Application|\Illuminate\Foundation\Application|mixed
     */
    protected CartItemRepository $cartItemRepository;


    public int $product_id;

    /**
     *
     */
    public function __construct()
    {
        $this->cartItemRepository = app(CartItemRepository::class);
    }

    /**
     * @return Renderable
     */
    public function render(): Renderable
    {
        return view('user::components.cart', [
            'cart_items' => $cart_items = $this->cartItemRepository->getCartItems(),
            'response' => $this->dataResponse(data: compact('cart_items'), options: JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        ]);
    }

    /**
     * @param int|string $product_id
     * @return void
     */
    public function addProductToCart(int|string $product_id): void
    {
        $cartItem = $this->cartItemRepository->getCartItem($product_id);
        if ($cartItem) $cartItem->increment('count');
        else $this->cartItemRepository->create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
//           'count'=> 1,
        ]);
    }

    /**
     * @param int|string $product_id
     * @return void
     */
    public function removeProductFromCart(int|string $product_id): void
    {
        $cartItem = $this->cartItemRepository->getCartItem($product_id);
        if ($cartItem) {
            $cartItem->count > 1 ? $cartItem->decrement('count') : $cartItem->delete();
        }
    }


    /**
     * @param int|string $product_id
     * @param int $count
     * @return void
     */
    public function changeCount(int|string $product_id, int $count): void
    {
        $cartItem = $this->cartItemRepository->getCartItem($product_id);
        if ($cartItem) {
            $count > 1 ? $cartItem->update(compact('count')) : $cartItem->delete();
        }
    }

    public function rules(): array
    {
        return [
          'product_id' => [
              Rule::exists('products'),
//              Rule::unique('cart_items','product_id')->where('user_id',auth()->id()) checked at query
          ],
        ];
    }

}
