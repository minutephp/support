/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var PageEditController = (function () {
        function PageEditController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.save = function () {
                _this.$scope.page.save(_this.gettext('Page saved successfully'));
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.page = $scope.pages[0] || $scope.pages.create().attr('enabled', true);
        }
        return PageEditController;
    }());
    App.PageEditController = PageEditController;
    angular.module('pageEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('pageEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', PageEditController]);
})(App || (App = {}));
