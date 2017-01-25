(function(){
    'use strict';

    angular.module('recipe_dir', [
        'model'
    ])
        .controller('CrudRecipeController', [
        '$rootScope',
        '$scope', 
        '$http', 
        'recipe',
        'ingredient',
        'step',
        function($rootScope, $scope, $http, recipe, ingredient, step){
            $scope.recipe = {};
            $scope.recipes = [];
            $scope.edit = false;
            $scope.newIngredient = false;
            $scope.err = false;

            $scope.$on('display_create_recipe_form', function(event, args){
                $scope.newRecipe = args.newRecipe;
                $scope.recipe = new recipe();
            });

            this.create_recipe = function(){
                $http.post('App/Routing/index.php?uri=recipe', {'recipe': $scope.recipe})
                    .then(function(response){
                    if (response.data === "true")
                    {
                        $http.get('App/Routing/index.php', {params: {'uri': 'recipe'}})
                            .then(function(rep){
                            $rootScope.$broadcast('recipes-content', {recipes: rep.data});
                        })
                            .catch(function(err){
                            console.log(err);
                        });
                    }
                    else
                       $scope.err = response.data; 
                })
                    .catch(function(err){
                    console.log(err);
                });
            };

            this.update_recipe = function(){
                $http.put('App/Routing/index.php?uri=recipe', {'recipe': $scope.recipe})
                    .then(function(response){
                    if (response.data === "true")
                    {
                        $http.get('App/Routing/index.php', {params: {'uri': 'recipe'}})
                            .then(function(rep){
                            $rootScope.$broadcast('recipes-content', {recipes: rep.data});
                        })
                            .catch(function(err){
                            console.log(err);
                        });
                    }
                    else
                       $scope.err = response.data; 
                })
                    .catch(function(err){
                    console.log(err);
                });
            };

            this.addIngredient = function(){
                if (!$scope.newIngredient)
                    $scope.newIngredient = true;
                $scope.recipe.ingredients.push(new ingredient());
            };

            this.addStep = function(){
                if (!$scope.newStep)
                    $scope.newStep = true;
                $scope.recipe.steps.push(new step());
            }
        }])
        .directive('dCreateRecipe', function(){
        return {
            restrict: 'E',
            replace: true,
            templateUrl: "App/View/create_recipe.html"
        };
    })

        .controller('displayRecipesController', [
        '$scope', 
        '$http',
        'recipe',
        'recipes',
        function($scope, $http, recipe, recipes){
            $scope.recipes = [];
            $scope.active = 0;

            $scope.$on('recipes-content', function(event, args){
                $scope.recipes = args.recipes;
                $scope.recipe = $scope.recipes[0];
            });

            $scope.$on('display-recipes', function(event, args){
                $scope.displayRecipes = args.displayRecipes;
            });

            this.prev = function()
            {
                if ($scope.active > 0)
                    $scope.active--;
                else
                    $scope.active = $scope.recipes.length - 1;
                $scope.recipe = $scope.recipes[$scope.active];
            }

            this.next = function()
            {
                if ($scope.active < $scope.recipes.length - 1)
                    $scope.active++;
                else
                    $scope.active = 0;
                $scope.recipe = $scope.recipes[$scope.active];
            }

            this.active = function(key)
            {
                $scope.active = key;
                $scope.recipe = $scope.recipes[$scope.active];
            }

        }])
        .directive('dDisplayRecipes', function(){
        return {
            restrict: 'E',
            replace: true,
            templateUrl: "App/View/display_recipes.html"
        }
    })
        .controller('displayRecipeController', [
        '$scope', 
        '$http', 
        'recipe',
        function ($scope, $http, recipe){
            $scope.recipe;
            console.log($scope.recipe);
            console.log($scope);
        }])
        .directive('dDisplayRecipe', function(){
        return {
            restrict: 'E',
            replace: true,
            templateUrl: "App/View/display_recipe.html"
        }
    });
})();