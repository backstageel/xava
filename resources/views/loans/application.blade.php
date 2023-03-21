<!DOCTYPE html>
<html>
    <head> Pedido de emprestimo</head>
    <body>
        <p>Eu,{{$employee->name}}, venho por meio desta fazer o pedido do emprestimo a empresa com os seguintes dados</p>
        <br>
        <h5 class="d-flex align-items-center mb-3">Dados do Empretimo</h5>
        <ul class="list-group list-group-flush">


            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Codigo do Colaborador</h6>
                <span class="text-secondary">{{$employee->name}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Valor do emprestimo</h6>
                <span class="text-secondary">{{$loan->amount}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Prestacao Mensal</h6>
                <span class="text-secondary">{{$loan->installment}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">Meses</h6>
                <span class="text-secondary">{{$loan->months}}</span>
            </li>
        </ul>
    </body>
</html>
