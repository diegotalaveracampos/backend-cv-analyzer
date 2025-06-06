<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    protected $table = 'cvs';

    protected $fillable = [
        'original_name',
        'stored_path',
    ];

    protected $appends = [
        'file_url',
    ];

    /**
     * Get the public URL to the stored CV file.
     *
     * @return string
     */
    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->stored_path);
    }
}
