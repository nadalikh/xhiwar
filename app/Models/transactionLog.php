<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionLog extends Model
{
    use HasFactory;
    public $table = "gateway_transactions_logs";
}
