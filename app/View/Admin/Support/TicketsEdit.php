<div class="content-wrapper ng-cloak" ng-app="ticketEditApp" ng-controller="ticketEditController as mainCtrl" ng-init="init()">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <section class="content-header">
                    <h1>{{ticket.title | ucfirst}} by <a href="" ng-href="/admin/users/edit/{{ticket.creator.user_id}}" target="_blank" tooltip="{{'View user' | translate}}">{{ticket.creator.first_name}}</a>
                        <small>({{ticket.created_at | timeAgo}})</small></h1>

                    <ol class="breadcrumb">
                        <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                        <li><a href="" ng-href="/admin/support/tickets"><i class="fa fa-ticket"></i> <span translate="">Tickets</span></a></li>
                        <li class="active"><i class="fa fa-edit"></i> <span translate="">Edit ticket</span></li>
                    </ol>
                </section>

                <section class="content">
                    <form class="form-horizontal" name="ticketForm" ng-submit="mainCtrl.send()">
                        <div class="box box-{{ticketForm.$valid && 'success' || 'danger'}}">
                            <div class="box-header with-border">
                                <span translate="">Ticket details</span>

                                <div class="box-tools">
                                    <minute-uploader btn-class="btn btn-default btn-xs" ng-model="data.msg" type="image" preview="false" hint="{{'Insert attachment' | translate}}"
                                                     remove="false" icon="fa fa-paperclip" label="false" on-upload="mainCtrl.uploaded"></minute-uploader>
                                    <button type="button" class="btn btn-flat btn-default btn-xs" ng-click="mainCtrl.showTemplates()" tooltip="{{'Insert template reply' | translate}}">
                                        <i class="fa fa-bolt"></i>
                                    </button>
                                    <button type="button" class="btn btn-flat btn-default btn-xs" ng-click="mainCtrl.saveAsPage()" tooltip="{{'Add to support pages' | translate}}">
                                        <i class="fa fa-file-text-o"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="padded">
                                    <div class="direct-chat-msg" ng-class="{right: !isCreator}" ng-repeat="reply in ticket.replies | orderBy:'support_reply_id'"
                                         ng-init="isCreator = reply.user_id === ticket.user_id">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-{{isCreator && 'left' || 'right'}}">{{reply.user.first_name || (isCreator && 'You' || 'Webmaster')}}</span>
                                            <span class="direct-chat-timestamp pull-{{!isCreator && 'left' || 'right'}}">{{reply.created_at | timeAgo}}</span>
                                        </div>

                                        <ng-switch on="!!reply.user.photo_url">
                                            <img class="direct-chat-img thumbnail" ng-src="{{reply.user.photo_url}}" ng-switch-when="true">
                                            <div class="avatar-char pull-{{isCreator && 'left' || 'right'}}" ng-switch-when="false">{{isCreator && 'Y' || 'A'}}</div>
                                        </ng-switch>

                                        <div class="direct-chat-text" ng-bind-html="reply.reply_safe | linky"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="input-group">
                                    <input type="text" ng-model="data.msg" placeholder="Type Message here..." class="form-control" ng-required="true" auto-focus>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-warning btn-flat"><span translate="">Send</span> <i class="fa fa-angle-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="well" ng-if="!!ticket.replies.length && !data.hide">
                            <ng-switch on="ticket.state === 'open'">
                                <div ng-switch-when="true">
                                    <button type="button" class="close" ng-click="data.hide = true" tooltip="Dismiss"><span aria-hidden="true">&times;</span></button>
                                    <i class="fa fa-question-circle"></i>
                                    <span translate="">Has this issue been resolved?</span>
                                    <a href="" ng-click="mainCtrl.close()"><span translate="">Click here to close this ticket.</span></a>
                                </div>
                                <div ng-switch-when="false">
                                    <i class="fa fa-exclamation-triangle"></i> <span translate="">This ticket is marked as {{ticket.state}}</span>
                                </div>
                            </ng-switch>
                        </div>
                    </form>
                </section>
            </div>
            <div class="col-lg-4 visible-lg">
                <section class="content-header">
                    <h1><span translate="">User information</span></h1>
                </section>

                <section class="content">
                    <form class="form-horizontal" name="Form">
                        <div class="box box-{{Form.$valid && 'success' || 'danger'}}">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ticket.creator.first_name | ucfirst}}</h3>

                                <div class="box-tools">
                                    <a class="btn btn-xs btn-default" href="" ng-href="/admin/users/edit/{{ticket.creator.user_id}}" target="_blank">
                                        <i class="fa fa-search"></i> <span translate="">View user</span>
                                    </a>
                                    <a class="btn btn-xs btn-default" ng-href="/admin/users/login-as/{{ticket.creator.user_id}}" target="_top">
                                        <i class="fa fa-sign-in"></i> <span translate="">Login as..</span>
                                    </a>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span translate="">Name:</span></label>
                                    <div class="col-sm-10">
                                        <ng-switch on="!!(ticket.creator.first_name || ticket.creator.last_name)">
                                            <p class="help-block" ng-switch-when="true">{{ticket.creator.first_name}} {{ticket.creator.last_name}}</p>
                                            <p class="help-block" ng-switch-when="false"><span translate="">Anonymous user</span></p>
                                        </ng-switch>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span translate="">Email:</span></label>
                                    <div class="col-sm-10">
                                        <p class="help-block" translate="">{{ticket.creator.email}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span translate="">Groups:</span></label>
                                    <div class="col-sm-10">
                                        <p class="help-block"><span ng-repeat="group in ticket.creator.groups">{{group.group_name | ucfirst}}<span>{{$last && '.' || ', '}}</span></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script type="text/ng-template" id="/templates-popup.html">
        <div class="box">
            <div class="box-header with-border">
                <b class="pull-left"><span translate="">All template replies</span></b>
                <a class="pull-right close-button" href=""><i class="fa fa-times"></i></a>
            </div>

            <div class="box-body">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <a ng-href="/admin/support-templates"><span translate="">Manage support templates</span></a>
                </div>

                <div class="list-group-item list-group-item-bar" ng-repeat="template in templates">
                    <div class="pull-left">
                        <h4 class="list-group-item-heading">{{template.title | ucfirst}}</h4>
                        <p class="list-group-item-text hidden-xs"><span translate="">Reply:</span> {{template.reply_safe | truncate:50}}</p>
                        <p class="list-group-item-text hidden-xs"><span translate="">Keywords:</span> {{template.keywords}}</p>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-default btn-flat close-button btn-xs" ng-click="ctrl.insertTemplate(template)"><span translate="">Insert</span></a>
                        <a class="btn btn-default btn-flat close-button btn-xs" ng-click="template.remove();"><span translate="">Remove</span></a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="box-footer with-border">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-push-6">
                        <minute-pager class="pull-right" on="templates" no-results="{{'No templates found' | translate}}"></minute-pager>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-pull-6">
                        <minute-search-bar on="templates" columns="title, keywords, reply_safe" label="{{'Search templates..' | translate}}"></minute-search-bar>
                    </div>
                </div>
            </div>
        </div>
    </script>
</div>
