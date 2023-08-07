<table >
    <thead>
    <tr>
        <th colspan="6">
            <strong>Objectivo de Vendas de motas e bicicletas ano</strong>
        </th>
    </tr>

    <tr>
        <th ><strong>Contratos</strong></th>
        <th ><strong>Descrição</strong></th>
        <th><strong>No da Factura</strong></th>
        <th><strong>Contratos meta @money($limit)</strong></th>
        <th><strong>Execução- Entrega, Guias e Facturado</strong></th>
        <th><strong>Pago</strong></th>
        <th rowspan="2"> <strong>saldo</strong></th>
        <th rowspan="2"><strong>Obs</strong></th>
    </tr>
    <tr>
        <th>Entidades</th>
        <th><p style="display: none;"> </p></th>
        <th>{{$rolling_stock_sales*100/$limit}}%</th>
        <th>{{$on_going_rolling_stock_sales*100/$limit}}%</th>
        <th>{{$paid_rolling_stock_sales*100/$limit}}%</th>
    </tr>

    </thead>
    <tbody>

    @foreach($sales as $sale)
        <tr>
            <td><strong>{{$sale->customer_name}}</strong></td>
            <td>{{$sale->notes}}</td>
            <td><strong>{{$sale->invoice_id}}</strong></td>
            <td>@money($sale->total_amount)</td>
            @if($sale->saleStatus->name == "Facturado" || $sale->saleStatus->name == "Pago")
                <td>@money($sale->total_amount)</td>
                <td>@money($sale->amount_received)</td>
            @else
                <td><p style="display: none;"> </p></td>
                <td><p style="display: none;"> </p></td>
            @endif
            <td><p style="display: none;"> </p></td>
            <td><p style="display: none;"></p> </td>

        </tr>

    @endforeach
    <tr>
        <th><strong>Total</strong></th>
        <td>
            <p style="display: none;"> </p>
        </td>
        <th><strong>{{$rolling_stock_sales}}</strong></th>
        <th><strong>{{$on_going_rolling_stock_sales}}</strong></th>
        <th><strong>{{$paid_rolling_stock_sales}}</strong></th>

    </tr>
    </tbody>
    <tfoot>
    </tfoot>
</table>
