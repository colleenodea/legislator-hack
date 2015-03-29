angular.module('leg', [])

.controller('LegCtrl', function($scope) {

    // bills, politicians, votes
    $scope.data = window.bootstrap;
    $scope.filtered = {
        selectBills: []
    };

    $scope.options = {
        politician: null
    };

        console.log($scope.data);

    $scope.changePolitician = function() {
        var bills = [];

        if(!$scope.options.politician.history)
            $scope.options.politician.history = [];

        for(var i = 0; i < $scope.data.votes.length; i++) {
            if($scope.data.votes[i].politician_id == $scope.options.politician.politician_id) {
                for(var j = 0; j < $scope.data.bills.length; j++) {
                    if($scope.data.votes[i].bill_id == $scope.data.bills[j].bill_id) {
                        bills.push({
                            bill: $scope.data.bills[j],
                            vote: $scope.data.votes[i]
                        });
                    }
                }
            }
        }

        angular.copy(bills, $scope.options.politician.history);

        console.log('Data' , bills, $scope.options.politician.history);
    }

});