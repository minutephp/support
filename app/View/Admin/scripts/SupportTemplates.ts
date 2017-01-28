/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class TemplateListController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }

        actions = (item) => {
            let gettext = this.gettext;
            let actions = [
                {'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit template'), 'href': '/admin/support-templates/edit/' + item.support_template_id},
                {'text': gettext('Clone'), 'icon': 'fa-copy', 'hint': gettext('Clone template'), 'click': 'ctrl.clone(item)'},
                {'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this template'), 'click': 'item.removeConfirm("Removed")'},
            ];

            this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.name, this.$scope, {item: item, ctrl: this});
        };

        clone = (template) => {
            let gettext = this.gettext;
            this.$ui.prompt(gettext('Enter new title'), gettext('new-title')).then(function (title) {
                template.clone().attr('title', title).save(gettext('Template duplicated'));
            });
        }
    }

    angular.module('templateListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('templateListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TemplateListController]);
}
