/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class PageListController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }

        actions = (item) => {
            let gettext = this.gettext;
            let actions = [
                {'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit page'), 'href': '/admin/support/pages/edit/' + item.support_page_id},
                {'text': gettext('Clone'), 'icon': 'fa-copy', 'hint': gettext('Clone page'), 'click': 'ctrl.clone(item)'},
                {'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this page'), 'click': 'item.removeConfirm("Removed")'},
            ];

            this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.name, this.$scope, {item: item, ctrl: this});
        };

        clone = (page) => {
            let gettext = this.gettext;
            this.$ui.prompt(gettext('Enter new name'), gettext('new-name')).then(function (name) {
                page.clone().attr('name', name).save(gettext('Page duplicated'));
            });
        }
    }

    angular.module('pageListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('pageListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', PageListController]);
}
