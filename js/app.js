(function() {
    var app = angular.module('iaesteWeb', []);

    app.controller("ReviewController", function(){

        this.review = {};

        this.addReview = function(product){
            product.reviews.push(this.review);
            this.review = {};
        };

    });

    app.directive("wichtigeInformationen", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/wichtige-informationen.html"
        };
    });

})();
