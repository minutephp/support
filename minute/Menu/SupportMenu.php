<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:57 PM
 */
namespace Minute\Menu {

    use Minute\Event\ImportEvent;

    class SupportMenu {
        public function adminLinks(ImportEvent $event) {
            $links = [
                'support' => ['title' => 'Support desk', 'icon' => 'fa-ticket', 'priority' => 3, 'href' => '/admin/support/tickets'],
            ];

            $event->addContent($links);
        }

        public function memberLinks(ImportEvent $event) {
            $links = [
                'member-support' => ['title' => "Help & Support", 'icon' => 'fa-life-buoy', 'priority' => 80],
                'member-support-desk' => ['title' => "Support desk", 'icon' => 'fa-question-circle', 'priority' => 1, 'parent' => 'member-support', 'href' => '/members/support'],
            ];

            $event->addContent($links);
        }
    }
}