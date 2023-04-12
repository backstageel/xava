<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pedido de emprestimo</title>
</head>
<body>
    <p>XAVA</p>
    <p>Formulário Requisição de Financiamento</p>
    <p style="text-align:left; ">Data:___/___/____</p>
    <div>
        <p style=" bgcolor:gray; text-align: center;"> Informações do solicitante</p>
        <p>Nome Colaborador:  {{$full_name}}</p>
        <p>Cargo: {{$employee_position}}</p>
        <p>
        <table>
            <tr cellspacing="5">
                <td >Valor Solicitado</td>
                <td>Valor da Prestacao</td>
                <td>Total de Prestações</td>
            </tr>
            <tr>
                <td>{{$amount}}</td>
                <td>{{$installment}}</td>
                <td>{{$months}}</td>
            </tr>
        </table>
    </div>

    <div>
        <p style=" bgcolor:gray; text-align: center;">A ser preenchido pelos orgãos de Gestão</p>


        <table>
            <tr>
                <td><input type="radio"  >
                    <label >Aprovado:</label>
                    <br>
                </td>

                <td>Valor do financiamento</td>
                <td>______________________</td>
            </tr>
            <tr>
                <td>
                    <input type="radio"  >
                    <label >Nao Aprovado:</label>
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    Motivo:
                </td>
                <td colspan="2">__________________________</td>

            </tr>
        </table>
        <p>Observações ___________________________________</p>
        <p>Aprovado por ___________________________________</p>
        <p>Data ___/___/____</p>
    </div>
</body>
</html>
