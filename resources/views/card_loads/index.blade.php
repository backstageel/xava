@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Saldo</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Saldo Disponivel</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
{{--            @if(\App\Models\CardLoad::count() == 0)--}}
                <div class="btn-group">
                    <a href="{{route('card_loads.create')}}" class="btn btn-primary">Recarregar</a>
                </div>
{{--            @endif--}}
            <br>
            <br>
            <br>
            <div class="btn-group" readonly>
                <a href="" class="btn btn-info" style="color: white; font-weight: bold;">Saldo Disponivel: {{$total_cards->total_amount}} MT</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Carregamento do Cartão</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Montante</th>
                        <th>Data da Recarga</th>
                        <th>Descrição</th>
{{--                        <th><p style="display: none;">.</p></th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($card_loads as $card_load)
                        <tr>
                            <td>{{$card_load->id}}</td>
                            <td>{{$card_load->balance}}</td>
                            <td>{{$card_load->updated_at}}</td>
                            <td>{{$card_load->description}}</td>
{{--                            <td>--}}
{{--                                <a href="{{route('card_loads.edit', $card_load->id)}}"> Recarregar </a>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
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
@endsection
