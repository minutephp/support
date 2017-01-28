<div class="content-wrapper ng-cloak" ng-app="templateEditApp" ng-controller="templateEditController as mainCtrl" ng-init="init()">
    <div class="admin-content" minute-hot-keys="{'ctrl+s':mainCtrl.save}">
        <section class="content-header">
            <h1>
                <span translate="" ng-show="!template.support_template_id">Create new</span>
                <span translate="" ng-show="!!template.support_template_id">Edit</span>
                <span translate="">support template</span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li><a href="" ng-href="/admin/support-templates"><i class="fa fa-template"></i> <span translate="">Templates</span></a></li>
                <li class="active"><i class="fa fa-edit"></i> <span translate="">Edit template</span></li>
            </ol>
        </section>

        <section class="content">
            <form class="form-horizontal" name="templateForm" ng-submit="mainCtrl.save()">
                <div class="box box-{{templateForm.$valid && 'success' || 'danger'}}">
                    <div class="box-header with-border">
                        <span translate="" ng-show="!template.support_template_id">New template</span>
                        <span ng-show="!!template.support_template_id"><span translate="">Edit</span> {{template.title}}</span>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="title"><span translate="">Title:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Enter Title" ng-model="template.title" ng-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="keywords"><span translate="">Keywords:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="keywords" placeholder="Enter Keywords" ng-model="template.keywords" ng-required="true">
                                <p class="help-block"><span translate="">(comma separated list of keywords)</span></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="reply_safe"><span translate="">Quick Reply:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="reply_safe" placeholder="Enter Quick Reply" ng-model="template.reply_safe" ng-required="true">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer with-border">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-flat btn-primary">
                                    <span translate="" ng-show="!template.support_template_id">Create</span>
                                    <span translate="" ng-show="!!template.support_template_id">Update</span>
                                    <span translate="">template</span>
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
