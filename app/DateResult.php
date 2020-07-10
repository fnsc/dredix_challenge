<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateResult extends Model
{
    protected $fillable = ['start_date', 'end_date', 'result'];

    /**
     *
     */
    public function search(array $filter)
    {
        return $this->orderBy('id', 'desc')
            ->paginate($filter['paginate']);
    }
}
