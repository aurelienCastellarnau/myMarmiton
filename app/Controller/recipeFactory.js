(function(){
    'use strict';

    angular.module('model', [])
        .factory('recipe', function(){
        return function(){
            this.id = null;
            this.name = "Nom de votre recette";
            this.kind = "Entrée/Plat/Dessert?";
            this.difficulty = 0;
            this.stars = 0;
            this.prepTime = 0;
            this.cookTime = 0;
            this.ingredients = [];
            this.steps = [];
        }
    })
        .factory('recipes', function(){
        var recipes = [];
        return {
            recipes: recipes
        }
    })
        .factory('ingredient', function(){
        return function(){
            this.id = null;
            this.id_recipe = null;
            this.name = "Nom de l'ingrédient";
            this.kind = "légume/ viande";
            this.quantity = 0;
            this.unit = "unité de mesure";
            this.comment = null;
        }
    })
        .factory('step', function(){
        return function(){
            this.id = null;
            this.id_recipe = null;
            this.content = "Description";
            this.number = 0;
        }
    });
})();