/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class PageEditController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.page = $scope.pages[0] || $scope.pages.create().attr('enabled', true);
        }

        save = () => {
            this.$scope.page.save(this.gettext('Page saved successfully'));
        };
    }

    angular.module('pageEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('pageEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', PageEditController]);
}
