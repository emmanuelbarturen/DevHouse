<?php namespace DevHouse\Pattern\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 29/06/2017
 * Time: 8:53 AM
 */
abstract class BasicCrud
{
    public abstract function all();

    public abstract function find($id);

    public abstract function create(array $attributes);

    public abstract function update(Model $model, array $attributes);

    public abstract function delete(Model $model);
}