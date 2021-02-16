<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Admin;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TicketMessage extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        SoftDeletes;

    protected $fillable = [
        'body', 'admin_id'
    ];

    /**
     * get the main ticket for this message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {

        return $this->belongsTo(HelpTicket::class);
    }

    /**
     * Admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {

        return $this->belongsTo(Admin::class);
    }

    public function scopeAgentUnreadMessages($query)
    {

        return $query->where([
            'is_read' => 0,
            'admin_id' => null
        ]);
    }

    public function getfilesAttribute()
    {

        return $this->getMedia();
    }
}
