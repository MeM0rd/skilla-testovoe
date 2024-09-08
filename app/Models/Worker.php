<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Модель Worker (Таблица исполнителей)
 *
 * @property int $id
 * @property string $name
 * @property string $second_name
 * @property string $surname
 * @property string $phone
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Worker extends Model
{
    use HasFactory;

    public  function excludedOrderTypes(): BelongsToMany
    {
        return $this->belongsToMany(OrderType::class, 'workers_ex_order_types', 'worker_id', 'order_type_id');
    }
}
