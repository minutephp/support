<?php

use Phinx\Migration\AbstractMigration;

class SupportSeedData extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {



		$this->execute('insert ignore into `m_notices` (`name`, `title`, `icon`, `description`, `links_json`, `class`, `plugin`) values (\'support_ticket_reply\', \'Support ticket \\"{title}\\" was updated\', \'fa-ticket\', \'A new reply was made to your support ticket. Please click the view ticket button to see the updates.\', \'[{\\"label\\":\\"view ticket\\",\\"href\\":\\"/members/support/tickets/edit/{support_ticket_id}\\",\\"icon\\":\\"fa-eye\\"}]\', \'danger\', \'support\')');
		$this->execute('insert ignore into `m_notices` (`name`, `title`, `icon`, `description`, `links_json`, `class`, `plugin`) values (\'support_ticket_status\', \'Support ticket \\"{title}\\": {state}\', \'fa-ticket\', \'The status of your support ticket is now {state}\', \'[{\\"label\\":\\"view ticket\\",\\"href\\":\\"/members/support/tickets/edit/{support_ticket_id}\\",\\"icon\\":\\"fa-eye\\"}]\', \'danger\', \'support\')');

    }
}