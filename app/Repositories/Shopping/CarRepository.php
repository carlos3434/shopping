<?php
namespace App\Repositories\Shopping;

use App\Repositories\AbstractRepository;
use App\Repositories\Shopping\CarInterface;
/**
 * 
 */
class CarRepository extends AbstractRepository implements CarInterface
{

    protected $modelClassName = 'Car';
    protected $modelClassNamePath = "App\Models\Car";
    protected $collectionNamePath = "App\Http\Resources\CarCollection";
    protected $resourceNamePath = "App\Http\Resources\CarResource";

}