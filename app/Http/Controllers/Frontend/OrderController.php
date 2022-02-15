<?php
namespace App\Http\Controllers\Frontend;

use App\Repositories\Shopping\OrderInterface;
use App\Models\Order;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\OrderCreateRequest;
use Auth;
/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class OrderController extends BaseController
{
    private $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request) {
        $this->loadUserToken();
        $cars = $this->orderRepository->getByCurrentUser($request);
        return view('frontend.cart', compact('cars'));
    }

    public function store(OrderCreateRequest $request)
    {
        $message = $status = $user_token  = '';
        $userId = Auth::id();
        $carId = $request->get('car_id');
        $user_token = $request->cookie('user_token');

        if(!Auth::check()) {
            $params = [['token', $user_token], ['car_id', $carId]];
        } else {
            $params = [['user_id', $userId], ['car_id', $carId]];
        }
        if( Order::where($params)->exists() ) {
            return response()->json( ['message'=>'Car is already added to the cart'] , 400);
        }

        $car = Car::find($carId);

        try {
            $order = new Order;
            $order->user_id = $userId;
            $order->token = $user_token;
            $order->car_id = $car->id;
            $order->unit_price = $car->original_price;
            $order->quantity = 1;
            $order->save();

            $status = 201;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $status = 500;
        }

        if($status == 500) {
            return response()->json(['message'=>$message], $status );
        }
        return response()->json( $order->getAttributes(), $status );
    }

    public function checkout(Request $request) {
        $this->loadUserToken();
        $cars = $this->orderRepository->getByCurrentUser($request);
        return view('frontend.checkout', compact('cars'));
    }

    public function destroy(Order $order)
    {
        $this->orderRepository->delete($order);
        return response()->json(null, 204);
    }
}