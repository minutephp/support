<div class="content-wrapper ng-cloak" ng-app="ticketListApp" ng-controller="ticketListController as mainCtrl" ng-init="init()">
    <div class="admin-content" ng-init="data.state = session.params.state">
        <section class="content-header">
            <h1><span translate="">All {{data.state}} tickets</span></h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li><a href="" ng-href="/admin/support/tickets"><i class="fa fa-ticket"></i> <span translate="">Tickets</span></a></li>
                <li class="active"><i class="fa fa-eye"></i> <span translate="">{{data.state}}</span></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span translate="">{{tickets.getTotalItems() || 0}} tickets</span>
                    </h3>

                    <div class="box-tools">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                                <b>{{data.state | ucfirst}}</b> <span translate="">tickets</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li ng-repeat="state in data.states"><a href="" ng-href="/admin/support/tickets/{{state}}">{{state | ucfirst}} <span translate="">tickets</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-bar list-group-item-bar-{{ticket.reply.user_id !== ticket.user_id && 'success' || 'danger'}}"
                             ng-repeat="ticket in tickets" ng-click-container="mainCtrl.actions(ticket)" ng-show="ticket.state == data.state">

                            <div class="pull-left">
                                <div class="avatar-char" tooltip="{{ticket.category | ucfirst}}">{{ticket.category | firstChar}}</div>
                            </div>

                            <div class="pull-left">
                                <h4 class="list-group-item-heading">{{ticket.title | truncate:60:'..' | ucfirst}} <small>by {{ticket.user.first_name}} ({{ticket.group.group_name}} user)</small></h4>
                                <p class="list-group-item-text hidden-xs">&quot;{{ticket.reply.reply_safe | truncate:60:'..'}}&quot; - {{ticket.reply.created_at | timeAgo}}</p>
                                <p class="list-group-item-text hidden-xs text-small" ng-show="ticket.state === 'deferred'"><span translate="">Will re-open</span> {{ticket.addback_at | timeAgo}}</p>
                            </div>
                            <div class="md-actions pull-right">
                                <a class="btn btn-default btn-flat btn-xs" ng-href="/admin/support/tickets/edit/{{ticket.support_ticket_id}}">
                                    <i class="fa fa-pencil-square-o"></i> <span translate="">Reply..</span>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-md-push-6">
                            <minute-pager class="pull-right" on="tickets" no-results="{{'No tickets found' | translate}}"></minute-pager>
                        </div>
                        <div class="col-xs-12 col-md-6 col-md-pull-6">
                            <minute-search-bar on="tickets" columns="title, reply.reply_safe" label="{{'Search ticket..' | translate}}"></minute-search-bar>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
