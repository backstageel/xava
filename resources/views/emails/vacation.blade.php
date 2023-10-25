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
<h3>Assunto: <strong>Atualização das Suas Férias</strong></h3>
<p>Prezado(a) <strong>{{ $username }}!</strong></p>
@if($subject != 'actualização')
<p>Gostaríamos de informá-lo(a) que às suas férias solicitadas foram {{$subject}}.</p>
@else
    <p>Gostaríamos de informá-lo(a) que às datas das suas férias solicitadas foram actualizadas.</p>
@endif
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
                <thead>
                <tr style="border-bottom: 2px solid #ddd;">
                    <th>Código</th>
                    <th>Dia de Inicio</th>
                    <th>Dia de Fim</th>
                    <th>Nr de Dias</th>
                </tr>
                </thead>
                <tbody>

                    <tr style="border-bottom: 1px solid #ddd;">
                        <td>{{ $vacation->internal_reference }}</td>
                        <td>{{ $vacation->start_date }}</td>
                        <td>{{ $vacation->end_date}}</td>
                        <td>{{ $vacation->number_of_days}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<p>Atenciosamente,</p>
<p>Departamento de Sistemas de Informação (DSI)</p>
</body>
</html>
