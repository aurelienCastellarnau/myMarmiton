(function (){
    'use strict';

    angular.module('navbar', [])
        .controller('navbarController', [
        '$rootScope',
        '$scope', 
        '$http', 
        function($rootScope, $scope, $http){
            $scope.newRecipe = false;
            $scope.displayRecipes = false;
            $scope.menu = {
                'Afficher les recettes': function(){
                    if (!$scope.displayRecipes){
                        $http.get('App/Routing/index.php', {params: {'uri': 'recipe'}})
                            .then(function(response){
                            $rootScope.$broadcast('recipes-content', {recipes: response.data});
                        })
                            .catch(function(err){
                            console.log(err);
                        });
                    }
                    $rootScope.$broadcast('display-recipes', {displayRecipes: !$scope.displayRecipes});
                },
                'Créer une recette': function(){
                    $rootScope.$broadcast('display_create_recipe_form', {newRecipe: !$scope.newRecipe});
                }
            }
        }])
        .directive('dNavbar', function(){
        return {
            restrict: 'E',
            replace: true,
            templateUrl: "App/View/navbar.html"
        }
    });
})();