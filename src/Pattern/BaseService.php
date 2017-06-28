<?php namespace DevHouse\Pattern;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class BaseService
{
    protected $mainRepo = null;

    public function __construct()
    {
        if ($this->mainRepo == null) {
            throw new Exception('mainRepository not found!');
        }
    }

    /**
     * All rows
     * @return Collection
     */
    public function all()
    {
        return $this->mainRepo->all();
    }

    /**
     * @param int $n
     * @param string $orderBy
     * @param array $with
     * @return mixed
     */
    public function paginate($n = 25, $orderBy = 'ASC', $with = [])
    {
        return $this->mainRepo->paginate($n, $orderBy, $with);
    }

    /**
     * Find something
     * @param  int $id
     * @return Model
     */
    public function find($id)
    {
        return $this->mainRepo->find($id);
    }

    public function findWithTrashed($id)
    {
        return $this->mainRepo->findWithTrashed($id);
    }

    /**
     * create something
     * @param $inputs
     * @return Model
     * @throws Exception
     */
    public function create(array $inputs)
    {
        try {
            return $this->mainRepo->create($inputs);
        } catch (Exception $e) {
            throw new Exception("Error al crear " . $e->getMessage());
        }
    }

    /**
     * Update Someone
     * @param $id
     * @param $inputs
     * @return mixed
     */
    public function update($id, array $inputs)
    {
        return $this->mainRepo->update($id, $inputs);
    }

    /**
     * Delete someone
     *
     * @param  int $id
     * @return bool
     * @throws Exception
     */
    public function destroy($id)
    {
        try {
            return $this->mainRepo->destroy($id);
        } catch (Exception $e) {
            Log::error($e);
            throw new Exception("El servicio no puede eliminar el elemento");
        }
    }


}
