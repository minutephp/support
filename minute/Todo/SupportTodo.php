<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 11/5/2016
 * Time: 11:04 AM
 */
namespace Minute\Todo {

    use App\Model\MPage;
    use Minute\Config\Config;
    use Minute\Event\ImportEvent;

    class SupportTodo {
        /**
         * @var TodoMaker
         */
        private $todoMaker;
        /**
         * @var Config
         */
        private $config;

        /**
         * MailerTodo constructor.
         *
         * @param TodoMaker $todoMaker - This class is only called by TodoEvent (so we assume TodoMaker is be available)
         * @param Config $config
         */
        public function __construct(TodoMaker $todoMaker, Config $config) {
            $this->todoMaker = $todoMaker;
            $this->config    = $config;
        }

        public function getTodoList(ImportEvent $event) {
            $todos[] = ['name' => 'Setup Gmail integration for support desk', 'description' => 'Allows members to update support tickets via email',
                        'status' => $this->config->get('google/gmail/auth/token/access_token') ? 'complete' : 'incomplete', 'link' => '/admin/gmail/setup'];
            $todos[] = ['name' => 'Create "support" pages', 'description' => 'Create pages with page type as "support"',
                        'status' => MPage::where('type', '=', 'support')->where('enabled', '=', 'true')->count() ? 'complete' : 'incomplete', 'link' => '/admin/pages'];

            $event->addContent(['Support' => $todos]);
        }
    }
}