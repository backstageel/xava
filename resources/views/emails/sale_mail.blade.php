<!DOCTYPE html>
<html>
<head>
    <title>Notificação de Vendas</title>
    <style>
        th{
            padding: 8px;
            text-align: left;
        }
        td{
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<h3>Notificação de Vendas</h3>
<p>Olá</p>
<p>Lembramos que as seguintes vendas estao no estado de facturadas :</p>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
                <thead>
                <tr style="border-bottom: 2px solid #ddd;">
                    <th>Código</th>
                    <th>Nome do Cliente</th>
                    <th>Estado</th>
                    <th>Preço Total da Venda</th>

                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    @if($sale->saleStatus->name == "Facturado")
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td>{{$sale->internal_reference}}</td>
                            <td>{{$sale->customer_name}}</td>
                            <td>{{$sale->saleStatus->name}}</td>
                            <td>{{$sale->total_amount }}</td>

                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<p>Lembramos que as seguintes vendas estao no estado de cotação :</p>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
                <thead>
                <tr style="border-bottom: 2px solid #ddd;">
                    <th>Código</th>
                    <th>Nome do Cliente</th>
                    <th>Estado</th>
                    <th>Preço Total da Venda</th>

                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    @if($sale->saleStatus->name == "cotação")
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td>{{ 0 }}</td>
                            <td>{{$sale->customer_name}}</td>
                            <td>{{$sale->saleStatus->name}}</td>
                            <td>{{$sale->total_amount }}</td>

                        </tr>
                    @endif
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<p>Lembramos que as seguintes vendas estao no estado de Pago :</p>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
                <thead>
                <tr style="border-bottom: 2px solid #ddd;">
                    <th>Código</th>
                    <th>Nome do Cliente</th>
                    <th>Estado</th>
                    <th>Preço Total da Venda</th>

                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    @if($sale->saleStatus->name == "Pago")
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td>{{ 0 }}</td>
                            <td>{{$sale->customer_name}}</td>
                            <td>{{$sale->saleStatus->name}}</td>
                            <td>{{$sale->total_amount }}</td>

                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<p>Atenciosamente,</p>
<p>Departamento de Sistemas de Informação (DSI)</p>
</body>
</html>
