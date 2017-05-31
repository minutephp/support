/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var TicketEditController = (function () {
        function TicketEditController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.showTemplates = function () {
                _this.$ui.popupUrl('/templates-popup.html', false, null, { ctrl: _this });
            };
            this.saveAsPage = function () {
                var ticket = _this.$scope.ticket;
                var title = ticket.title;
                var reply = ticket.replies[0].attr('reply_safe');
                var html = "## " + title + "\n\n" + reply;
                var page = _this.$scope.pages.create().attr('name', title).attr('html', html).attr('enabled', 'true');
                _this.$ui.popupUrl('/support-page-popup.html', false, null, { ctrl: _this, page: page }).then(function (page) {
                    if (page && (page instanceof Minute.Item)) {
                        page.save(_this.gettext('Support page created.')).then(function (result) {
                            var url = '/admin/support/pages/edit/' + result.item.attr('support_page_id');
                            var text = _this.gettext('Click here to edit page');
                            _this.$ui.toast("<a href=\"" + url + "\" target=\"_blank\"><i class=\"fa fa-external-link\"></i> " + text + "</a>", '', true, 0);
                            window.open(url, '_blank');
                        });
                    }
                });
            };
            this.slugify = function (Text) {
                return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            };
            this.insertTemplate = function (template) {
                _this.$scope.data.msg = template.attr('reply_safe');
                _this.$ui.closePopup();
                _this.$ui.toast(_this.gettext('Template reply added in send box.'));
            };
            this.uploaded = function () {
                _this.$ui.toast(_this.gettext('Upload successful. URL added in send box.'));
            };
            this.send = function () {
                var ticket = _this.$scope.ticket;
                if (ticket.attr('state') !== 'open') {
                    ticket.attr('state', 'open').save();
                }
                var reply = ticket.replies.create().attr('reply_safe', _this.$scope.data.msg);
                reply.save(_this.gettext('Ticket updated successfully'));
                _this.$scope.data.msg = '';
            };
            this.close = function () {
                _this.$scope.ticket.attr('state', 'closed').save('Ticket updated').then(function () { return top.location.href = '/admin/support/tickets'; });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.ticket = $scope.tickets[0];
            $scope.data = {};
        }
        return TicketEditController;
    }());
    Admin.TicketEditController = TicketEditController;
    angular.module('ticketEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('ticketEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TicketEditController]);
})(Admin || (Admin = {}));
