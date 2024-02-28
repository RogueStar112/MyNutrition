<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-flow-row-dense mx-4 grid-cols-1 md:grid-cols-3 md:grid-rows-3 gap-3">
              
              

              @foreach($meal_items as $meal_time => $meal_item) 
              <div>
                  <p>{{$meal_time}}</p>

                  @foreach($meal_item as $item)
                      <p class="text-orange-500">{{$item->name}}</p>

                      @foreach($meal_macros["$meal_time"] as $meal_index => $meal_macro)

                        MI: {{$meal_index}} 


                        @foreach($meal_macro as $index => $macro)

                          
                          @if(isset($meal_macro["$meal_index"]))
                            <p class="text-blue-400">Calories: {{$meal_macro["$meal_index"][$index]->calories}}</p>
                          
                          @else

                            @if($meal_index == 'total')

                            {{-- <p class="text-blue-200">{{$meal_macro["total"]}}</p> --}}

                            @endif
                          
                          @endif


                        @endforeach
                      @endforeach

                  @endforeach
                

              </div>
              @endforeach
 
            </div>
            
        
            

        </div>
    </div>
</x-app-layout>
