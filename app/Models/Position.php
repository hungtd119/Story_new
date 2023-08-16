<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id','position_x','position_y','width','height','interaction_id','text_id'];
    protected $hidden = ['interaction_id','text_id'];
    public function interactions () : BelongsTo{
        return $this->belongsTo(Interaction::class,'interaction_id');
    }
    public function text () : BelongsTo{
        return $this->belongsTo(Text::class);
    }
}
