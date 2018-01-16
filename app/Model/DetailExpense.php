<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailExpense extends Model
{
    //
    public function expense()
    {
        return $this->belongsTo('App\Model\Expense'); 
    }
}
