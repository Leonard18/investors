<?php

namespace App\Listeners;

use App\Events\StatusUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTransactionStatus
{
    /**
     * Create the event listener...
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StatusUpdate  $event
     * @return void
     */
    public function handle(StatusUpdate $event)
    {
        dd($event);
    }
}
