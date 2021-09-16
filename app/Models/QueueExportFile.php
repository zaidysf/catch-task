<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueExportFile extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'processed_date',
        'file_url',
        'status',
        'csvlint_url'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'processed_date' => 'datetime',
    ];

    /**
     * Get the file's status name.
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case 1:
                return 'success';
                break;

            default:
                return 'failed';
                break;
        }
    }
}
