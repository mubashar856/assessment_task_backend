<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/9/2019
 * Time: 9:35 PM
 */

namespace App\Repositories;


use App\Models\Match;

class MatchRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Match();
    }

    function update ($id, $fields) {
        $match = $this->model->where('id', $id)->first();
        if (isset($fields['status'])) {
            $match->status = $fields['status'];
        }
        if (isset($fields['remarks'])) {
            $match->remarks = $fields['remarks'];
        }
        return $match->save();
    }
}