<?php

namespace AVeryLongTips\CodeGenerator\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseService
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $filters = [];

    public function __construct()
    {
        $this->setModel();
    }

    public function __call($method, $parameters)
    {
        return $this->model->{$method}(...$parameters);
    }

    abstract public function getModel();

    /**
     * @return Model
     */
    public function setModel()
    {
        $model = app()->make($this->getModel());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->getModel()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Filter query.
     *
     * @param mixed $query
     *
     * @return mixed
     */
    public function filter($query, array $data = [])
    {
        foreach ($data as $key => $value) {
            if (isset($this->filters[$key])) {
                [$column, $operation] = $this->filters[$key];
                switch ($operation) {
                    case '=':
                    case '!=':
                    case '>':
                    case '>=':
                    case '<':
                    case '<=':
                        $query = $query->where($column, $operation, $value);
                        break;
                    case 'like':
                        $query = $query->where($column, $operation, '%' . $value . '%');
                        break;
                    case 'in':
                        $query = $query->whereIn($column, $value);
                        break;
                    case 'not_in':
                        $query = $query->whereNotIn($column, $value);
                        break;
                    default:
                        if (method_exists($this, $operation)) {
                            $query = $this->{$operation}($query, $column, $value);
                        }
                        break;
                }
            }
        }

        return $query;
    }

    /**
     * Index items.
     *
     * @return mixed
     */
    public function index(array $condition)
    {
        // select
        $entities = $this->model->select($condition['select'] ?? ['*']);

        // relations
        if (isset($condition['with'])) {
            $entities = $entities->with($condition['with']);
        }

        // realtion counts
        if (isset($condition['with_count'])) {
            $entities = $entities->withCount($condition['with_count']);
        }

        // filter data
        if (count($condition)) {
            $entities = $this->filter($entities, $condition);
        }

        // order by
        if (isset($condition['order_by'], $condition['order_type'])) {
            $entities = $entities->orderBy($condition['order_by'], $condition['order_type'] ? 'asc' : 'desc');
        }

        // first
        if (isset($condition['first'])) {
            return $entities->first();
        }

        // all
        if (isset($condition['all'])) {
            return $entities->get();
        }

        // limit
        if (isset($condition['limit'])) {
            return $entities->paginate($condition['limit']);
        }

        return $entities->get();
    }

    /**
     * Update multiple data.
     *
     * @param string $keyName
     *
     * @return mixed
     */
    public function edit(array $data, $keyName = null)
    {
        $table = $this->model->getTable();
        $keyName = $keyName ?: $this->model->getKeyName();
        $values = array_keys(array_values($data)[0]);
        $list = implode(', ', array_keys($data));
        $current = now()->format('Y-m-d H:i:s');

        $statement = "UPDATE {$table} SET" . PHP_EOL;
        foreach ($values as $value) {
            $statement .= "{$value} = CASE {$keyName}" . PHP_EOL;
            foreach ($data as $key => $item) {
                if (!isset($item[$value])) {
                    throw new \Exception('Missing data');
                }
                $statement .= "    WHEN '{$key}' THEN '{$item[$value]}'" . PHP_EOL;
            }
            $statement .= 'END,' . PHP_EOL;
        }
        $statement .= "updated_at = '{$current}' WHERE {$keyName} IN ({$list})";

        return DB::update($statement);
    }
}
