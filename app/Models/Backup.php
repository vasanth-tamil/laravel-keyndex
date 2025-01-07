<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'file_size',
        'checksum',
        'backup_at',

        // REFERENCES
        'created_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'backup_at' => 'datetime',
    ];

    protected $appends = ['size_in_mb'];

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function getSizeInMBAttribute()
    {
        return round($this->file_size / 1024 / 1024, 2);
    }
}
