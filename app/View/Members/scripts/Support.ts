/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class TicketListController {
        constructor(public $scope:any, public $minute:any, public $ui:any, public $timeout:ng.ITimeoutService,
                    public gettext:angular.gettext.gettextFunction, public gettextCatalog:angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }

        open = (link) => {
            top.location.href = link;
        };
    }

    angular.module('ticketListApp', ['MinuteFramework', 'MembersApp', 'gettext'])
        .controller('ticketListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', TicketListController]);
}
