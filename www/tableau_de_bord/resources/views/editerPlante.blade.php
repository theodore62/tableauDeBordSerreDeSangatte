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
    <h2 class="titre">Liste des plantes</h2>
    <div class="container">

        <div class=" uk-overlay  uk-container uk-container-xlarge uk-margin-small ">
            <div class="uk-container d-flex justify-content-around">
                <div class="uk-container-xlarge uk-overlay uk-overlay-secondary">
                    <form class="d-flex" id="search" action="editerPlante" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="search" class="form-control  @error('search') is-invalid @enderror" name="search"
                                id="" placeholder="recherche" value="{{ old('search') }}">
                            @error('search')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" id="updateForm" class="btn btn-outline-light"><span uk-icon="icon: search; ratio: 0.8"></span></button>
                    </form>
                    <div class="affichageDonnees">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">nom</th>
                                    <th scope="col">varieter</th>
                                    <th scope="col">couleur</th>
                                    <th scope="col">conditionnement</th>
                                    <th scope="col">prix</th>
                                    <th scope="col">catégorie</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($plantes as $plante)
                                <tr>
                                    <td>{{ $plante->nom }}</td>
                                    <td>{{ $plante->varieter }}</td>
                                    <td>{{ $plante->couleur }}</td>
                                    <td>{{ $plante->conditionnement }}</td>
                                    <td>{{ $plante->prix }}</td>
                                    <td>{{ $plante->categorie }}</td>
                                    <td>
                                        <div class="col uk-flex">
                                            <button type="button" class="btn btn-outline-info update" id="update"
                                                data-id="{{ $plante->id }}" data-toggle="modal" data-target="#edite"
                                                data-whatever="@fat">
                                                <span uk-icon="icon:  file-edit; ratio: 1"></span>
                                            </button>
                                            <form action="{{ route('editerPlante.destroy', $plante->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger edit" type="submit">
                                                    <span uk-icon="icon: trash; ratio: 1"></span>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (isset($plante))
        <!-- Modal -->
        <div class="modal fade" id="edite" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edite"
            aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifier">Editer la plante</h5>
                        <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form id="update" action="editerPlante/{{ $plante->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div>
                                        <input type="hidden" name="id" id="id" value="{{ old('id') }}" />
                                    </div>
                                    <label>Nom de la plante:</label>
                                    <input type="text" class="form-control  @error('nom') is-invalid @enderror" name="nom"
                                        id="nomUpdate" placeholder="nom de la plante" value="{{ old('nom') }}">
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Varieter de la plante:</label>
                                    <input type="text" class="form-control  @error('varieter') is-invalid @enderror"
                                        name="varieter" id="varieterUpdate" placeholder="la variété de la plante"
                                        value="{{ old('varieter') }}">
                                    @error('varieter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Couleur de la plante:</label>
                                    <input type="text" class="form-control  @error('couleur') is-invalid @enderror"
                                        name="couleur" id="couleurUpdate" placeholder="la couleur de la plante"
                                        value="{{ old('couleur') }}">
                                    @error('couleur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Conditionnement de la plante:</label>
                                    <input type="text" class="form-control  @error('conditionnement') is-invalid @enderror"
                                        name="conditionnement" id="conditionnementUpdate"
                                        placeholder="la conditionnement de la plante"
                                        value="{{ old('conditionnement') }}">
                                    @error('conditionnement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Prix de la plante:</label>
                                    <input type="text" class="form-control  @error('prix') is-invalid @enderror" name="prix"
                                        id="prixUpdate" placeholder="la prix de la plante" value="{{ old('prix') }}">
                                    @error('prix')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    <select class="form-select " aria-label="categorie de la plante" @error('categorie')
                                        is-invalid @enderror name="categorie" id="categorieUpdate"
                                        value="{{ old('categorie') }}">
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" id="updateForm"
                                        class="btn btn-primary updateForm">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
