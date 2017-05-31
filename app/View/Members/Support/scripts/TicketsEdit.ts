/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class TicketEditController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {
                valid: false,
                categories: {
                    general: this.gettext('General / Technical'), billing: this.gettext('Sales / Billing'), feedback: this.gettext('Site Feedback'),
                    affiliate: this.gettext('Affiliates / JV'), other: this.gettext('Other..')
                }
            };

            $scope.ticket = $scope.tickets[0] || $scope.tickets.create().attr('state', 'open').attr('category', 'general');

            $scope.$watch('ticket.title', (title) => {
                $timeout.cancel($scope.data.lastTimeout);
                $scope.data.lastTimeout = $timeout(() => this.findPages(title), 500);
            });

            $timeout(this.scroll);
        }

        findPages = (title) => {
            this.$scope.data.showSearch = false;

            if (title && title.length > 3) {
                let keywords = title.split(/\W+/).filter((f) => f.length > 2).map((f) => '%' + f + '%');
                let search = {columns: 'name,description,keywords', operator: 'LIKE', value: keywords};

                if (keywords.length > 0) {
                    console.log("this.$scope.pages: ", this.$scope.pages);
                    this.$scope.pages.setSearch(search).then(() => this.$scope.data.showSearch = true);
                }
            }
        };

        uploaded = () => {
            this.$ui.toast(this.gettext('Upload successful. URL added in send box.'));
        };

        scroll = () => {
            let ele = angular.element('#scrollBox');
            if (ele.length > 0) {
                ele.animate({scrollTop: ele[0].scrollHeight}, 1000);
            }
        };

        save = () => {
            this.$scope.session.checkRegistration().then(() => {
                let ticket = this.$scope.ticket;
                this.$scope.data.msg = this.browserInfo();
                //console.log("this.$scope.data.msg: ", this.$scope.data.msg);
                ticket.save(this.gettext('Ticket created')).then(this.send);
            });
        };

        browserInfo = () => {
            var ua = window['detect'].parse(navigator.userAgent);
            var info = this.gettext("I'm using ") + ua.browser.family + ' (' + ua.browser.version + ') on ' + ua.os.family + ' (' + ua.device.type + ') ';

            if (window['swfobject']) {
                info += 'with Flash v' + (window['swfobject'].getFlashPlayerVersion() || {})['major'];
            }

            return info;
        };

        send = () => {
            let ticket = this.$scope.ticket;
            if (ticket.attr('state') !== 'open') {
                ticket.attr('state', 'open').save();
            }

            let reply = ticket.replies.create().attr('reply_safe', this.$scope.data.msg);
            reply.save(this.gettext('Ticket updated successfully')).then(this.scroll);
            this.$scope.data.msg = '';
        };

        close = () => {
            this.$scope.ticket.attr('state', 'closed').save('Ticket updated').then(() => top.location.href = '/members/support');
        };
    }

    angular.module('ticketEditApp', ['MinuteFramework', 'MembersApp', 'gettext'])
        .controller('ticketEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TicketEditController]);
}
