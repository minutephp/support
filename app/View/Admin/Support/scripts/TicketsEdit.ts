/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module Admin {
    export class TicketEditController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.ticket = $scope.tickets[0];
            $scope.data = {};
        }

        showTemplates = () => {
            this.$ui.popupUrl('/templates-popup.html', false, null, {ctrl: this});
        };

        saveAsPage = () => {
            let ticket = this.$scope.ticket;
            let title = ticket.title;
            let reply = ticket.replies[0].attr('reply_safe');
            let html = `## ${title}\n\n${reply}`;
            let page = this.$scope.pages.create().attr('name', title).attr('html', html).attr('enabled', 'true');

            this.$ui.popupUrl('/support-page-popup.html', false, null, {ctrl: this, page: page}).then((page) => {
                if (page && (page instanceof Minute.Item)) {

                    page.save(this.gettext('Support page created.')).then((result) => {
                        let url = '/admin/support/pages/edit/' + result.item.attr('support_page_id');
                        let text = this.gettext('Click here to edit page');
                        this.$ui.toast(`<a href="${url}" target="_blank"><i class="fa fa-external-link"></i> ${text}</a>`, '', true, 0);
                        window.open(url, '_blank');
                    });
                }
            });
        };

        slugify = (Text) => {
            return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        };

        insertTemplate = (template) => {
            this.$scope.data.msg = template.attr('reply_safe');
            this.$ui.closePopup();
            this.$ui.toast(this.gettext('Template reply added in send box.'));
        };

        uploaded = () => {
            this.$ui.toast(this.gettext('Upload successful. URL added in send box.'));
        };

        send = () => {
            let ticket = this.$scope.ticket;

            if (ticket.attr('state') !== 'open') {
                ticket.attr('state', 'open').save();
            }

            let reply = ticket.replies.create().attr('reply_safe', this.$scope.data.msg);
            reply.save(this.gettext('Ticket updated successfully'));
            this.$scope.data.msg = '';
        };

        close = () => {
            this.$scope.ticket.attr('state', 'closed').save('Ticket updated').then(() => top.location.href = '/admin/support/tickets');
        };
    }

    angular.module('ticketEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('ticketEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TicketEditController]);
}
