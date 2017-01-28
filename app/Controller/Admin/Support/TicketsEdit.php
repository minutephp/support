<?php
/**
 * Created by: MinutePHP framework
 */
namespace App\Controller\Admin\Support {

    use App\Controller\Generic\DefaultPostHandler;
    use App\Model\MSupportReply;
    use App\Model\MSupportTicket;
    use Minute\Event\Dispatcher;
    use Minute\Event\SupportEvent;
    use Minute\Routing\RouteEx;
    use Minute\View\Helper;
    use Minute\View\View;

    class TicketsEdit {
        /**
         * @var DefaultPostHandler
         */
        private $postHandler;
        /**
         * @var Dispatcher
         */
        private $dispatcher;

        /**
         * TicketsEdit constructor.
         *
         * @param DefaultPostHandler $postHandler
         * @param Dispatcher $dispatcher
         */
        public function __construct(DefaultPostHandler $postHandler, Dispatcher $dispatcher) {
            $this->postHandler = $postHandler;
            $this->dispatcher  = $dispatcher;
        }

        public function index(string $_mode, array $_models, RouteEx $_route, array $_parents, string $alias) {
            $return = $this->postHandler->index($_mode, $_models, $_route, $_parents, $alias);
            $model  = $_models[0];

            if ($model instanceof MSupportTicket) {
                $eventName  = 'admin.support.' . 'status';
                $ticketData = $model->attributesToArray();
            } elseif ($model instanceof MSupportReply) {
                $eventName = 'admin.support.' . 'reply';
                /** @var MSupportTicket $ticket */
                if ($ticket = MSupportTicket::find($model->support_ticket_id)) {
                    $ticketData = array_merge($model->attributesToArray(), $ticket->attributesToArray());
                }
            }

            if (!empty($eventName) && !empty($ticketData)) {
                $this->dispatcher->fire($eventName, new SupportEvent($model->user_id, $ticketData));
            }

            return $return;
        }
    }
}