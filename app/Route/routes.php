<?php

/** @var Router $router */
use Minute\Model\Permission;
use Minute\Routing\Router;

$router->get('/members/support', null, true, 'm_support_tickets[5] as tickets ORDER by created_at DESC', 'm_support_replies[tickets.support_ticket_id] as reply ORDER by created_at DESC', 'users[reply.user_id] as user')
       ->setReadPermission('tickets', Permission::SAME_USER)->setDefault('tickets', '*');
$router->post('/members/support', null, true, 'm_support_tickets as tickets')
       ->setAllPermissions('tickets', Permission::SAME_USER);

$router->get('/members/support/tickets/edit/{support_ticket_id}', 'Members/Support/TicketsEdit', true, 'm_support_tickets[support_ticket_id] as tickets',
    'm_support_replies[tickets.support_ticket_id][15] as replies ORDER by created_at DESC', 'users[replies.user_id] as user', 'm_support_pages[2] as pages')
       ->setReadPermission('tickets', Permission::SAME_USER)->setDefault('support_ticket_id', '0')
       ->setReadPermission('pages', Permission::EVERYONE)->setDefault('pages', '*');

$router->post('/members/support/tickets/edit/{support_ticket_id}', null, true, 'm_support_tickets as tickets', 'm_support_replies[support_ticket_id, reply_safe] as replies')
       ->setAllPermissions('tickets', Permission::SAME_USER)->setAllPermissions('replies', Permission::SAME_USER)->setDefault('support_ticket_id', '0');

$router->get('/admin/support/tickets/{state}', null, 'admin', 'm_support_tickets[state][5] as tickets ORDER by created_at DESC', 'm_support_replies[tickets.support_ticket_id] as reply ORDER by created_at DESC',
    'users[tickets.user_id] as user', 'm_user_groups[tickets.user_id] as group ORDER BY user_group_id DESC')
       ->setReadPermission('tickets', 'admin')->setDefault('state', 'open');
$router->post('/admin/support/tickets/{state}', null, 'admin', 'm_support_tickets as tickets', 'm_support_replies as replies')
       ->setAllPermissions('tickets', 'admin')->setDefault('state', 'open')->setDeleteCascade('tickets', ['replies']);

$router->get('/admin/support/tickets/edit/{support_ticket_id}', null, 'admin', 'm_support_tickets[support_ticket_id][5] as tickets',
    'm_support_replies[tickets.support_ticket_id][15] as replies ORDER by created_at DESC', 'users[tickets.user_id] as creator', 'm_user_groups[creator.user_id][5] as groups',
    'users[replies.user_id] as user', 'm_support_templates[5] as templates ORDER BY created_at DESC', 'm_support_pages[1] as pages')
       ->setReadPermission('tickets', 'admin')->setReadPermission('templates', 'admin')->setReadPermission('pages', 'admin')
       ->setDefault('templates', '*');
$router->post('/admin/support/tickets/edit/{support_ticket_id}', 'Admin/Support/TicketsEdit', 'admin', 'm_support_tickets as tickets', 'm_support_replies as replies',
    'm_support_templates as templates', 'm_support_pages as pages')
       ->setAllPermissions('tickets', 'admin')->setAllPermissions('replies', 'admin')->setAllPermissions('templates', 'admin')->setAllPermissions('pages', 'admin');

$router->get('/admin/support-templates', null, 'admin', 'm_support_templates[5] as templates')
       ->setReadPermission('templates', 'admin')->setDefault('templates', '*');
$router->post('/admin/support-templates', null, 'admin', 'm_support_templates as templates')
       ->setAllPermissions('templates', 'admin');

$router->get('/admin/support-templates/edit/{support_template_id}', null, 'admin', 'm_support_templates[support_template_id] as templates')
       ->setReadPermission('templates', 'admin')->setDefault('support_template_id', '0');
$router->post('/admin/support-templates/edit/{support_template_id}', null, 'admin', 'm_support_templates as templates')
       ->setAllPermissions('templates', 'admin')->setDefault('support_template_id', '0');

$router->get('/admin/support/pages', null, 'admin', 'm_support_pages[5] as pages')
       ->setReadPermission('pages', 'admin')->setDefault('pages', '*');
$router->post('/admin/support/pages', null, 'admin', 'm_support_pages as pages')
       ->setAllPermissions('pages', 'admin');

$router->get('/admin/support/pages/edit/{support_page_id}', null, 'admin', 'm_support_pages[support_page_id] as pages')
       ->setReadPermission('pages', 'admin')->setDefault('support_page_id', '0');
$router->post('/admin/support/pages/edit/{support_page_id}', null, 'admin', 'm_support_pages as pages')
       ->setAllPermissions('pages', 'admin')->setDefault('support_page_id', '0');

$router->get('/members/kb', null, true, 'm_support_pages[5] as pages')
       ->setReadPermission('pages', Permission::EVERYONE)->setDefault('pages', '*');

$router->get('/members/kb/view/{support_page_id}', 'Members/Kb/View', true, 'm_support_pages[support_page_id][1] as pages')
       ->setReadPermission('pages', Permission::EVERYONE);
