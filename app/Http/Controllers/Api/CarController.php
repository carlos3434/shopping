<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Repositories\Shopping\CarInterface;
use Illuminate\Http\Request;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Filters\CarFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CarController extends Controller
{

    private $carRepository;

    public function __construct( CarInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CarFilter $filters)
    {
        if ($request->has('search')) {
            $items = Car::searchByQuery([
              'multi_match' => [
                'query' => $request->input('search'),
                'fields' => [ "title", "description", "model", "registration"]
              ],
            ]);

            $perPage = 10;
            $options = ['path'=>'cars'];
            $page = $request->input('page', 1);
            $page = $page ?: ( Paginator::resolveCurrentPage() ?: 1);
            $items = $items instanceof Collection ? $items : Collection::make($items);
            return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        }
        return $this->carRepository->all($filters);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        $car = $this->carRepository->create( $request->all() );
        $car->addToIndex();
        return response()->json($car, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return $this->carRepository->getOne($car);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, Car $car )
    {
        $car = $this->carRepository->update($request->all(), $car);
        return response()->json( $car, 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $this->repository->delete($car);
        return response()->json(null, 204);
    }
}
