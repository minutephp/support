<div class="content-wrapper ng-cloak" ng-app="pageEditApp" ng-controller="pageEditController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1>
                <span translate="" ng-show="!page.support_page_id">Add new</span>
                <span translate="" ng-show="!!page.support_page_id">Edit</span>
                <span translate="">support page</span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li><a href="" ng-href="/admin/support/pages"><i class="fa fa-page"></i> <span translate="">Pages</span></a></li>
                <li class="active"><i class="fa fa-edit"></i> <span translate="">Edit page</span></li>
            </ol>
        </section>

        <section class="content">
            <form class="form-horizontal" name="pageForm" ng-submit="mainCtrl.save()">
                <div class="box box-{{pageForm.$valid && 'success' || 'danger'}}">
                    <div class="box-header with-border">
                        <span translate="" ng-show="!page.support_page_id">New support page</span>
                        <span ng-show="!!page.support_page_id"><span translate="">Edit</span> {{page.name}}</span>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"><span translate="">Name:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Enter page name" ng-model="page.name" ng-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="description"><span translate="">Description:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" placeholder="Enter Description" ng-model="page.description" ng-required="false">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="keywords"><span translate="">Keywords:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="keywords" placeholder="Enter Keywords" ng-model="page.keywords" ng-required="false">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="html">
                                <span translate="">HTML</span>
                            </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="10" placeholder="Enter HTML" ng-model="page.html" ng-required="true"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span translate="">Enabled:</span></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" ng-model="page.enabled" ng-value="true"> <span translate="">Yes</span>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" ng-model="page.enabled" ng-value="false"> <span translate="">No</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer with-border">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-flat btn-primary">
                                    <span translate="" ng-show="!page.support_page_id">Add</span>
                                    <span translate="" ng-show="!!page.support_page_id">Update</span>
                                    <span translate="">support page</span>
                                    <i class="fa fa-fw fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
