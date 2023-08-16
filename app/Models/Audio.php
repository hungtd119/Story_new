<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Audio extends Model
{
    use HasFactory;
    protected $table = "audios";
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id','filename','path','time','text_id'];
    protected $hidden = ['text_id'];
    public function text ():BelongsTo{
        return $this->belongsTo(Text::class,'text_id');
    }
}
