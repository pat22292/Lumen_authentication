<?php

namespace App\Http\Controllers;

use App\User;
use App\Transations;
use App\Transformer\TransactionTransformer;
use App\Repository\TransationsRepository;
use Laravel\Passport\Bridge\TransactionRepository;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Hash;


class TransactionController extends Controller
{
   use Helpers;
    
    protected $transactionRepository;
    protected $transactionTransformer;



    public function __construct(TransationsRepository $transactionRepository,TransactionTransformer $transactionTransformer){
        $this->transactionRepository = $transactionRepository;
        $this->transactionTransformer = $transactionTransformer;
    }

     public function show(){
        $transaction = $this->transactionRepository->getAll();
        $response = $this->response->collection($transaction, $this->transactionTransformer);
        return $response;
    }

}
