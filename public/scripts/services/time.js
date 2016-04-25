(function() {

    'use strict';

    angular
        .module('timeTracker')
        .factory('time', time);

        function time($resource) {

            // ngResource call to our static data
            var Time = $resource('data/time.json');

            return {};

        }
})();
