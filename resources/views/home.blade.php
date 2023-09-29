 <x-mainlayout>
  <x-slot name="content">
    @if(sizeof($allpokemons) <= 0)
    {
      <h1>SORRY!!! THERE ARE NO POKEMONS HERE!</h1>
    }
    @endif
    @foreach($allpokemons as $pokemon)
      <x-pokemon-card :pokemon="$pokemon" :loop="$loop"/>
    @endforeach
    <div id="pagination-wrapper">
      {{ $allpokemons->links()}}
    </div>
  </x-slot>
 </x-mainlayout>