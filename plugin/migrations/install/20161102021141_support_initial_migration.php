<?php
use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class SupportInitialMigration extends AbstractMigration
{
    public function change()
    {
        // Automatically created phinx migration commands for tables from database minute

        // Migration for table m_support_blacklists
        $table = $this->table('m_support_blacklists', array('id' => 'support_blacklist_id'));
        $table
            ->addColumn('created_at', 'datetime', array())
            ->addColumn('email', 'string', array('limit' => 255))
            ->addIndex(array('email'), array('unique' => true))
            ->create();


        // Migration for table m_support_replies
        $table = $this->table('m_support_replies', array('id' => 'support_reply_id'));
        $table
            ->addColumn('support_ticket_id', 'integer', array('limit' => 11))
            ->addColumn('user_id', 'integer', array('limit' => 11))
            ->addColumn('created_at', 'datetime', array())
            ->addColumn('reply_safe', 'text', array())
            ->addIndex(array('support_ticket_id'), array())
            ->create();


        // Migration for table m_support_templates
        $table = $this->table('m_support_templates', array('id' => 'support_template_id'));
        $table
            ->addColumn('created_at', 'datetime', array())
            ->addColumn('title', 'string', array('null' => true, 'limit' => 255))
            ->addColumn('keywords', 'string', array('null' => true, 'limit' => 255))
            ->addColumn('reply_safe', 'text', array('null' => true))
            ->addIndex(array('title'), array('unique' => true))
            ->create();


        // Migration for table m_support_tickets
        $table = $this->table('m_support_tickets', array('id' => 'support_ticket_id'));
        $table
            ->addColumn('user_id', 'integer', array('limit' => 11))
            ->addColumn('created_at', 'datetime', array())
            ->addColumn('updated_at', 'datetime', array())
            ->addColumn('title', 'string', array('limit' => 255))
            ->addColumn('category', 'string', array('null' => true, 'limit' => 255))
            ->addColumn('state', 'enum', array('default' => 'open', 'values' => array('open','closed','deferred','spam')))
            ->addColumn('addback_at', 'datetime', array('null' => true))
            ->addIndex(array('user_id'), array())
            ->addIndex(array('state'), array())
            ->create();


    }
}