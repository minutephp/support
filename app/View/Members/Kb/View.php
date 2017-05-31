<div class="content-wrapper ng-cloak" ng-app="ViewApp" ng-controller="ViewController as mainCtrl" ng-init="init()" ng-cloak="">

    <div class="members-content">
        <section class="content-header">
            <h1>Support page</h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/members"><i class="fa fa-dashboard"></i> <span translate="">Members</span></a></li>
                <li><a href="" ng-href="/members/support"><i class="fa fa-ticket"></i> <span translate="">Support</span></a></li>
                <li class="active"><i class="fa fa-edit"></i> <span translate="">Support page</span></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <b>{{page.name}}</b>
                </div>
                <div class="box-body" style="min-height: 60vh">
                    <div ng-bind-html="page.html | markdown"></div>
                </div>

                <div class="box-footer">
                    <i class="fa fa-question-circle"></i> Need more help? <a ng-href="/members/support">Click here</a>
                </div>
            </div>
        </section>
    </div>
</div>
