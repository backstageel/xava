@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Minhas Férias</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Férias</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="col-12 col-lg-4">
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Equipamento Electrónico</h6>
                            <br>
                            <spam><strong>meta:</strong>100.000.000,00 MT</spam>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container-0">
                        <canvas id="vacation-chart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->



@endsection

@section("script")
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{asset('')}}assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{asset('')}}assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="{{asset('')}}assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#example2').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            });
        });
    </script>

    </script>

    <script>
        $(document).ready(function() {
            $('.table-container').on('scroll', function() {
                var scrollLeft = $(this).scrollLeft();
                $('#vacation-table thead, #vacation-table tbody').scrollLeft(scrollLeft);
            });
        });
    </script>



    <script>
        var ctx = document.getElementById('vacation-chart').getContext('2d');
        var vacationData = @json($vacationData);

        var labels = Object.keys(vacationData);
        var datasets = labels.map(function(label) {
            var data = Array.from({ length: 30 }, (_, i) => i + 1).map(function(day) {
                return vacationData[label].includes(day) ? 1 : 0;
            });

            return {
                label: label,
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            };
        });

        var chart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: Array.from({ length: 30 }, (_, i) => i + 1),
                datasets: datasets
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        reverse: true
                    }
                }
            }
        });
    </script>


@endsection
