<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class VWUsers extends Model
{
    use Sortable;

    protected $table = 'vw_users';
}
