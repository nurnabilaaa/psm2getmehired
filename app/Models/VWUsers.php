<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;

class VWUsers extends \Eloquent
{
    use Sortable;

    protected $table = 'vw_users';
}
