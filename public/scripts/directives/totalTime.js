(function() {

    'use strict';
    angular
        .module('timeTracker')
        .directive('totalTime', totalTime);

    function totalTime() {

    return {
        templateUrl: 'scripts/directives/totalTime.html'
    };

    }

})();
