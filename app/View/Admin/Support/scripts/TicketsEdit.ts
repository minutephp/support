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
            this.$ui.prompt(this.gettext('Enter new page slug'), '/faq/' + this.slugify(this.$scope.ticket.title)).then(
                (slug) => {
                    this.$scope.pages.create().attr('name', this.$scope.ticket.title).attr('slug', slug).attr('type', 'support').save(this.gettext('Support page created.')).then((result) => {
                        let url = '/admin/pages/edit/' + result.item.attr('page_id');
                        let text = this.gettext('Click here to edit page');
                        this.$ui.toast(`<a href="${url}" target="_blank"><i class="fa fa-external-link"></i> ${text}</a>`, '', true, 0);
                        window.open(url, '_blank');
                    });
                }
            );
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
