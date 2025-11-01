<?php

namespace Helpz\ServiceRequest\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Helpz\Device\Models\Device;
use Helpz\ServiceRequest\Enums\ServiceRequestStatusType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'device_id',
        'status'
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'status' => ServiceRequestStatusType::class
        ];
    }
}
