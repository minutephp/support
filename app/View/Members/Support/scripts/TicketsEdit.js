/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var TicketEditController = (function () {
        function TicketEditController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.findPages = function (title) {
                _this.$scope.data.showSearch = false;
                if (title && title.length > 3) {
                    var keywords = title.split(/\W+/).filter(function (f) { return f.length > 2; }).map(function (f) { return '%' + f + '%'; });
                    var search = { columns: 'keywords', operator: 'LIKE', value: keywords };
                    if (keywords.length > 0) {
                        _this.$scope.pages.setSearch(search).reloadAll(true).then(function () { return _this.$scope.data.showSearch = true; });
                    }
                }
            };
            this.uploaded = function () {
                _this.$ui.toast(_this.gettext('Upload successful. URL added in send box.'));
            };
            this.scroll = function () {
                var ele = angular.element('#scrollBox');
                if (ele.length > 0) {
                    ele.animate({ scrollTop: ele[0].scrollHeight }, 1000);
                }
            };
            this.save = function () {
                var ticket = _this.$scope.ticket;
                _this.$scope.data.msg = _this.browserInfo();
                console.log("this.$scope.data.msg: ", _this.$scope.data.msg);
                ticket.save(_this.gettext('Ticket created')).then(_this.send);
            };
            this.browserInfo = function () {
                var ua = window['detect'].parse(navigator.userAgent);
                var info = _this.gettext("I'm using ") + ua.browser.family + ' (' + ua.browser.version + ') on ' + ua.os.family + ' (' + ua.device.type + ') ';
                if (window['swfobject']) {
                    info += 'with Flash v' + (window['swfobject'].getFlashPlayerVersion() || {})['major'];
                }
                return info;
            };
            this.send = function () {
                var ticket = _this.$scope.ticket;
                if (ticket.attr('state') !== 'open') {
                    ticket.attr('state', 'open').save();
                }
                var reply = ticket.replies.create().attr('reply_safe', _this.$scope.data.msg);
                reply.save(_this.gettext('Ticket updated successfully')).then(_this.scroll);
                _this.$scope.data.msg = '';
            };
            this.close = function () {
                _this.$scope.ticket.attr('state', 'closed').save('Ticket updated').then(function () { return top.location.href = '/members/support'; });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = {
                valid: false,
                categories: {
                    general: this.gettext('General / Technical'), billing: this.gettext('Sales / Billing'), feedback: this.gettext('Site Feedback'),
                    affiliate: this.gettext('Affiliates / JV'), other: this.gettext('Other..')
                }
            };
            $scope.ticket = $scope.tickets[0] || $scope.tickets.create().attr('state', 'open').attr('category', 'general');
            $scope.$watch('ticket.title', function (title) {
                $timeout.cancel($scope.data.lastTimeout);
                $scope.data.lastTimeout = $timeout(function () { return _this.findPages(title); }, 500);
            });
            $timeout(this.scroll);
        }
        return TicketEditController;
    }());
    App.TicketEditController = TicketEditController;
    angular.module('ticketEditApp', ['MinuteFramework', 'MembersApp', 'gettext'])
        .controller('ticketEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TicketEditController]);
})(App || (App = {}));
