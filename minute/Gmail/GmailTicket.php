<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 10/11/2016
 * Time: 5:03 AM
 */
namespace Minute\Gmail {

    use App\Model\MSupportReply;
    use App\Model\MSupportTicket;
    use App\Model\User;
    use Carbon\Carbon;
    use Minute\Event\Dispatcher;
    use Minute\Event\GmailEvent;
    use Minute\Event\UserSignupEvent;

    class GmailTicket {
        /**
         * @var Dispatcher
         */
        private $dispatcher;

        /**
         * GmailTicket constructor.
         *
         * @param Dispatcher $dispatcher
         */
        public function __construct(Dispatcher $dispatcher) {
            $this->dispatcher = $dispatcher;
        }

        public function parse(GmailEvent $event) {
            if (!$event->isHandled()) {
                MSupportTicket::unguard();
                MSupportReply::unguard();

                $info = $event->getFrom();
                $now  = Carbon::now();

                if ($email = $info['email'] ?? null) {
                    $user = User::where('email', '=', $email)->orWhere('contact_email', '=', $email)->first();

                    if (empty($user) || empty($user->user_id)) {
                        $signup = new UserSignupEvent(array_merge($info, ['verified' => 'true']));
                        $this->dispatcher->fire(UserSignupEvent::USER_SIGNUP_BEGIN, $signup);
                        $user = $signup->getUser();
                    }

                    if (preg_match('/^T(\d+)$/', $event->getRef(), $matches)) {
                        $ticket = MSupportTicket::find($matches[1]);
                    }

                    if (empty($ticket) || empty($ticket->ticket_id)) {
                        $ticket = MSupportTicket::where('user_id', '=', $user->user_id)->where('title', '=', $event->getSubject())->first();

                        if (empty($ticket) || empty($ticket->support_ticket_id)) {
                            $ticket = MSupportTicket::create(['user_id' => $user->user_id, 'created_at' => $now, 'updated_at' => $now, 'title' => $event->getSubject(), 'category' => 'General',
                                                              'state' => 'open']);
                        }
                    }

                    /** @var MSupportReply $reply */
                    $reply = MSupportReply::create(['support_ticket_id' => $ticket->support_ticket_id, 'user_id' => $user->user_id, 'created_at' => $now, 'reply_safe' => $event->getText()]);
                    $event->setHandled($reply->support_reply_id > 0);
                }
            }
        }
    }
}