<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'team_id',
        'is_leader',
    ];

    public $timestamps = false;

    // العلاقة مع الفريق
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
