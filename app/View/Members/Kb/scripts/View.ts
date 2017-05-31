/// <reference path="E:/var/Dropbox/projects/siteexplainer/public/static/bower_components/minute/_all.d.ts" />

module App {
    export class ViewController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.page = $scope.pages[0];
        }
    }

    angular.module('ViewApp', ['MinuteFramework', 'gettext', 'AngularMarkdown'])
        .controller('ViewController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', ViewController]);
}
