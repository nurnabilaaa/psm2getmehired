<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;

class VWCurriculumVitae extends \Eloquent
{
    use Sortable;

    protected $table = 'vw_curriculum_vitae';
}
