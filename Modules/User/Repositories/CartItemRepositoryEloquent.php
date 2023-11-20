<?php

namespace Modules\User\Repositories;

use Illuminate\Support\Enumerable;
use Modules\User\Models\CartItem;
use Prettus\Repository\Eloquent\BaseRepository;
use Modules\User\Criteria\RequestCriteria;

/**
 * Class CartItemRepositoryEloquent.
 *
 * @package namespace Modules\User\Repositories;
 */
class CartItemRepositoryEloquent extends BaseRepository implements CartItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CartItem::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCartItems(int|string|null $user_id = null, string $method = 'get'): Enumerable
    {
        return $this->getCartItemsQuery($user_id)->{$method}();
    }


    public function getCartItemsQuery(int|string|null $user_id = null)
    {
        return $this->where('user_id', $user_id ?? auth()->id())
            ->with('product:id,name,price')
            ->withAggregate('product as total', 'cart_items.count * products.price');
    }


    public function getCartItem(int|string $product_id, int|string|null $user_id = null)
    {
        return $this->getCartItemsQuery($user_id)->firstWhere('product_id', $product_id);
    }

}
