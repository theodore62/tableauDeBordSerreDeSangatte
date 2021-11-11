    <table class="table">
        <thead>
            <tr>
                <th scope="col">nom</th>
                <th scope="col">varieter</th>
                <th scope="col">couleur</th>
                <th scope="col">conditionnement</th>
                <th scope="col">prix</th>
                <th scope="col">catégorie</th>
                <th scope="col">disponibilitée</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-secondary">
                <td></td>
                <td></td>
                <td></td>
                <td>Annuelles</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($plantes as $plante)
                @if ($plante->categorie === 'annuelles')
                    <tr>
                        <td>{{ $plante->nom }}</td>
                        <td>{{ $plante->varieter }}</td>
                        <td>{{ $plante->couleur }}</td>
                        <td>{{ $plante->conditionnement }}</td>
                        <td>{{ $plante->prix }}</td>
                        <td>{{ $plante->categorie }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" role="switch" @error('checkbox') is-invalid
                                    @enderror name="{{ $plante->categorie }} {{ $plante->id }}" id="checkbox" value="{{ $plante->id }}">
                                @error('checkbox')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                {{-- <input class="form-check-input" type="checkbox" role="switch"
                                data-toggle="checkbox" data-id="{{ $plante->id}}"> --}}
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
