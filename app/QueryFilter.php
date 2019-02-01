<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-31
 * Time: 18:55
 */

namespace ExamenEducacionMedia;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    protected $valid;

    public function applyTo($query, array $filters)
    {
        $rules = $this->rules();

        $validator = Validator::make(array_intersect_key($filters, $rules), $rules);

        $this->valid = $validator->valid();

        foreach ($this->valid as $name => $value) {
            $this->applyFilter($query, $name, $value);
        }

        return $query;
    }

    abstract public function rules(): array;

    protected function applyFilter($query, $name, $value)
    {
        if (method_exists($this, $method = Str::camel($name))) {
            $this->$method($query, $value);
        } else {
            $query->where($name, $value);
        }
    }

    public function valid()
    {
        return $this->valid;
    }
}
