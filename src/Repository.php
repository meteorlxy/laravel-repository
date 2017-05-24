<?php

namespace Meteorlxy\Laravel\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $model;

    protected $instance;

    public function __construct()
    {
        if( ! isset($this->model) ) {
            throw new RepositoryException('The Model of this Repository has not set!');
        }

        $this->instance = new $this->model;

        if( ! $this->instance instanceof Model ) {
            throw new RepositoryException('The Model of this Repository is invalid!');
        }
    }

    public function createModel()
    {
        return new $this->model;
    }

    public function model()
    {
        return $this->instance->newQuery();
    }

    public function __call($method, $parameters)
    {
        return $this->model()->{$method}(...$parameters);
    }
}