@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3><b>Dashboard</b></h3>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">category</i>
                            </div>
                            <p class="card-category">Total Category</p>
                            <h3 class="card-title">{{ $category }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">shopping_bag</i>
                            </div>
                            <p class="card-category">Total Product</p>
                            <h3 class="card-title">{{ $product }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">shopping_cart</i>
                            </div>
                            <p class="card-category">Total Order</p>
                            <h3 class="card-title">{{ $order }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">payments</i>
                            </div>
                            <p class="card-category">Total Sales</p>
                            <h3 class="card-title">RM {{ $amt_sales }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-stats" id="piechart" style="height: 300px"></div>

                </div>
                <div class="col-lg-6">

                    <div class="card card-stats" id="chart_div" style="height: 300px"></div>
                </div>





            </div>

        @endsection

        @section('scripts')
            <script>
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawpieChart);

                function drawpieChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Category', 'No.of Product'],
                        <?php echo $chartData; ?>

                    ]);

                    var options = {
                        title: 'No. of Product by Category',
                        is3D: true,

                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }

                // google.charts.load('current', {
                //     'packages': ['corechart']
                // });
                google.charts.load('current', {
                    packages: ['corechart', 'line']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Month', 'Sales'],
                        <?php echo $chartSales; ?>
                    ]);

                    var options = {
                        title: 'No. of Sales by Month',
                        hAxis: {
                            title: 'Month'
                        },
                        vAxis: {
                            title: 'Sales in RM'
                        }

                    };

                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

                    chart.draw(data, options);
                }
            </script>



        @endsection
