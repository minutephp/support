/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var PageListController = (function () {
        function PageListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
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
                    { 'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit page'), 'href': '/admin/support/pages/edit/' + item.support_page_id },
                    { 'text': gettext('Clone'), 'icon': 'fa-copy', 'hint': gettext('Clone page'), 'click': 'ctrl.clone(item)' },
                    { 'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this page'), 'click': 'item.removeConfirm("Removed")' },
                ];
                _this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.name, _this.$scope, { item: item, ctrl: _this });
            };
            this.clone = function (page) {
                var gettext = _this.gettext;
                _this.$ui.prompt(gettext('Enter new name'), gettext('new-name')).then(function (name) {
                    page.clone().attr('name', name).save(gettext('Page duplicated'));
                });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }
        return PageListController;
    }());
    App.PageListController = PageListController;
    angular.module('pageListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('pageListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', PageListController]);
})(App || (App = {}));
