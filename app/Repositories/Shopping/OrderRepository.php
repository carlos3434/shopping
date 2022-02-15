<?php
namespace App\Repositories\Shopping;

use App\Repositories\AbstractRepository;
use App\Repositories\Shopping\OrderInterface;
/**
 * 
 */
class OrderRepository extends AbstractRepository implements OrderInterface
{

    protected $modelClassName = 'Order';
    protected $modelClassNamePath = "App\Models\Order";
    protected $collectionNamePath = "App\Http\Resources\OrderCollection";
    protected $resourceNamePath = "App\Http\Resources\OrderResource";

    public function getByCurrentUser($request)
    {
        if(!\Auth::check()) {
            $params = ['token', $request->cookie('user_token')];
        } else {
            $params = ['user_id', \Auth::id()];
        }

        $orders = call_user_func_array(
            "{$this->modelClassNamePath}::where", $params
        );
        return $orders->paginate();
    }


}