@extends('layout')
@section('content')

@if (session('alert-msg'))
<div>
  {{ session('alert-msg') }}
</div>
@endif

<form method="POST" action="{{route('movimentos.update', ['movimento'=>$movimento])}}" novalidate class="form-group">
	@csrf
    @method('PUT')
    @include('movimentos.partials.create-edit')
        @empty($movimento->imagem_doc)
        @else
            <div class="form-group">
                <img src="{{$movimento->imagem_doc ? asset('doc/' . $movimento->imagem_doc) : asset('img/default_img.png') }}"
                     alt="Imagem do documento"  class="img-profile"
                     style="max-width:100%">
            </div>
        @endempty
        <div class="form-group text-right">
            @empty($movimento->imagem_doc)
            @else
                    <button type="submit" class="btn btn-danger" name="deletedoc" form="form_delete_photo">Apagar Documento</button>
            @endempty
                    <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('movimentos.edit', ['movimento' => $movimento]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{route('movimentos.doc.destroy', ['movimento' => $movimento])}}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
