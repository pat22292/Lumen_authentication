<?php

namespace App\Repository;

use App\Transactions;
use Illuminate\Support\Facades\Hash;


class TransationsRepository
{
    public function getAll(){
        $transactions = Transactions::all();
        return $transactions;
    }
}
