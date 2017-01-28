/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var TemplateEditController = (function () {
        function TemplateEditController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.save = function () {
                _this.$scope.template.save(_this.gettext('Template saved successfully'));
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.template = $scope.templates[0] || $scope.templates.create();
        }
        return TemplateEditController;
    }());
    App.TemplateEditController = TemplateEditController;
    angular.module('templateEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('templateEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TemplateEditController]);
})(App || (App = {}));
