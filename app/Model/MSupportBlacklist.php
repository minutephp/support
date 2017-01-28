<?php
/**
 * Created by: MinutePHP Framework
 */
namespace App\Model {

    use Minute\Model\ModelEx;

    class MSupportBlacklist extends ModelEx {
        protected $table      = 'm_support_blacklists';
        protected $primaryKey = 'support_blacklist_id';
    }
}