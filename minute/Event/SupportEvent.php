<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 9/9/2016
 * Time: 12:16 PM
 */
namespace Minute\Event {

    class SupportEvent extends UserEvent {
        const USER_SUPPORT_CREATED = "user.support.created";
        const USER_SUPPORT_REPLY   = "user.support.reply";
        const USER_SUPPORT_UPDATED = "user.support.status";

        const ADMIN_SUPPORT_REPLY  = "admin.support.reply";
        const ADMIN_SUPPORT_STATUS = "admin.support.status";
    }
}