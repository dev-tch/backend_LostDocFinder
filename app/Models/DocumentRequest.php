<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc_id',
        'doc_type',
        'req_type',
        'req_description',
        'req_status',
        'user_id' /*linked to authentificated used */
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
