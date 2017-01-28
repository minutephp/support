<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:57 PM
 */
namespace Minute\Panel {

    use App\Model\MSupportTicket;
    use Minute\Event\ImportEvent;

    class SupportPanel {
        public function adminDashboardPanel(ImportEvent $event) {
            $count = MSupportTicket::where('state', '=', 'open')->count();
            $panels = [['type' => 'site', 'title' => 'Support', 'stats' => "$count open", 'icon' => 'fa-life-bouy', 'priority' => 3, 'href' => '/admin/support/tickets/open',
                        'cta' => 'View tickets..']];

            $event->addContent($panels);
        }
    }
}