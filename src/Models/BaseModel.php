<?php

namespace App\Models;

use App\Database;

abstract class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
}
