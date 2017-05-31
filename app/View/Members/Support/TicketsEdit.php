<div class="content-wrapper ng-cloak" ng-app="ticketEditApp" ng-controller="ticketEditController as mainCtrl" ng-init="init()">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <section class="content-header">
                    <h1>
                        <span translate="" ng-show="!ticket.support_ticket_id">Create new</span>
                        <span translate="" ng-show="!!ticket.support_ticket_id">Edit</span>
                        <span translate="">ticket</span>
                    </h1>

                    <ol class="breadcrumb">
                        <li><a href="" ng-href="/members"><i class="fa fa-dashboard"></i> <span translate="">Members</span></a></li>
                        <li><a href="" ng-href="/members/support"><i class="fa fa-ticket"></i> <span translate="">Tickets</span></a></li>
                        <li class="active"><i class="fa fa-edit"></i> <span translate="">Edit ticket</span></li>
                    </ol>
                </section>

                <section class="content">
                    <div class="box box-{{data.valid && 'success' || 'danger'}}">
                        <div class="box-header with-border">
                            <span translate="" ng-show="!ticket.support_ticket_id">How can we help you?</span>
                            <span ng-show="!!ticket.support_ticket_id"><span translate="">Ticket details for</span> {{ticket.title | truncate:50:'..'}}</span>

                            <div class="box-tools" ng-show="!!ticket.support_ticket_id">
                                <minute-uploader btn-class="btn btn-info btn-xs btn-flat" ng-model="data.msg" type="image" preview="false" hint="{{'Insert attachment' | translate}}"
                                                 remove="false" icon="fa fa-paperclip" label="false" on-upload="mainCtrl.uploaded"></minute-uploader>
                            </div>
                        </div>

                        <form name="ticketForm" ng-submit="mainCtrl.save()" ng-if="!ticket.replies.length">
                            <minute-observer watch="ticketForm.$valid" on-change="data.valid = value"></minute-observer>

                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label" for="title"><span translate="">I need help with:</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="title" placeholder="Brief describe the issue" ng-model="ticket.title" ng-required="true" maxlength="255" auto-focus>
                                        <p class="help-block text-sm">
                                            <i class="fa fa-lightbulb-o"></i>
                                            <b><span translate="">Tip:</span></b>
                                            <span translate="">Phrasing the issue as a question like "How do I..?", or "Is it possible to..?", "What does..?" makes it easier for us to understand the
                                                problem
                                                quickly!</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category">
                                        <span translate="">Department:</span>
                                    </label>
                                    <select id="category" ng-model="ticket.category" ng-required="true" class="form-control">
                                        <option ng-repeat="(key, label) in data.categories" value="{{key}}">{{label}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><span translate="">Create ticket</span> <i class="fa fa-fw fa-angle-right"></i></button>
                                </div>

                                <div class="box-footer">
                                    <p class="help-block text-sm" translate="">P.S. You can add comments / screen-shot in the next step.</p>
                                </div>
                            </div>
                        </form>

                        <form name="ticketForm" ng-submit="mainCtrl.send()" ng-if="!!ticket.replies.length">
                            <minute-observer watch="ticketForm.$valid" on-change="data.valid = value"></minute-observer>

                            <div class="box-body">
                                <div class="pre-scrollable" id="scrollBox">
                                    <div class="direct-chat-msg" ng-class="{right: reply.user_id !== ticket.user_id}" ng-repeat="reply in ticket.replies | orderBy:'support_reply_id'">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-{{reply.user_id === ticket.user_id && 'left' || 'right'}}">
                                                {{reply.user.first_name || (reply.user_id === ticket.user_id && 'You' || 'Webmaster')}}
                                            </span>
                                            <span class="direct-chat-timestamp pull-{{reply.user_id !== ticket.user_id && 'left' || 'right'}}">{{reply.created_at | timeAgo}}</span>
                                        </div>

                                        <ng-switch on="!!reply.user.photo_url">
                                            <img class="direct-chat-img thumbnail" ng-src="{{reply.user.photo_url}}" ng-switch-when="true">
                                            <div class="avatar-char pull-{{reply.user_id === ticket.user_id && 'left' || 'right'}}" ng-switch-when="false">
                                                {{reply.user_id === ticket.user_id && 'Y' || 'A'}}
                                            </div>
                                        </ng-switch>

                                        <div class="direct-chat-text" ng-bind-html="reply.reply_safe | linky"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="input-group">
                                    <input type="text" ng-model="data.msg" placeholder="Type Message here..." class="form-control" ng-required="true" auto-focus="">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-info btn-flat"><span translate="">Send</span> <i class="fa fa-angle-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="well" ng-if="!!ticket.replies.length && !data.hide">
                        <ng-switch on="ticket.state === 'open'">
                            <div ng-switch-when="true">
                                <i class="fa fa-question-circle"></i>
                                <span translate="">Has your issue been resolved?</span>
                                <a href="" ng-click="mainCtrl.close()"><span translate="">Click here to close this ticket.</span></a>
                            </div>
                            <div ng-switch-when="false">
                                <button type="button" class="close" ng-click="data.hide = true" tooltip="Dismiss"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-exclamation-triangle"></i> <span translate="">This ticket is marked as {{ticket.state}}. To re-open it just add a new reply!</span>
                            </div>
                        </ng-switch>
                    </div>
                </section>
            </div>
            <div class="col-md-4" ng-show="!!pages.length && !!data.showSearch">
                <section class="content-header">
                    <h1>&nbsp;</h1>
                </section>
                <section class="content">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <b translate="">Related questions</b>
                        </div>

                        <div class="box-body">
                            <div ng-repeat="page in pages">
                                <h4>{{$index + 1}}. {{page.name | ucfirst}}</h4>
                                <p ng-show="!!page.description">{{page.description | truncate:50:'..'}}</p>
                                <p><a class="btn btn-flat btn-default btn-xs" ng-href="/members/kb/{{page.support_page_id}}"><i class="fa fa-eye"></i> <span translate="">View page</span></a></p>
                                <hr ng-show="!$last">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
