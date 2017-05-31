/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var PageListController = (function () {
        function PageListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }
        return PageListController;
    }());
    App.PageListController = PageListController;
    angular.module('pageListApp', ['MinuteFramework', 'MembersApp', 'gettext'])
        .controller('pageListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', PageListController]);
})(App || (App = {}));
