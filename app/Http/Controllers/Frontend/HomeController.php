<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Shopping\CarInterface;
use App\Filters\CarFilter;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends BaseController
{
    private $carRepository;

    public function __construct(CarInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }
    /**
     * Application Landing Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, CarFilter $filters)
    {
        if (!$request->has('page')) {
            $request->request->add(['page' => 1]);
        }
        $request->request->add(['status' => 1]);
        $cars = $this->carRepository->all($filters);

        $this->loadUserToken();
        
        if ($request->has('search')) {
            $items = Car::searchByQuery([
              'multi_match' => [
                'query' => $request->input('search'),
                'fields' => [ "title", "description", "model", "registration"]
              ],
            ]);

            $perPage = 10;
            $options = ['path'=>'/admin/car'];
            $page = $request->input('page', 1);
            $page = $page ?: ( Paginator::resolveCurrentPage() ?: 1);
            $items = $items instanceof Collection ? $items : Collection::make($items);
            $cars = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        }
        return view('frontend/home', compact('cars') );
    }

    public function show(Car $car) {
        $car = $this->carRepository->get($car);
        $this->loadUserToken();
        return view('frontend.car-detail', compact('car') );
    }

}