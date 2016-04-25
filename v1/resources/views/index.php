<!doctype html>
<html>
    <head>
        <title>Time Tracker</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    </head>
    <body ng-app="timeTracker" ng-controller="TimeEntry as vm">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <div class="container">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/">Vasi - Angular + Laravel</a>
              </div>
              <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav pull-right">
                      <li><a href="/">Home</a></li>
                      <li><a href="/v1">Status</a></li>
                      <li><a href="https://github.com/Vasiharan">Vasi</a></li>
                  </ul>
              </div>
          </div>
        </div>
        <section id="topper" style="background-image: url('data:image/svg+xml;base64,<?php echo base64_encode('<svg xmlns="http://www.w3.org/2000/svg" version="1.1"><defs id="defs4"><filter color-interpolation-filters="sRGB" id="filter3115"><feTurbulence type="fractalNoise" numOctaves="1" baseFrequency="0.9" id="feTurbulence3117"/><feColorMatrix result="result5" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 6 -4.15 " id="feColorMatrix3119"/><feComposite in2="result5" operator="in" in="SourceGraphic" result="result6" id="feComposite3121"/><feMorphology in="result6" operator="dilate" radius="1" result="result3" id="feMorphology3123"/></filter></defs><rect width="100%" height="100%" x="0" y="0" id="rect2985" fill="#000000"/><rect width="100%" height="100%" x="0" y="0" id="rect2985" style="fill:#FF4343;filter:url(#filter3115)"/></svg>'); ?>');">
            <h1>Time Tracker</h1>
        </section>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Time Tracker</a>
                </div>
            </div>
            <div class="container-fluid time-entry">
                <div class="timepicker">
                    <span class="timepicker-title label label-primary">Clock In</span><uib-timepicker ng-model="vm.clockIn" hour-step="1" minute-step="1" show-meridian="true"></uib-timepicker>
                </div>
                <div class="timepicker">
                    <span class="timepicker-title label label-primary">Clock Out</span><uib-timepicker ng-model="vm.clockOut" hour-step="1" minute-step="1" show-meridian="true"></uib-timepicker>
                </div>
                <div class="time-entry-comment">
                    <form class="navbar-form">
                        <select name="user" class="form-control" ng-model="vm.timeEntryUser" ng-options="user.first_name + ' ' + user.last_name for user in vm.users">
                            <option value="">-- Select a user --</option>
                        </select>
                        <input class="form-control" ng-model="vm.comment" placeholder="Enter a comment"></input>
                        <button class="btn btn-primary" ng-click="vm.logNewTime()">Log Time</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="col-sm-8">

                <div class="well vm" ng-repeat="time in vm.timeentries">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4><i class="glyphicon glyphicon-user"></i> {{time.user.first_name}} {{time.user.last_name}}</h4>
                           <p><i class="glyphicon glyphicon-pencil"></i> {{time.comment}}</p>
                       </div>
                       <div class="col-sm-4 time-numbers">
                            <h4><i class="glyphicon glyphicon-calendar"></i> {{time.end_time | date:'mediumDate'}}</h4>
                           <h2><span class="label label-primary" ng-show="time.loggedTime.duration._data.hours > 0">{{time.loggedTime.duration._data.hours}} hour<span ng-show="time.loggedTime.duration._data.hours > 1">s</span></span></h2>
                           <h4><span class="label label-default">{{time.loggedTime.duration._data.minutes}} minutes</span></h4>
                       </div>

                   </div>
                   <div class="row">
                        <div class="col-sm-3">
                            <button class="btn btn-primary btn-xs" ng-click="showEditDialog = true">Edit</button>
                            <button class="btn btn-danger btn-xs" ng-click="vm.deleteTimeEntry(time)">Delete</button>
                        </div>
                    </div>

                    <div class="row edit-time-entry" ng-show="showEditDialog === true">
                        <h4>Edit Time Entry</h4>
                        <div class="time-entry">
                            <div class="timepicker">
                                <span class="timepicker-title label label-primary">Clock In</span><uib-timepicker ng-model="time.start_time" hour-step="1" minute-step="1" show-meridian="true"></uib-timepicker>
                            </div>
                            <div class="timepicker">
                                <span class="timepicker-title label label-primary">Clock Out</span><uib-timepicker ng-model="time.end_time" hour-step="1" minute-step="1" show-meridian="true"></uib-timepicker>
                            </div>
                       </div>
                       <div class="col-sm-6">
                            <h5>User</h5>
                            <select name="user" class="form-control" ng-model="time.user" ng-options="user.first_name + ' ' + user.last_name for user in vm.users track by user.id">
                                <option value="user.id"></option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <h5>Comment</h5>
                            <textarea ng-model="time.comment" class="form-control">{{time.comment}}</textarea>
                        </div>
                        <div class="edit-controls">
                            <button class="btn btn-primary btn-sm" ng-click="vm.updateTimeEntry(time)">Save</button>
                            <button class="btn btn-danger btn-sm" ng-click="showEditDialog = false">Close</button>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-sm-4">
                <div class="well time-numbers">
                    <h1><i class="glyphicon glyphicon-time"></i> Total Time</h1>
                    <h1><span class="label label-primary">{{vm.totalTime.hours}} hours</span></h1>
                    <h3><span class="label label-default">{{vm.totalTime.minutes}} minutes</span></h3>
                </div>
            </div>
          </div>
    </body>

    <!-- Application Dependencies -->
    <script type="text/javascript" src="bower_components/angular/angular.js"></script>
    <script type="text/javascript" src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script type="text/javascript" src="bower_components/angular-resource/angular-resource.js"></script>
    <script type="text/javascript" src="bower_components/moment/moment.js"></script>

    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    <script type="text/javascript" src="scripts/controllers/TimeEntry.js"></script>
    <script type="text/javascript" src="scripts/services/time.js"></script>
    <script type="text/javascript" src="scripts/services/user.js"></script>
</html>
