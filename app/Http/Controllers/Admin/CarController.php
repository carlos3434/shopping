<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Shopping\CarInterface;
use App\Filters\CarFilter;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CarCreateRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Http\Requests\CarDeleteRequest;
use App\Helpers\FileUploader;
/**
 * Class HomeController
 * @package App\Http\Controllers\Admin
 */
class CarController extends Controller
{
    private $carRepository;
    private $fileUploader;

    public function __construct( CarInterface $carRepository,FileUploader $fileUploader)
    {
        $this->carRepository = $carRepository;
        $this->fileUploader = $fileUploader;
    }

    public function index(Request $request, CarFilter $filters)
    {
        if (!$request->has('page')) {
            $request->request->add(['page' => 1]);
        }
        $request->request->add(['status' => 1]);
        $cars = $this->carRepository->all($filters)->withPath('/admin/car');
        return view('admin.car.index', compact('cars'));
    }

    public function show( Car $car)
    {
        return $this->carRepository->get($car);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.car.create', compact('categories'));
    }

    public function store( CarCreateRequest  $request)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'image', 'image');

        $car = $this->carRepository->create( $all );
        $car->addToIndex();
        return response()->json($car, 201);
    }

    public function edit(Car $car)
    {
        $categories = Category::all();
        return view('admin.car.edit',compact('car','categories'));
    }

    public function update( CarUpdateRequest $request, Car $car)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'image', 'image');
        $car = $this->carRepository->update( $all , $car);
        return response()->json($car, 201);
    }
    public function destroy(CarDeleteRequest $request, Car $car)
    {
        $this->carRepository->deleteOne($car);
        return response()->json(null, 204);
    }
    private function storeFile( $request , $all , $folder, $fieldName ){
        if ( $request->hasFile($fieldName) ) {
            $fileValue = $this->fileUploader->upload(
                $request->file($fieldName),
                'files/'.$folder
            );
            $all[$fieldName] = $folder.'/'.$fileValue;
        }
        return $all;
    }
}