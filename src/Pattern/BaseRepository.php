<?php namespace DevHouse\Pattern;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    var $model = null;

    public function __construct()
    {
        if ($this->model == null) {
            throw new \Exception('Model not found!');
        }
    }

    /**
     * All rows
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param null $rowsByPage
     * @return mixed
     */
    public function getTrashed($rowsByPage = null)
    {
        if($rowsByPage){
            return $this->model->onlyTrashed()->paginate($rowsByPage);
        }else{
            return $this->model->onlyTrashed()->get();
        }
    }
    /**
     * @param $n
     * @param string $orderBy
     * @param array $with
     * @return mixed
     */
    public function paginate($n, $orderBy = 'ASC',$with = [])
    {
        return $this->model->with($with)->orderBy('id', $orderBy)->paginate($n);
    }

    /**
     * Find something
     * @param  int $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find something deleted
     * @param $id
     * @return mixed
     */
    public function findWithTrashed($id)
    {
        return $this->model->withTrashed()->find($id);
    }

    /**
     * Find one by a column of table
     * @param $column
     * @param $value
     * @return mixed
     */
    public function firstByColumn($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function firstByColumnTrashed($column, $value)
    {
        return $this->model->withTrashed()->where($column, $value)->first();
    }
    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function getByColumn($column, $value)
    {
        return $this->model->where($column, $value)->get();
    }


    /**
     * @param $columnName
     * @param array $ids
     * @return mixed
     */
    public function getColumnWhereIn($columnName, array $ids)
    {
        return $this->model->whereIn($columnName, $ids)->get();
    }

    /**
     * create something
     * @param $inputs
     * @return Model
     */
    public function create(array $inputs)
    {
        return $this->model->create($inputs);
    }


    /**
     * Update Someone
     * @param $id
     * @param $inputs
     * @return mixed
     */
    public function update($id, array $inputs)
    {
        $user = $this->model->find($id);
        $user->fill($inputs);
        return $user->save();
    }


    /**
     * @param $columnName
     * @param $columnValue
     * @param array $inputs
     * @return mixed
     */
    public function updateByColumn($columnName, $columnValue, array $inputs)
    {
        return $this->model->where($columnName, $columnValue)->update($inputs);
    }

    /**
     * @param $columnName
     * @param array $values
     * @param array $inputs
     * @return mixed
     */
    public function updateMultipleRowsByColumn(
        $columnName,
        array $values,
        array $inputs
    ) {
        return $this->model->whereIn($columnName, $values)->update($inputs);
    }

    /**
     * Delete someone
     * @param  int $id
     * @return boolean
     */
    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
