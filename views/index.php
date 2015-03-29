<?php // Lord, forgivith me for this spaghetti code, but time is tight



?>
<html>
    <head>
        <title>Hack Jersey</title>
        <style>@import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css");</style>
        <style>@import url("<?php echo index_url('assets/leg.css') ?>");</style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular.min.js"></script>
        <script src="<?php echo index_url('assets/leg.js') ?>"></script>
        <script>
            window.bootstrap = {
                politicians: <?php echo json_encode(Data::getData('politicians')) ?>,
                bills: <?php echo json_encode(Data::getData('bills')) ?>,
                votes: <?php echo json_encode(Data::getData('politicians-bills')) ?>
            };
        </script>
    </head>
    <body>
        <div id="main" ng-app="leg">

            <div ng-controller="LegCtrl">

                <select class="form-control" ng-change="changePolitician()" ng-options="p as (p.name + ' (District ' + p.district + ')') for p in data.politicians" ng-model="options.politician">
                    <option>-- Select a Politician</option>
                </select>

                <div class="politician-info" ng-if="options.politician">
                    <table>
                        <tr ng-repeat="(key, val) in options.politician">
                            <td ng-hide="key === 'history'">
                                <strong>{{key}}</strong>
                            </td>
                            <td ng-hide="key === 'history'">
                                {{val}}
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="vote-info" ng-if="options.politician && options.politician.history.length > 0">
                    <h1>Voting History on Select Bills</h1>
                    <div ng-repeat="h in options.politician.history">
                        <div>
                            <h2>Bill: {{ h.bill.bill_name }} ({{ h.bill.bill_year}}) </h2>
                            <p>{{h.bill.bill_description}}</p>
                            <table>
                                <tr>
                                    <td>
                                        <strong>Total For</strong>
                                    </td>
                                    <td>
                                        {{ h.bill.bill_total_for }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Total Against</strong>
                                    </td>
                                    <td>
                                        {{ h.bill.bill_total_against }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>{{ options.politician.name }} Vote</strong>
                                    </td>
                                    <td>
                                        Voted '{{ h.vote.vote }}' in {{ h.vote.vote_date }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </body>
</html>