<br>
<div style="text-align: center;"><b>Aviso Importante:</b> O termo deve ser entregue assinado para a instituição no mínimo 10 dias úteis antes do início do estágio no email estagiosfflch@usp.br</div>
<br>

@can('admin')

<div class="card">
<div class="card-header"><b>Justificativa da análise técnica</b></div>
<div class="card-body">

<form method="POST" action="/analise_tecnica/{{$estagio->id}}">
    @csrf
    <div class="row">
        <div class="form-group">
            <textarea name="analise_tecnica" rows="5" cols="60">{{old('analise_tecnica',$estagio->analise_tecnica)}}</textarea>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-info" name="analise_tecnica_action" value="indeferimento_analise_tecnica">
            Devolver para empresa
        </button>

        <button type="submit" class="btn btn-success" name="analise_tecnica_action" value="enviar_assinatura"
            onClick="return confirm('Tem certeza que quer enviar para Assinatura?')" >
            Enviar para assinatura
        </button>

        <button type="submit" class="btn btn-success" name="analise_tecnica_action" value="deferimento_analise_tecnica"
            onClick="return confirm('Tem certeza que quer enviar para Parecer?')" >
            Enviar para parecerista
        </button>
        
        <button type="submit" class="btn btn-warning" name="analise_tecnica_action" value="concluir">Concluir Estágio </button>
    </div>

</form>

<div class="card">
    <div class="card-header"><b>Área de Administrador</b></div> 
      <div class="card-body">
        @include('estagios.partials.gerenciar_estagio')
      </div>
    </div>
</div>
<br><br>

@endcan('admin')
<br>

@if(!empty($estagio->analise_academica))
    <b>Parecerista:</b> {{ $estagio->parecerista->numero_usp }} <br>
    <b>Parecer de Mérito:</b> {{$estagio->analise_academica}}<br>
@endif

@can('empresa')

@foreach($estagio->aditivos->where('aprovado_graduacao','=',0)->where('comentario_graduacao','=',null) as $aditivo)
<br>
<b>Opções de Aditivo Pendente</b>
<form method="GET" action="/pdfs/aditivo/{{$estagio->id}}">
    @csrf
    <button type="submit" class="btn btn-info" name="aditivo_action" value="pendente">
        <i class="fas fa-file-pdf"></i> Gerar PDF com requisição do Aditivo
    </button>
</form>

@endforeach

@endcan('empresa')

<br>

</div>  
</div>
