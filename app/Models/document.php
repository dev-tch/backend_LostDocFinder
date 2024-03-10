<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $primaryKey = 'doc_id';

    protected $fillable = [
        'doc_id',
        'doc_type',
        'doc_description',
        'user_id' /*linked to authentificated used */
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
