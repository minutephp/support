/// <reference path="E:/var/Dropbox/projects/siteexplainer/public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var ViewController = (function () {
        function ViewController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.page = $scope.pages[0];
        }
        return ViewController;
    }());
    App.ViewController = ViewController;
    angular.module('ViewApp', ['MinuteFramework', 'gettext', 'AngularMarkdown'])
        .controller('ViewController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', ViewController]);
})(App || (App = {}));
