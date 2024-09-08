<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $type_id
 * @property int $partnership_id
 * @property int $user_id
 * @property string $description
 * @property Carbon $date
 * @property string $address
 * @property float $amount
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Order extends Model
{
    use HasFactory;

    public function orderWorker(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class, 'order_worker', 'order_id', 'worker_id');
    }
}
