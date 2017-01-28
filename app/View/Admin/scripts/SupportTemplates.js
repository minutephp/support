/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var TemplateListController = (function () {
        function TemplateListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
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
                    { 'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit template'), 'href': '/admin/support-templates/edit/' + item.support_template_id },
                    { 'text': gettext('Clone'), 'icon': 'fa-copy', 'hint': gettext('Clone template'), 'click': 'ctrl.clone(item)' },
                    { 'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this template'), 'click': 'item.removeConfirm("Removed")' },
                ];
                _this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.name, _this.$scope, { item: item, ctrl: _this });
            };
            this.clone = function (template) {
                var gettext = _this.gettext;
                _this.$ui.prompt(gettext('Enter new title'), gettext('new-title')).then(function (title) {
                    template.clone().attr('title', title).save(gettext('Template duplicated'));
                });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }
        return TemplateListController;
    }());
    App.TemplateListController = TemplateListController;
    angular.module('templateListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('templateListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TemplateListController]);
})(App || (App = {}));
