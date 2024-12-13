<?php
// لإدارة الفرق
/**
 * Team Model
 * 
 * - يمثل بيانات الفرق (Teams) في قاعدة البيانات.
 * 
 */

 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 
 class Team extends Model
 {
     use HasFactory;
 
     protected $table = 'teams';
 
     protected $fillable = [
         'team_name',
         'team_id',
         'leader_id',
         'status',  // إضافة status هنا
     ];
 
     public $timestamps = true;
 
     // العلاقة مع القائد
     public function leader()
     {
         return $this->belongsTo(Participant::class, 'leader_id');
     }
 
     // العلاقة مع الأعضاء
     public function participants()
     {
         return $this->hasMany(Participant::class, 'team_id');
     }
 
     // الحصول على القيم الممكنة للـ status
     public static function getStatuses()
     {
         return ['pending', 'accepted', 'refused'];
     }
 }
 
