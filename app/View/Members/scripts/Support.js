/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var TicketListController = (function () {
        function TicketListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.open = function (link) {
                top.location.href = link;
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }
        return TicketListController;
    }());
    App.TicketListController = TicketListController;
    angular.module('ticketListApp', ['MinuteFramework', 'MembersApp', 'gettext'])
        .controller('ticketListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TicketListController]);
})(App || (App = {}));
