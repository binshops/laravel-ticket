<?php

namespace Binshops\LaravelTicket\Models;

use Illuminate\Database\Eloquent\Model;
use Binshops\LaravelTicket\Traits\ContentEllipse;
use Binshops\LaravelTicket\Traits\Purifiable;

class Comment extends Model
{
    use ContentEllipse;
    use Purifiable;

    protected $table = 'laravelticket_comments';

    /**
     * Get related ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('Binshops\LaravelTicket\Models\Ticket', 'ticket_id');
    }

    /**
     * Get comment owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }
}
