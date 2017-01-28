<?php
/**
 * Created by: MinutePHP Framework
 */
namespace App\Model {

    use Minute\Model\ModelEx;

    class MSupportTicket extends ModelEx {
        protected $table      = 'm_support_tickets';
        protected $primaryKey = 'support_ticket_id';
    }
}