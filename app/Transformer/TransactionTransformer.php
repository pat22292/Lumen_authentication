<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;
use App\Transactions;
use Carbon\Carbon;

class TransactionTransformer extends TransformerAbstract{
    function transform(Transactions $transaction){
        return [
            'created_at' => $transaction->created_at->addDays(1)->toDateTimeString(),
            'description' => $transaction->description,
            'quantity' => number_format($transaction->quantity, 2, '.', ''),
            'rate_per_ton' => $transaction->service->rate,
            'total_amount' => number_format($transaction
                              ->unitMeasurement($transaction->service->unit_measurement,  $transaction->quantity)
                              * $transaction->service->rate, 2, '.', ''),
            'remarks' => $transaction->remarks,
            // 'service_category' => $transaction->service->service_name
        ];
    }
}
