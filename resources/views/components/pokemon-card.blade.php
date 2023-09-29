<div class="poke-wrapper {{$loop->odd?'bg-blue':'bg-cyan'}}">
        <div class="general-info">
            <div class="row text-center d-md-flex gx-5 align-items-center" style="min-height: 20vh">
                <div class="col-xs-12 col-md-6">
                    <div class="poke-info">
                        <div class="poke-height-weight">
                            <div class="row">
                                <div class="col-sm-6 height">
                                    <p>{{ $pokemon->height }} m</p>
                                </div>
                                <div class="col-sm-6 weight">
                                    <p>{{ $pokemon->weight }} kg</p>
                                </div>
                            </div>
                            <div class="poke-maininfo-wrapper">
                                <span class="poke-id">#{{ $pokemon->pokemonid }}</span>
                                <div class="poke-image-wrapper">
                                    <img src="{{$pokemon->image}}" 
                                        alt="image of {{$pokemon->name}}" 
                                        title="{{$pokemon->name}}" 
                                    />
                                </div>
                                <div class="title"><h2>{{ $pokemon->name }}<h2></div>
                                <div class="categories">
                                    @foreach($pokemon->pokemon_categories as $pokemoncat)
                                            {{ $pokemoncat->name }} <span class="dot">&#9679;</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="pokemon-stats">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: {{ $pokemon->hp}}</li>
                            <li class="list-group-item">ATTACK: {{ $pokemon->attack}}</li>
                            <li class="list-group-item">DEFENCE: {{ $pokemon->defence}}</li>
                            <li class="list-group-item">SPEED: {{ $pokemon->speed}}</li>
                            <li class="list-group-item">SPECIAL ATTACK: {{ $pokemon->special_attack}}</li>
                            <li class="list-group-item">SPECIAL DEFENCE: {{ $pokemon->special_defence}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>