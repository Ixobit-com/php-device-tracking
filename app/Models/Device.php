<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    use HasFactory;

    /**
     * Types of devices (int to string).
     *
     * @var string[]
     */
    public const TYPES = [
        1 => 'Smartphone',
        2 => 'Tablet',
        3 => 'Peripherals',
        4 => 'Other',
    ];

    /**
     * Types of statuses (int to string).
     *
     * @var string[]
     */
    public const STATUSES = [
        1 => 'Free',
        2 => 'Busy',
        3 => 'Inactive',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
        'model',
        'status',
        'location',
        'user_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Automatic status detection when the user is defined or not.
     */
    public function setUserIdAttribute($value): void
    {
        $this->attributes['user_id'] = $value;
        if ($this->attributes['status'] === array_search('Inactive', self::STATUSES)) {
            return;
        }
        $this->attributes['status'] = ! empty($value) ? array_search('Busy', self::STATUSES) :
            array_search('Free', self::STATUSES);
    }

    /**
     * Search device by name, type, status, belonging
     * @param string $search
     * @param int|null $selectedType
     * @param int|null $selectedStatus
     * @param bool $onlyMine
     * @return Builder
     */
    public static function search(string $search, ?int $selectedType, ?int $selectedStatus, bool $onlyMine = false): Builder
    {
        $query = static::query();

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('model', 'like', '%'.$search.'%')
                    ->orWhere('location', 'like', '%'.$search.'%')
                    ->orWhereHas('user', function (Builder $query) use ($search) {
                        $query->where('email', 'like', '%'.$search.'%');
                    });
            });
        }

        if ($selectedType) {
            $query->where('type', $selectedType);
        }

        if ($selectedStatus) {
            $query->where('status', $selectedStatus);
        }

        if ($onlyMine) {
            $query->whereHas('user', function (Builder $query) {
                $query->where('id', '=', auth()->user()->id);
            });
        }

        return $query;
    }
}
