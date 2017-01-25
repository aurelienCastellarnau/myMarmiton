(function(){
    'use strict';
    
    var app = angular.module('Marmiton', [
        //'ngAnimate',
        'navbar',
        'recipe_dir'
    ]);
    app.controller('marmitonController',[
        '$rootScope',
        '$scope',
        '$http',
        function ($rootScope, $scope, $http){
        }]);
})();