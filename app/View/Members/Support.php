<div class="content-wrapper ng-cloak" ng-app="ticketListApp" ng-controller="ticketListController as mainCtrl" ng-init="init()">
    <div class="container-fluid">

        <div class="member-content">
            <section class="content-header">
                <h1><span translate="">List of tickets</span></h1>

                <ol class="breadcrumb">
                    <li><a href="" ng-href="/member"><i class="fa fa-dashboard"></i> <span translate="">Member</span></a></li>
                    <li class="active"><i class="fa fa-ticket"></i> <span translate="">Ticket list</span></li>
                </ol>
            </section>

            <section class="content">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <span translate="">All tickets</span>
                        </h3>

                        <div class="box-tools">
                            <a class="btn btn-sm btn-primary btn-flat" ng-href="/members/support/tickets/edit">
                                <i class="fa fa-plus-circle"></i> <span translate="">Create new ticket</span>
                            </a>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-bar list-group-item-bar-{{ticket.state === 'closed' && 'success' || 'danger'}}"
                                 ng-repeat="ticket in tickets" ng-init="link = '/members/support/tickets/edit/' + ticket.support_ticket_id" ng-click-container="mainCtrl.open(link)">
                                <div class="pull-left">
                                    <h4 class="list-group-item-heading">{{ticket.title | ucfirst}} ({{ticket.state}})</h4>
                                    <p class="list-group-item-text hidden-xs">
                                        &quot;{{ticket.reply.reply_safe | truncate:70:'..'}}&quot; by {{ticket.reply.user.first_name}} ({{ticket.reply.created_at | timeAgo}})
                                    </p>
                                </div>
                                <div class="md-actions pull-right">
                                    <a class="btn btn-default btn-flat btn-sm" ng-href="{{link}}">
                                        <i class="fa fa-search"></i> <span translate="">View ticket..</span>
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
        <div class="text-center">
            <a class="btn btn-primary btn-flat" ng-href="/members/support/tickets/edit">
                <i class="fa fa-question-circle"></i> <span translate="">Have a question? Ask us!</span>
            </a>
        </div>
    </div>
</div>
