<table >
    <thead>
    <tr>
        <th>#</th>
        <th>Data de Venda</th>
        <th>Nome Cliente</th>
        <th>Descricao</th>
        <th>Referencia</th>
        <th>Estado da Venda</th>
        <th>Preco de Venda Total</th>
        <th>Nr da Factura</th>
        <th>Método de Pagamento</th>
        <th>Valor Recebido</th>
        <th>Nr De Recibo</th>
        <th>Despesas de Transporte</th>
        <th>Comissão de Intermediários</th>
        <th>Outras Despesas</th>
        <th>Divida</th>
        <th>Data de Pagamento</th>



    </tr>
    </thead>
    <tbody>
    @foreach($sales as $sale)
        <tr>
            <td>{{$sale->id}}</td>
            <td>{{$sale->sale_date}}</td>
            <td>{{$sale->customer_name}}</td>
            <td>{{$sale->notes}}</td>
            <td>{{$sale->sale_ref}}</td>
            <td>{{$sale->saleStatus->name}}</td>
            <td>@money($sale->total_amount)</td>
            <td>{{$sale->invoice_id}} </td>
            <td>{{$sale->payment_method}}</td>
            <td>@money($sale->amount_received)</td>
            <td>{{$sale->receipt_id}}</td>
            <td>@money($sale->transport_value) </td>
            <td>@money($sale->intermediary_committee) </td>
            <td>@money($sale->other_expenses) </td>
            <td>@money($sale->debt_amount) </td>
            <td>{{$sale->payment_date}} </td>

        </tr>
    @endforeach

    </tbody>
    <tfoot>
    </tfoot>
</table>
