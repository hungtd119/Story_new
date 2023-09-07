<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Text extends Model
{
    public $_NAME = 'Text';
    public $_ID = 'id';
    public $_TEXT = 'text';
    public $_ICON = 'icon';
    public $_WORD_SYNC = 'wordSync';

    use HasFactory;
    public $table = 'texts';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id', 'text', 'icon', 'wordSync'];
    // protected $hidden = ['audio_id', 'pivot'];
    public function audio(): HasOne
    {
        return $this->hasOne(Audio::class);
    }
    public function interaction(): HasOne
    {
        return $this->hasOne(Interaction::class);
    }
    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'text_config', 'text_id');
    }
    public  function position(): HasOne
    {
        return $this->hasOne(Position::class);
    }
}
