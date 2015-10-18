(function() {
    var app = angular.module('iaesteWeb', ['reCAPTCHA']);

    app.config(function (reCAPTCHAProvider) {
        // required: please use your own key :)
        reCAPTCHAProvider.setPublicKey('6LfyK-0SAAAAAAl6V9jBGQgPxemtrpIZ-SPDPd-n');

        // optional: gets passed into the Recaptcha.create call
        reCAPTCHAProvider.setOptions({
            theme: 'clean'
        });
    });
    app.controller('NewStudentController', function ($scope,$http,reCAPTCHA) {

        reCAPTCHA.setPublicKey('6LfyK-0SAAAAAAl6V9jBGQgPxemtrpIZ-SPDPd-n');

        $scope.tab = 1;
        $scope.isSet = function(checkTab) {
            return $scope.tab === checkTab;
        };
        $scope.setTab = function(setTab) {
            $scope.tab = setTab;
        };
        $scope.student = {
            "hochschule":"Tu Freiberg",
            "vorname":"hans",
            "nachname":"Peter",
            "geburtstag":"12.05.1989",
            "email":"florenz.erstling@gmx.de",
            "mobil":0151502323445,
            "studiengang":"Gtb",
            "vertiefungsrichtung":"Bohren",
            "semester":"12",
            "englisch":"gut",
            "spanisch":"gut",
            "franzoesisch":"jo",
            "andereSprachen":"Russisch",
            "programmiersprachen":"Java",
            "cad":"nein",
            "sonstiges":"lesen",
            "praktischeErfahrung":"einiges",
            "praktikumAbsolviert":"ja",
            "gewuenschteDauer":"12",
            "gewuenschterZeitraum":"Januar bis März",
            "interessenPraktikum":"einiges",
            "landEgal":"ja",
            "landEuropa":"jaja",
            "landAmerika":"jajaja",
            "landAsien":"jajajaj",
            "landAfrika":"jajajajaaj",
            "landWunsch":"Deuschland",
            "landNein":"Gana",
            "motivation":"Ich habe einefach mega Bock",
            "anmerkung":"Iaeste ist geil",
        };
        $scope.student = {};
        $scope.showThanks = false;

        $scope.formatDate = function (date) {
            date = new Date(date);
            date = date.format("yyyy-mm-dd");
            return date;
        };
        $scope.formatDates = function () {
            var geburtstag = $scope.student.geburtstag;
            geburtstag = $scope.formatDate(geburtstag);
            $scope.student.geburtstag = geburtstag;
        };

        $scope.toggle = function ($event, field, event) {
            $event.preventDefault();
            $event.stopPropagation();
            event[field] = !event[field];
        };
        $scope.lastForm = function(){
            if($scope.tab !=1) {
                $scope.tab--;
            }
        };

        $scope.nextForm = function(){
            $scope.$broadcast('show-errors-check-validity');
            $scope.inputCaptcha = true;
            if ($scope.studentForm.$valid) {
                $scope.tab++;
                $scope.formatDates();
                console.log($scope.student);
            }
        };



        $scope.save = function () {
            $scope.$broadcast('show-errors-check-validity');
            if ($scope.studentForm.$valid) {
                $scope.tab++;
                $scope.formatDates();
                var data = $scope.student;
                data = JSON.stringify(data);
                $http({
                    method: 'POST',
                    url: 'php/server.php?operation=saveApplicationPersoenlich&data=' + data
                }).then(function successCallback(response) {
                    console.log(response);
                    if(response.statusText != "OK"){
                        console.log(response.data.status)
                    }else {
                        console.log("jojo");
                        $scope.tab= 10;
                        $scope.student.id = response.data.id;
                        $scope.showThanks = true;
                    }
                }, function errorCallback(response) {
                    console.log("error");
                    console.log(response.data);
                });
                $scope.reset();
            }
        };

        $scope.reset = function () {
            $scope.$broadcast('show-errors-reset');
            $scope.user = {name: '', email: ''};
            $scope.event = {};
        }


    });
    app.directive('showErrors', function ($timeout, showErrorsConfig) {
            var getShowSuccess, linkFn;
            getShowSuccess = function (options) {
                var showSuccess;
                showSuccess = showErrorsConfig.showSuccess;
                if (options && options.showSuccess != null) {
                    showSuccess = options.showSuccess;
                }
                return showSuccess;
            };
            linkFn = function (scope, el, attrs, formCtrl) {
                var blurred, inputEl, inputName, inputNgEl, options, showSuccess, toggleClasses;
                blurred = false;
                options = scope.$eval(attrs.showErrors);
                showSuccess = getShowSuccess(options);
                inputEl = el[0].querySelector('[name]');
                inputNgEl = angular.element(inputEl);
                inputName = inputNgEl.attr('name');
                if (!inputName) {
                    throw 'show-errors element has no child input elements with a \'name\' attribute';
                }
                inputNgEl.bind('blur', function () {
                    blurred = true;
                    return toggleClasses(formCtrl[inputName].$invalid);
                });
                scope.$watch(function () {
                    return formCtrl[inputName] && formCtrl[inputName].$invalid;
                }, function (invalid) {
                    if (!blurred) {
                        return;
                    }
                    return toggleClasses(invalid);
                });
                scope.$on('show-errors-check-validity', function () {
                    return toggleClasses(formCtrl[inputName].$invalid);
                });
                scope.$on('show-errors-reset', function () {
                    return $timeout(function () {
                        el.removeClass('has-error');
                        el.removeClass('has-success');
                        return blurred = false;
                    }, 0, false);
                });
                return toggleClasses = function (invalid) {
                    el.toggleClass('has-error', invalid);
                    if (showSuccess) {
                        return el.toggleClass('has-success', !invalid);
                    }
                };
            };
            return {
                restrict: 'A',
                require: '^form',
                compile: function (elem, attrs) {
                    if (!elem.hasClass('form-group')) {
                        throw 'show-errors element does not have the \'form-group\' class';
                    }
                    return linkFn;
                }
            };
        }
    );

    app.provider('showErrorsConfig', function () {
        var _showSuccess;
        _showSuccess = false;
        this.showSuccess = function (showSuccess) {
            return _showSuccess = showSuccess;
        };
        this.$get = function () {
            return {showSuccess: _showSuccess};
        };
    });



    app.directive("mainHeader", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/main/main-header.html"
        };
    });
    app.directive("mainFooter", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/main/main-footer.html"
        };
    });

    app.directive("wichtigeInformationen", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/incoming/wichtige-informationen.html"
        };
    });
    app.directive("incomingInfosGermany", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/incoming/incoming-infos-germany.html"
        };
    });
    app.directive("incomingArrival", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/incoming/incoming-arrival.html"
        };
    });
    app.directive("incomingInsurance", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/incoming/incoming-insurance.html"
        };
    });
    app.directive("incomingLearnGerman", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/incoming/incoming-learn-german.html"
        };
    });

    app.directive("outgoingBetreuung", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-betreuung.html"
        };
    });
    app.directive("outgoingBewerbungsverfahren", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-bewerbungsverfahren.html"
        };
    });
    app.directive("outgoingBezahlung", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-bezahlung.html"
        };
    });
    app.directive("outgoingErfahrungsberichte", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-erfahrungsberichte.html"
        };
    });
    app.directive("outgoingFaq", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-faq.html"
        };
    });
    app.directive("outgoingInfos", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-infos.html"
        };
    });
    app.directive("outgoingOffers", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-offers.html"
        };
    });
    app.directive("outgoingOnlinebewerbung", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-onlinebewerbung.html"
        };
    });
    app.directive("outgoingOnlinebewerbungForm", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-onlinebewerbung-form.html"
        };
    });
    app.directive("outgoingUnterlagen", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/outgoing-unterlagen.html"
        };
    });
    app.directive("lcFreibergAllgemein", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/lcfreiberg/lcfreiberg-allgemein.html"
        };
    });
    app.directive("lcFreibergBuro", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/lcfreiberg/lcfreiberg-buro.html"
        };
    });
    app.directive("lcFreibergDownloads", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/lcfreiberg/lcfreiberg-downloads.html"
        };
    });
    app.directive("lcFreibergLc", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/lcfreiberg/lcfreiberg-lc.html"
        };
    });
    app.directive("lcFreibergMitmachen", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/lcfreiberg/lcfreiberg-mitmachen.html"
        };
    });
    app.directive("lcFreibergNews", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/lcfreiberg/lcfreiberg-news.html"
        };
    });
    app.directive("contactContact", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/contact/contact-contact.html"
        };
    });
    app.directive("contactImpressum", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/contact/contact-impressum.html"
        };
    });
    app.directive("firmenInfos", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/firmen/firmen-infos.html"
        };
    });
    app.directive("firmenPraktikumAnbieten", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/firmen/firmen-praktikum-anbieten.html"
        };
    });
    app.directive("firmenVorteile", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/firmen/firmen-vorteile.html"
        };
    });
    app.directive("formCountry", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/onlineForm/form-country.html"
        };
    });
    app.directive("formData", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/onlineForm/form-data.html"
        };
    });
    app.directive("formLanguages", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/onlineForm/form-languages.html"
        };
    });
    app.directive("formPraktikum", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/onlineForm/form-praktikum.html"
        };
    });
    app.directive("formSonstiges", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/onlineForm/form-sonstiges.html"
        };
    });
    app.directive("formStudium", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/onlineForm/form-studium.html"
        };
    });
    app.directive("formButton", function() {
        return {
            restrict: 'E',
            templateUrl: "partials/outgoing/onlineForm/form-button.html"
        };
    });

})();
