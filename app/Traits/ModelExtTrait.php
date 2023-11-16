<?php

namespace App\Traits;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Model;

trait ModelExtTrait
{
    public function insertOrUpdate(array $uniqueFields, Model $model, Entity $data): int|null
    {
        $whereCondition = [];
        foreach ($uniqueFields as $field) {
            $whereCondition[$field] = $data->$field;
        }
        $existingRecord = $model->where($whereCondition)->first();
  

        if ($existingRecord) 
        {
            $model->update($existingRecord->id, $data);
            return $existingRecord->id;
        }
        else
        {
            $model->insert($data);
            return $model->getInsertID();
        }
    }
}
