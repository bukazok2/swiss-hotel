<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\InsertOrUpdateTrait;

class AttachmentsModel extends Model
{
    use InsertOrUpdateTrait;

    protected $table = 'attachments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'path',
        'url_from',
        "created_at",
        "updated_at",
    ];
}