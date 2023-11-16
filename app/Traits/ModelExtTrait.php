<?php 

namespace App\Traits;

use CodeIgniter\Entity\Entity;

trait InsertOrUpdateTrait
{
    public function insertOrUpdate(string $uniqueField, Entity $data) : int|null
    {
        $existingRecord = $this->where($uniqueField, $data[$uniqueField])->first();

        if ($existingRecord) 
        {
            $this->update($existingRecord['id'], $data);
            return $existingRecord['id'];
        } 
        else 
        {
            return $this->insert($data);
        }
    }
}
