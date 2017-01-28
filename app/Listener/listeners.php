<?php

/** @var Binding $binding */
use Minute\Event\AdminEvent;
use Minute\Event\Binding;
use Minute\Event\GmailEvent;
use Minute\Event\MemberEvent;
use Minute\Event\SupportEvent;
use Minute\Event\TodoEvent;
use Minute\Gmail\GmailTicket;
use Minute\Menu\SupportMenu;
use Minute\Panel\SupportPanel;
use Minute\Todo\SupportTodo;
use Minute\User\NotifyUser;

$binding->addMultiple([
    //support
    ['event' => AdminEvent::IMPORT_ADMIN_MENU_LINKS, 'handler' => [SupportMenu::class, 'adminLinks']],
    ['event' => AdminEvent::IMPORT_ADMIN_DASHBOARD_PANELS, 'handler' => [SupportPanel::class, 'adminDashboardPanel']],
    ['event' => MemberEvent::IMPORT_MEMBERS_SIDEBAR_LINKS, 'handler' => [SupportMenu::class, 'memberLinks']],

    //notify
    ['event' => SupportEvent::ADMIN_SUPPORT_REPLY, 'handler' => [NotifyUser::class, 'sendEmail'], 'data' => 'user_support_reply'],

    //mail
    ['event' => GmailEvent::GMAIL_NEW_EMAIL, 'handler' => [GmailTicket::class, 'parse'], 'priority' => -1],

    //tasks
    ['event' => TodoEvent::IMPORT_TODO_ADMIN, 'handler' => [SupportTodo::class, 'getTodoList']],
]);