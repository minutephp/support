/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class TemplateEditController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.template = $scope.templates[0] || $scope.templates.create();
        }

        save = () => {
            this.$scope.template.save(this.gettext('Template saved successfully'));
        };
    }

    angular.module('templateEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('templateEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TemplateEditController]);
}
