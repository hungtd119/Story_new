<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Position extends Model
{

    public $_NAME = 'Position';
    public $_ID = 'id';
    public $_POSITION_X = 'position_x';
    public $_POSITION_Y = 'position_y';
    public $_WIDTH = 'width';
    public $_HEIGHT = 'height';
    public $_IS_DRAGGING = 'isDragging';
    public $_IS_RESIZING = 'isResizing';
    public $_RESIZE_DIRECT = 'resizeDirect';
    public $_DRAG_START_X = 'dragStartX';
    public $_DRAG_START_Y = 'dragStartY';
    public $_INTERACTION_ID = 'interaction_id';

    use HasFactory;
    public $table = 'positions';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['id', 'position_x', 'position_y', 'width', 'height', 'isDragging', 'isResizing', 'resizeDirect', 'dragStartX', 'dragStartY', 'interaction_id'];
    public function interactions(): BelongsTo
    {
        return $this->belongsTo(Interaction::class, 'interaction_id');
    }
}
