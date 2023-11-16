<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Traits\ModelExtTrait;

class AttachmentsModel extends Model
{
    use ModelExtTrait;

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