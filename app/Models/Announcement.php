<?php

namespace App\Models;


use Kyslik\ColumnSortable\Sortable;

/**
 * @property mixed id
 * @property mixed $title
 * @property mixed $content_type
 * @property false|mixed|string $expired_at
 * @property mixed $content_body
 * @property mixed $announce_by
 */
class Announcement extends \Eloquent
{
    use Sortable;

    protected $table = 'announcement';
    protected $dates = ['expired_at'];
}
