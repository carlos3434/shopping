<?php namespace App\Repositories;

/**
 * RepositoryInterface provides the standard functions to be expected of ANY 
 * repository.
 */
interface RepositoryInterface {

    //wiki
    public function find($id);
    public function create(array $attributes);
    public function destroy($ids);

    //custom
    public function all($request);
    public function get($model);
    public function update($request, $model);
    public function delete( $model );

}