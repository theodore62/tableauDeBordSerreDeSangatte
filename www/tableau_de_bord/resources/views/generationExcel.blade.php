@extends('template')
{{-- @extends('annuelles') --}}
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close btn btn-outline-secondary" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
                {{ Session::get('success') }}
            </strong>
        </div>
    @endif
    @if (Session::get('info'))
        <div class="alert alert-info alert-block">
            <button type="button" class="close btn btn-outline-secondary" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ Session::get('info') }}</strong>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close btn btn-outline-secondary" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('status') }}
        </div>
    @endif
    <div class="uk-overlay  uk-container uk-container-large uk-margin-large tableau">
        <form action="{{ route('generationExcel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <ul class="uk-subnav uk-subnav-pill" uk-switcher>
                <li><a href="#">Annuelles</a></li>
                <li><a href="#">Vivaces</a></li>
                <li><a href="#">Aromatique</a></li>
                <li><a href="#">Légumes</a></li>
                <li><a href="#">Fruits</a></li>
            </ul>
            <ul class="uk-switcher uk-margin affichageDonnees">
                <li>@include('categories.annuelles')</li>
                <li>@include('categories.vivaces')</li>
                <li> @include('categories.aromatique')</li>
                <li> @include('categories.legumes')</li>
                <li> @include('categories.fruits')</li>
            </ul>
            {{-- <input type="text" name="name" placeholder="Nom de fichier"> --}}
            <div class="row mb-3">
                <div class="col-sm-3">
                    <input type="text" class="form-control  @error('nomFichier') is-invalid @enderror" name="nomFichier"
                        id="nomFichier" placeholder="Nom de fichier" value="{{ old('nomFichier') }}">
                    @error('nomFichier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-outline-light">Exporter</button>
                </div>
            </div>
        </form>
    </div>
@endsection
