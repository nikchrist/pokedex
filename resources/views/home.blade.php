 <x-mainlayout>
  <x-slot name="content">
    @foreach($allpokemons as $pokemon)
      <x-pokemon-card :pokemon="$pokemon" :loop="$loop"/>
    @endforeach
    <div id="pagination-wrapper">
      {{ $allpokemons->links()}}
    </div>
  </x-slot>
 </x-mainlayout>