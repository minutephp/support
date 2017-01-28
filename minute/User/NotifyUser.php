<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 9/11/2016
 * Time: 7:29 AM
 */
namespace Minute\User {

    use Minute\Crypto\Blowfish;
    use Minute\Event\Dispatcher;
    use Minute\Event\SupportEvent;

    class NotifyUser {
        /**
         * @var Dispatcher
         */
        private $dispatcher;
        /**
         * @var Blowfish
         */
        private $blowfish;
        /**
         * NotifyUser constructor.
         *
         * @param Dispatcher $dispatcher
         * @param Blowfish $blowfish
         */
        public function __construct(Dispatcher $dispatcher, Blowfish $blowfish) {
            $this->dispatcher = $dispatcher;
            $this->blowfish   = $blowfish;
        }

        public function sendEmail(SupportEvent $event) {
            $data = $event->getUserData();

            if ($ticket_id = $data['support_ticket_id'] ?? null) {
                $data['reference'] = $this->blowfish->encrypt('T' . $ticket_id);
                $event->setUserData($data);
            }

            $this->dispatcher->fire("user.send.email", $event); //we don't know if mail module is installed
        }
    }
}