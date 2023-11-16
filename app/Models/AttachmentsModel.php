<?php

namespace App\Models;

use CodeIgniter\Model;

class AttachmentsModel extends Model
{
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