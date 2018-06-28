<?php

namespace App;

// use App\Services;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Dusterio\LumenPassport\LumenPassport;


class Transaction extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='finishtask';

    

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function service () {
        // return Services::where('id',$this->service_category)->first()->service_name;
        return $this->belongsTo('App\Service','service_category', 'id');
    }
    
    public function unitMeasurement ($meas, $quant) {
        if ($meas == 'Tons') {
            $total = $quant/1000;
            return $total;
        }
        else {
            return $quant;
        }
    }
}
