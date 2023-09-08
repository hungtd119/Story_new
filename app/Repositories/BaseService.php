<?php

namespace App\Repositories;

use App\Exceptions\ErrorException;
use App\Models\Story;
use App\Repositories\Helper\HelperInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class BaseService
{
    protected $model;
    protected $helperRepository;
    public function __construct(Model $model, HelperInterface $helperRepository)
    {
        $this->model = $model;
        $this->helperRepository = $helperRepository;
    }
    public function getDataInput(Request $request)
    {
        $data = [];
        $requestDatas = $request->all();
        foreach ($requestDatas as $key => $value) {
            if (Schema::hasColumn($this->model->table, $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
    public function getAll($limit, $offset, $keyword)
    {
        // return $this->model->offset($offset)->limit($limit)->get();
        $query = $this->model->query();
        $columns = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        foreach ($columns as $column) {
            $query->orWhere($column, 'like', '%' . $keyword . '%');
        }
        return $query->offset($offset)->limit($limit)->get();
    }
    public function findById(int $id)
    {
        return $this->model->find($id);
    }
    public function delete(int $id)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->delete();
            return true;
        } else {
            throw ErrorException::notFound();
        }
    }
    public function store(array $data, int $id = null)
    {
        if ($id === null) {
            $newModel = new $this->model;
            $data['id'] = $this->helperRepository->generateUniqueCode($this->model->_NAME);
            $newModel->fill($data);
            $newModel->save();
            return $newModel;
        } else {
            $model = $this->model->find($id);
            if ($model) {
                $model->update($data);
                return $model;
            } else {
                return false;
            }
        }
    }
}
