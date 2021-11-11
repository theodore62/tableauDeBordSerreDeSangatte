{{-- @extends('layouts.app') --}}
@extends('template')
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
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{{ Session::get('info') }}</strong>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="titre">Ajouter une plante</h2>
    <div class="container">
        <div class=" uk-overlay  uk-container uk-container-small uk-margin-small ">
            <div class="uk-container d-flex justify-content-around">
                <div class="uk-container-xlarge uk-overlay uk-overlay-secondary">
                    <form action="{{ route('ajouterPlante.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  @error('nom') is-invalid @enderror" name="nom"
                                    id="nom" placeholder="nom de la plante " value="{{ old('nom') }}">
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="varieter" class="col-sm-2 col-form-label">Variétée</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  @error('varieter') is-invalid @enderror"
                                    name="varieter" id="varieter" placeholder="Variétée de la plante "
                                    value="{{ old('varieter') }}">
                                @error('varieter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="couleur" class="col-sm-2 col-form-label">Couleur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  @error('couleur') is-invalid @enderror"
                                    name="couleur" id="couleur" placeholder="couleur de la plante "
                                    value="{{ old('couleur') }}">
                                @error('couleur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="conditionnement" class="col-sm-2 col-form-label">Conditionnement</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  @error('conditionnement') is-invalid @enderror"
                                    name="conditionnement" id="conditionnement" placeholder="conditionnement de la plante "
                                    value="{{ old('conditionnement') }}">
                                @error('conditionnement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="prix" class="col-sm-2 col-form-label">Prix</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  @error('prix') is-invalid @enderror" name="prix"
                                    id="prix" placeholder="prix de la plante " value="{{ old('prix') }}">
                                @error('prix')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="prix" class="col-sm-2 col-form-label">Catégories</label>
                            <div class="col-sm-10">
                                <select class="form-select " aria-label="categorie de la plante" @error('categorie')
                                    is-invalid @enderror name="categorie" id="categorie" value="{{ old('categorie') }}">
                                    <option selected>categorie de la plante</option>
                                    <option value="annuelles">Annuelles</option>
                                    <option value="vivaces">Vivaces</option>
                                    <option value="aromatiques">Aromatiques</option>
                                    <option value="legumes">Légumes</option>
                                    <option value="fruits">Fruits</option>
                                </select>
                                @error('categorie')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-light">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
