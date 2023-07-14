<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Código</th>
        <th>Mês</th>
        <th>Tipo Instituição</th>
        <th>Instituição</th>
        <th>Tipo Concurso</th>
        <th>Referência</th>
        <th>Categoria</th>
        <th>Sub-Categoria</th>
        <th>Garantia Provisoria</th>
        <th>Prémio</th>
        <th>Garantia Definitiva</th>
        <th>Prémio</th>
        <th>Garantia Adiatamento</th>
        <th>Prémio</th>
        <th>Data Entrega Proposta</th>
        <th>Valor do Caderno.Enc</th>
        <th>Resultado</th>
        <th>Motivo</th>
        <th>Descrição do Motivo</th>
        <th>Fase/Estágio</th>
        <th>Valor Proposta</th>
        <th>Responsável</th>
        <th>Responsável Rev.Prop.Técnica</th>
        <th>Responsável Rev.Documental</th>

    </tr>
    </thead>
    <tbody>
    @foreach($competitions as $competition)
        <tr>

            <td>{{$competition->id}}</td>
            <td>{{$competition->internal_reference}}</td>
            <td>{{$competition->competition_month}}</td>
            <td>{{$competition->companyType->name?? ''}}</td>
            <td>{{\App\Models\Company::find($competition->customer_id)->name}}</td>

            <td>{{$competition->competitionType->name}}</td>
            <td>{{$competition->competition_reference}}</td>
            <td>

                @foreach ($competition->productCategory as $categoria)

                    {{ '-'.$categoria->name }}<br>
                @endforeach</td>
            <td>


                @foreach (\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->get()
                     as $subcategory)
                    {{'-'.\App\Models\ProductSubCategory::find($subcategory->product_sub_category_id)->name}}<br>

                @endforeach


            </td>
            <td>{{$competition->provisional_bank_guarantee}}</td>
            <td>{{$competition->provisional_bank_guarantee_award}}</td>
            <td>{{$competition->definitive_guarantee}}</td>
            <td>{{$competition->definitive_guarantee_award}}</td>
            <td>{{$competition->advance_guarantee}}</td>
            <td>{{$competition->advance_guarantee_award}}</td>
            <td>{{$competition->proposal_delivery_date}}</td>
            <td>{{$competition->bidding_documents_value}}</td>
            <td>{{$competition->competitionResult->name?? ''}}</td>
            <td>{{$competition->competitionReason->name?? ''}}</td>
            <td>{{$competition->reason_description}}</td>
            <td>{{$competition->competitionStatus->name??''}}</td>
            <td>{{$competition->proposal_value}}</td>
            <td>{{$competition->responsible}}</td>
            <td>{{$competition->technical_proposal_review}}</td>
            <td>{{$competition->documentary_review}}</td>


        </tr>
    @endforeach
    </tbody>
</table>
