<?php

namespace Modules\StatusPernikahan\Models;

use CodeIgniter\Model;

class StatusPernikahanModel extends Model
{
    protected $table            = 'status_pernikahan';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];
}
