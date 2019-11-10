<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/1/2019
 * Time: 9:36 PM
 */

namespace App\Repositories;


class Repository
{
    protected $model;

    function all () {
        return $this->model->get();
    }

    function get ($id) {
        return $this->model->where('id', $id)->get();
    }

    function first ($id = '') {
        $query = $this->model->query();
        if ($id != '') {
            $query = $query->where('id', $id);
        }
        return $query->first();
    }
}