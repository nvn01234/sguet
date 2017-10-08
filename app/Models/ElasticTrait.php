<?php
/**
 * Created by PhpStorm.
 * User: nguye
 * Date: 10/8/2017
 * Time: 9:37 PM
 */

namespace App\Models;


trait ElasticTrait
{
    public function toElasticData() {
        return $this->toArray();
    }
}