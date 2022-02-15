<?php
namespace App\Repositories\Shopping;

use App\Repositories\AbstractRepository;
use App\Repositories\Shopping\UserInterface;
/**
 * 
 */
class UserRepository extends AbstractRepository implements UserInterface
{

    protected $modelClassName = 'User';
    protected $modelClassNamePath = "App\Models\User";
    protected $collectionNamePath = "App\Http\Resources\UserCollection";
    protected $resourceNamePath = "App\Http\Resources\UserResource";

}