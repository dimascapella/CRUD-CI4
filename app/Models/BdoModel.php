<?php

namespace App\Models;

use CodeIgniter\Model;

class BdoModel extends Model
{
    protected $table = 'bdodetails';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug', 'photo'];

    function getClass($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
