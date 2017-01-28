<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 9/10/2016
 * Time: 9:48 PM
 */
namespace App\Controller\Cron {

    use App\Model\MSupportTicket;
    use Carbon\Carbon;

    class DeferredTickets {
        public function addBack() {
            /** @var MSupportTicket $ticket */
            foreach (MSupportTicket::where('state', '=', 'deferred')->where('addback_at', '<', Carbon::now())->get() as $ticket) {
                $ticket->state      = 'open';
                $ticket->addback_at = null;
                $ticket->save();
            }
        }
    }
}