<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function BusOperator() : BelongsTo {
        return $this->belongsTo(BusOperator::class);
    }

    public function BusClass() : BelongsTo {
        return $this->belongsTo(BusClass::class);
    }

    public function toDestination() : BelongsTo {
        return $this->belongsTo(Destination::class,'to_destination_id','id');
    }
    public function fromDestination() : BelongsTo {
        return $this->belongsTo(Destination::class,'from_destination_id','id');
    }
}
