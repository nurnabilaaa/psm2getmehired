<?php

namespace App\Models;


/**
 * @property mixed customer_id
 * @property mixed package
 * @property mixed consultant_id
 * @property mixed cv_origin_filename
 * @property mixed cv_modified_filename
 * @property int|mixed is_paid
 * @property int|mixed status
 * @property mixed price
 */
class CurriculumVitae extends \Eloquent
{
    protected $table = 'curriculum_vitae';
}
