<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Database\Factories\HelpTicketFactory;
use Modules\Main\Entities\User\User;

class HelpTicket extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'title', 'ticket_priority_id', 'ticket_department_id', 'webinar_id'
    ];

    /**
     * Priority
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {

        return $this->belongsTo(TicketPriority::class, 'ticket_priority_id');
    }

    /**
     * Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {

        return $this->belongsTo(TicketDepartment::class, 'ticket_department_id');
    }

    /**
     * User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo(User::class);
    }

    /**
     * Ticket messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {

        return $this->hasMany(TicketMessage::class);
    }

    /**
     * Get all included agents in a ticket
     *
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function agents()
    {

        $agents = $this->messages()
            ->with('admin')
            ->whereNotNull('admin_id')
            ->select('admin_id')
            ->distinct()
            ->get();

        return $agents;
    }

    /**
     * Get all included contacts ticket
     *
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function contacts()
    {

        $agents = $this->agents()->map(function ($agent) {

            return $agent->admin;
        });

        $contacts = [];

        foreach ($agents as $agent) {

            $contacts[] = $agent;
        }

        $contacts[] = $this->user;

        return $contacts;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return HelpTicketFactory::new();
    }
}
