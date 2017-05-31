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
                'support' => ['title' => 'Support', 'icon' => 'fa-help', 'priority' => 3],
                'admin-support-desk' => ['title' => 'Support desk', 'icon' => 'fa-ticket', 'priority' => 1, 'href' => '/admin/support/tickets', 'parent' => 'support'],
                'admin-support-pages' => ['title' => 'Support pages', 'icon' => 'fa-book', 'priority' => 2, 'href' => '/admin/support/pages', 'parent' => 'support'],
            ];

            $event->addContent($links);
        }

        public function memberLinks(ImportEvent $event) {
            $links = [
                'member-support' => ['title' => "Help & Support", 'icon' => 'fa-life-buoy', 'priority' => 80],
                'member-support-desk' => ['title' => "Support desk", 'icon' => 'fa-question-circle', 'priority' => 1, 'parent' => 'member-support', 'href' => '/members/support'],
                'member-support-pages' => ['title' => "Knowledge base", 'icon' => 'fa-book', 'priority' => 2, 'parent' => 'member-support', 'href' => '/members/kb'],
            ];

            $event->addContent($links);
        }
    }
}