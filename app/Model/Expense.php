<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    public function ScopeSearch($query, $search, $type)
    {
    	if(isset($type)){
    		if($type=='fecha'){
    			list($d,$m,$y)=explode('-',$search);
    			$newDate=$y.'-'.$m.'-'.$d;
	            $query->where($type,$newDate);
	        }else{
	        	$query->where($type, 'like','%'.$search.'%');
	        }
        }
    }

    public function DetailExpense()
    {
        return $this->hasMany('App\Model\DetailExpense'); 
    }
}
