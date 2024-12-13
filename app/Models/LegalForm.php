<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_legal',
        'sub_judul',
        'file_path',
        'status',
        'dibuat_oleh',
    ];
}
