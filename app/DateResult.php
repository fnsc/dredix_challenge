<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateResult extends Model
{
    protected $fillable = ['date_1', 'date_2', 'result'];

    /**
     *
     */
    public function search(array $filter)
    {
        return $this->orderBy('id', 'desc')
            ->paginate($filter['paginate']);
    }
}
