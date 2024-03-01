<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl [&>*]:max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-flow-row-dense mx-4 grid-cols-1 gap-3 max-w-3xl">
              

              @foreach($meal_items as $meal_time => $meal_item) 


              <div class="max-w-3xl">
                  <p class="text-2xl italic text-orange-400">{{DateTime::createFromFormat('Y-m-d H:i:s', $meal_time)->format('d M Y - H:i')}}</p>
                
                  {{-- {{dd($meal_names)}} --}}
                  @foreach($meal_names as $meal_name_index => $meal_name) 
                        
                        <div class="flex justify-between items-center">
                        <h1 class="text-2xl text-orange-500 font-black uppercase">{{$meal_name["meal_name"]}}</h1>
                
                        @foreach($meal_macros["$meal_time"]["total"] as $meal_total_index => $meal_total_macro) 
                                


                                <div class='flex text-center w-fit p-4 
                                            @if($meal_total_index === "fat") bg-blue-500  @endif
                                            @if($meal_total_index === "calories") bg-yellow-500 @endif 
                                            @if($meal_total_index === "carbohydrates") bg-orange-500 @endif 
                                            @if($meal_total_index === "protein") bg-green-500 @endif '>

                     
                                    <div class="grow">{{str_replace("_", " ", ucfirst($meal_total_index))}}<br>{{$meal_total_macro}}</div>
                                </div>
                        @endforeach

                    

                        </div>


                            
                            @foreach($meal_item as $meal_item_index => $item)
                                <p class=" text-orange-500 font-extrabold">{{$item->name}}</p>
                                
                                <div class="flex justify-between">
                                @foreach($meal_macros["$meal_time"][$meal_item_index] as $meal_index => $meal_macro)

                                    <div class="">
                                    {{str_replace("_", " ", ucfirst($meal_index))}} {{$meal_macro}}<br>
                                    </div>
                                    {{-- @foreach($meal_macro as $index => $macro)
                                        
                                        
                                    {{str_replace("_", " ", ucfirst($index))}} {{$macro}}

                                    @endforeach --}}
                                @endforeach
                                </div>


                            @endforeach
                        </div>


                        </div>
                        @endforeach
            
                        </div>

            @endforeach
            
        
            

        </div>
    </div>
</x-app-layout>
