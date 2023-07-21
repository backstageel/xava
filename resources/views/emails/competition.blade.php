<!DOCTYPE html>
<html>
<head>
    <title>Notificação de Concurso</title>
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
<h3>Notificação de Concurso</h3>
<p>Olá, <strong>{{ $username }}!</strong></p>
<p>Lembramos que as datas de entrega das propostas para os seguintes concursos são:</p>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
                <thead>
                <tr style="border-bottom: 2px solid #ddd;">
                    <th>Código</th>
                    <th>Mês</th>
                    <th>Tipo Instituição</th>
                    <th>Instituição</th>
                    <th>Tipo Concurso</th>
                    <th>Referência</th>
                    <th>Data da Entrega</th>
                </tr>
                </thead>
                <tbody>
                @foreach($competitions as $competition)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td>{{ $competition->internal_reference }}</td>
                        <td>{{ $competition->competition_month }}</td>
                        <td>{{ $competition->companyType->name ?? '' }}</td>
                        <td>{{ \App\Models\Company::find($competition->customer_id)->name }}</td>
                        <td>{{ $competition->competitionType->name }}</td>
                        <td>{{ $competition->competition_reference }}</td>
                        <td>{{ $competition->proposal_delivery_date }}</td>
                    </tr>
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
