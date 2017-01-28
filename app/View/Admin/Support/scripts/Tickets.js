/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var Admin;
(function (Admin) {
    var TicketListController = (function () {
        function TicketListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.actions = function (item) {
                var gettext = _this.gettext;
                var actions = [
                    { 'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit ticket'), 'href': '/admin/support/tickets/edit/' + item.support_ticket_id },
                    { 'text': gettext('Re-Open'), 'icon': 'fa-eye', 'hint': gettext('Re-open ticket'), 'click': 'ctrl.mark(item, "open")', 'show': 'item.state != "open"' },
                    { 'text': gettext('Close'), 'icon': 'fa-eye-slash', 'hint': gettext('Close ticket'), 'click': 'ctrl.mark(item, "closed")', 'show': 'item.state != "closed"' },
                    { 'text': gettext('Defer'), 'icon': 'fa-clock-o', 'hint': gettext('Defer ticket'), 'click': 'ctrl.mark(item, "deferred")', 'show': 'item.state != "deferred"' },
                    { 'text': gettext('Spam'), 'icon': 'fa-ban', 'hint': gettext('Mark as spam'), 'click': 'ctrl.mark(item, "spam")', 'show': 'item.state != "spam"' },
                    { 'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this ticket'), 'click': 'item.removeConfirm("Removed")' },
                ];
                _this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.title, _this.$scope, { item: item, ctrl: _this });
            };
            this.mark = function (item, state) {
                if (state == 'deferred') {
                    item.attr('addback_at', window['moment']().add(3, 'days').toDate());
                }
                item.attr('state', state).save(_this.gettext("Ticket marked as ") + state);
            };
            this.clone = function (ticket) {
                var gettext = _this.gettext;
                _this.$ui.prompt(gettext('Enter new slug'), gettext('/new-slug')).then(function (slug) {
                    ticket.clone().attr('slug', slug).save(gettext('Ticket duplicated')).then(function (copy) {
                        angular.forEach(ticket.contents, function (content) { return copy.item.contents.cloneItem(content).save(); });
                    });
                });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.data = { states: ['open', 'closed', 'deferred', 'spam'] };
        }
        return TicketListController;
    }());
    Admin.TicketListController = TicketListController;
    angular.module('ticketListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('ticketListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TicketListController]);
})(Admin || (Admin = {}));
