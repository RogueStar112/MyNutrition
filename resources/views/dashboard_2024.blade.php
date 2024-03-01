<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl [&>*]:max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-3xl ">

                <p class="text-white my-4">{{"Found " . count($meal_times) . " meals"}}</p>

        

                @foreach(array_reverse($meal_times) as $_ => $meal_time)

                    @php
                     $most_calories = 0;
                     $most_fat = 0;
                     $most_carbs = 0;
                     $most_protein = 0;
                    @endphp
                   
                    {{-- <br><p class="text-green-500">T: {{$meal_time}}</p> --}}

                    @foreach($meal_names[$meal_time] as $key => $meal_name)

                        @if($key == 'meal_name')
                            <div class="flex justify-between bg-stone-600 p-2 mb-2">
                                 <p class="text-orange-500 text-3xl font-extrabold" style="font-variant: small-caps">{{$meal_name}}</p>

                                 <div class="flex justify-between">
                                    <p class="text-2xl text-orange-400">{{DateTime::createFromFormat('Y-m-d H:i:s', $meal_time)->format('d M Y - H:i')}}</p>
                                    <button id="show-more-{{$key}}" class="bg-green-600 text-white text-center px-4 ml-4 rounded-lg text-2xl" value="{{$_}}">+</button>
                                 </div>
                            </div>
                        @endif

                        {{-- <div>Calories</div>
                        <div>Fat</div>
                        <div>Carbs</div>
                        <div>Protein</div> --}}


                    @endforeach

                    
{{-- 
                    <div class="grid" style="grid-template-rows: repeat({{ count($meal_items[$meal_time] )}}, 1fr); grid-template-columns: repeat(5, 1fr)">
                                               --}}
                        {{-- @foreach($meal_items[$meal_time] as $key => $meal_item)
                            
                            <div>
                                @if(count($meal_items[$meal_time]) > 1) 
                                    {{$meal_item['name']}}
                                @else
                                
                                @endif
                            </div>

  
                        @endforeach --}}

                        <div id="meal-items-{{$_}}" class="grid [&>*>*]:p-2 /[&>*>*]:m-2 [&>*>*]:bg-stone-800">

{{-- 
                            @foreach($meal_macros[$meal_time] as $key => $macro)

                 
                                    
                                    @if($macro['calories'] > $most_calories)
                                        @php $most_calories = $macro['calories']; @endphp
                                    @endif


                                    @if($macro['fat'] > $most_fat)
                                        @php $most_fat = $macro['fat']; @endphp
                                    @endif

   

                                    @if($macro['carbohydrates'] > $most_carbs)
                                        @php $most_carbs = $macro['carbohydrates']; @endphp
                                    @endif

  
      
                                    @if($macro['protein'] > $most_protein)
                                        @php $most_protein = $macro['protein']; @endphp
                                    @endif


         
                                    {{dd($most_calories, $most_fat, $most_carbs, $most_protein)}} 
                            @endforeach --}}
          


                        @foreach($meal_macros[$meal_time] as $_key => $meal_macro)

              
                            @php
                                
                                $filtered_macros = [];
                                            

                                    
                                // dd($filtered_macros);   
                                // dd($meal_macros_no_total);

                                $highest_calories = max(array_column($meal_macros_no_total[$meal_time], 'calories'));

                                 // dd($highest_calories);

                                $highest_fat = max(array_column($meal_macros_no_total[$meal_time], 'fat'));
                                $highest_carbs = max(array_column($meal_macros_no_total[$meal_time], 'carbohydrates'));
                                $highest_protein = max(array_column($meal_macros_no_total[$meal_time], 'protein'));

                                $highest_calories_index = array_search(max(array_column($meal_macros_no_total[$meal_time], 'calories')), array_column($meal_macros_no_total[$meal_time], 'calories'));
                                $highest_fat_index = array_search(max(array_column($meal_macros_no_total[$meal_time], 'fat')), array_column($meal_macros_no_total[$meal_time], 'fat'));
                                $highest_carbs_index = array_search(max(array_column($meal_macros_no_total[$meal_time], 'carbohydrates')), array_column($meal_macros_no_total[$meal_time], 'carbohydrates'));
                                $highest_protein_index = array_search(max(array_column($meal_macros_no_total[$meal_time], 'protein')), array_column($meal_macros_no_total[$meal_time], 'protein'));
                             

                                // dd($highest_calories, $highest_fat, $highest_carbs, $highest_protein)

                            @endphp

                            {{-- {{dd($meal_macros[$meal_time])}} --}}
                            {{-- @if($key == 'calories')
                                Calories: {{$meal_macro}}<br>
                            @endif --}}
                            {{-- <div class="grid grid-cols-6"> --}}
                            @if($_key != 'total') 
                            
                            <div class="grid grid-cols-5">
                                {{-- <div>Name</div>
                                <div>Calories</div>
                                <div>Fat</div>
                                <div>Carbs</div>
                                <div>Protein</div> --}}

                  



                            @foreach($meal_macro as $key => $macro)

                                    @php
                                        
                                    @endphp

                                    @if($key == 'name')
                                        <div class="flex text-stone-400 grow gap-2">{{$macro}}
                                            @if($_key == $highest_calories_index)
                                                <div class="most-calories h-[10px] w-[10px] rounded-full bg-blue-500"></div>
                                            @endif

                                            @if($_key == $highest_fat_index)
                                                <div class="most-fat h-[10px] w-[10px] rounded-full bg-red-500"></div>
                                            @endif

                                            @if($_key == $highest_carbs_index)
                                                <div class="most-carbs h-[10px] w-[10px] rounded-full bg-orange-500"></div>
                                            @endif

                                            @if($_key == $highest_protein_index)
                                                <div class="most-protein h-[10px] w-[10px] rounded-full bg-green-500"></div>
                                            @endif
                                        </div>
                                    
                                    @elseif($key == 'total')
                                        <div>TOTAL:</div>
                                        <div class="">{{$macro}}</div>



                                    @endif

                                



                            @endforeach

                            {{-- </div> --}}


                            
                            @foreach($meal_macro as $key => $macro)
                                @if($key == 'calories')
                                    <div class="text-blue-600 @if($highest_calories===$macro) font-black text-xl underline @endif">{{round($macro, 0)}}kcal</div>
                                @elseif($key == 'fat')


                                    <div class="text-red-600 @if($highest_fat===$macro) font-black text-xl underline @endif">{{$macro}}g</div>
                                @elseif($key == 'carbohydrates')


                                    <div class="text-orange-400 @if($highest_carbs===$macro) font-black text-xl underline @endif" >{{$macro}}g</div>
                                @elseif($key == 'protein') 

                                    <div class="text-green-500 @if($highest_protein===$macro) font-black text-xl underline @endif">{{$macro}}g</div>
                                @endif
                            @endforeach
                                                        </div>
                        
                            @elseif($_key == 'total')

                                    <div class="order-last grid grid-cols-5 border-t-4 border-stone-600 mb-4">
                                        <div class="text-stone-200">TOTAL</div>

                                        @foreach($meal_macro as $key => $macro)

                                            @if($key == 'calories')
                                                <div class="order-1 text-blue-600">{{round($macro, 0)}}kcal</div>
                                            @elseif($key == 'fat')
                                                <div class="order-2 text-red-600">{{$macro}}g</div>
                                            @elseif($key == 'carbohydrates')
                                                <div class="order-3 text-orange-400">{{$macro}}g</div>
                                            @elseif($key == 'protein') 
                                                <div class="order-4 text-green-500">{{$macro}}g</div>
                                            @endif

                                        @endforeach
                                    </div>


                            @endif

                        @endforeach

                                                
                        <div class="order-first grid grid-cols-5">
                            <div class="text-stone-400 grow">Name</div>
                            <div class="text-blue-500">Calories</div>
                            <div class="text-orange-500">Fat</div>
                            <div class="text-yellow-500">Carbs</div>
                            <div class="text-green-400">Protein</div>
                        </div>

                        </div>


                    {{-- </div> --}}


                @endforeach

            </div>
        </div>
    </div>

    <script>
        
        $( "button[id^='show-more-']" ).on("click", function() {

            $( `div[id^='meal-items-${this.value}']`).toggleClass('hidden');

        });

    </script>
</x-app-layout>
