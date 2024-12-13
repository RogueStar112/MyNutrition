
@foreach($foods as $food)

@php
$food['calories'] = round(($food['calories']/($food['serving_size']))*$servingSize*$quantity, 0);
$food['fat'] = round(($food['fat']/($food['serving_size']))*$servingSize*$quantity, 1);
$food['carbohydrates'] = round(($food['carbohydrates']/($food['serving_size']))*$servingSize*$quantity, 1);
$food['protein'] = round(($food['protein']/($food['serving_size']))*$servingSize*$quantity, 1);

$food_id = $food['food_id'] ?? "";

@endphp
<div id="meal_item_{{ $foodIndex }}" class="meal_{{$food_id}} meal_item relative min-h-[100px] mb-3 active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-800 w-64 rounded-lg @if($showNutrients == true) py-6 @else @endif  pt-6 text-white shadow-md shadow-black overflow-hidden" index="{{$foodIndex}}">
    <ul class="relative @isset($food['img_url']) @else relative @endisset">
        <button type="button" id="item_revealbtn_{{ $foodIndex }}" index="{{ $foodIndex }}" class="item_revealbtn_{{ $foodIndex }} food_revealbtn absolute right-0 bg-lime-800 text-white p-3 mr-6 rounded-lg @if($showNutrients == true)hidden @endif">
            <i id="item_icon_{{ $foodIndex }}" class="fas fa-chevron-down item_icon_{{ $foodIndex }}"> </i>
        </button>

        <div class="px-6">
            <div class="select-none max-h-[108px]" id="food_wrapper_{{ $foodIndex }}">
                {{-- <li class="font-bold text-left">#{{ $foodIndex }}</li> --}}

                

                @isset($food['img_url'])
                    @if($food['img_url'] == '') 
                        <p aria-label="index_number" class="absolute @if($showNutrients==true)left-[75%] top-[0%]@else left-[50%] @endif text-8xl font-black opacity-10 select-none">{{ $foodIndex }}</p>
                        @else
                {{-- <p aria-label="index_number" class="z-50 absolute @if($showNutrients==true)left-[75%] top-[5%]@else left-[50%] @endif text-8xl font-black opacity-60 select-none">{{ $foodIndex }}</p>
                --}}
                {{-- <img src="{{ asset($food['img_url']) }}" aria-label="index_number" class="rounded-full w-[96px] h-[96px] m-2 right-0 top-0 /-right-12 /-top-12  shadow-xl shadow-black absolute @if($showNutrients==true)/left-[75%] /top-[0%]@else /left-[50%] @endif text-8xl font-black /opacity-10 select-none" />
                --}}
                <p aria-label="index_number" class="absolute @if($showNutrients==true)left-[80%] top-[0%]@else left-[50%] @endif text-8xl font-black opacity-10 select-none">{{ $foodIndex }}</p>
                
                @endif
                @else
                    <p aria-label="index_number" class="absolute @if($showNutrients==true)left-[80%] top-[0%]@else left-[50%] @endif text-8xl font-black opacity-10 select-none">{{ $foodIndex }}</p>
                
                @endisset
            

                <li class="text-balance max-w-[144px]" id="food_text_name_{{$foodIndex}}">{{ $food['name'] }}</li>

                
                <p class="text-gray-500"><span id="food_servingsize_{{$foodIndex}}">{{ $food['serving_size_input'] }} {{$food['food_unit_short']}}</span>@if($food['serving_size_input'] > 1 && ($food['food_unit_short'] == 'slice' || $food['food_unit_short'] == 'piece'))s @endif x {{ $food['quantity'] }}</p>
                <span id="food_text_source_{{$foodIndex}}"class="text-right text-gray-500">{{ $food['source'] }}</span>
                {{-- <p class="absolute right-0 bottom-0 text-gray-500">100g</p> --}}

            </div>
            
            <div id="nutritional_wrapper_{{ $foodIndex }}" class="nutritional_wrapper_{{ $foodIndex }} relative @if($showNutrients==true)slide-down @endif">
                <div class="relative mt-3">
                    <li id="food_text_calories_{{$foodIndex}}" class="italic">{{ $food['calories'] }}kcal</li>

                    <p class="absolute right-0 top-0 text-gray-500">Calories</p>


                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div id="food_progressbar_calories_{{$foodIndex}}" class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ((float)$food['calories'] / 1500) * 100 }}%"></div>
                    </div>
                </div>

                <div class="relative mt-3">
                    <li id="food_text_fat_{{$foodIndex}}" class="italic">{{$food['fat']}}g</li>
                    <p class="absolute right-0 top-0 text-gray-500">Fat</p>

                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div id="food_progressbar_fat_{{$foodIndex}}" class="bg-orange-600 h-2.5 rounded-full" style="width: {{ ((float)$food['fat'] / 97) * 100 }}%"></div>
                    </div>
                </div>

                <div class="relative mt-3">
                    <li id="food_text_carbs_{{$foodIndex}}" class="italic">{{ $food['carbohydrates'] }}g</li>
                    <p class="absolute right-0 top-0 text-gray-500">Carbs</p>

                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div id="food_progressbar_carbs_{{$foodIndex}}" class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ ((float)$food['carbohydrates'] / 97) * 100 }}%"></div>
                    </div>
                </div>

                <div class="relative mt-3">
                    <li id="food_text_protein_{{$foodIndex}}" class="italic">{{ $food['protein'] }}g</li>
                    <p class="absolute right-0 top-0 text-gray-500">Protein</p>

                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div id="food_progressbar_protein_{{$foodIndex}}" class="bg-green-600 h-2.5 rounded-full" style="width: {{ ((float)$food['protein'] / 80) * 100 }}%"></div>
                    </div>
                </div>

                
            </div>
        </div>

        <div id="nutritional-media-buttons-{{$foodIndex}}" class="nutritional-media-buttons-{{$foodIndex}} nutritional-media-buttons w-full flex text-center mt-3 [&>*]:my-auto absolute left-0 bottom-0 hidden duration-200 [&>*]:cursor-pointer [&>*>*]:cursor-pointer">

            <div id="mealitem-edit-btn-{{$foodIndex}}" class="w-full bg-yellow-500 hover:bg-yellow-600 duration-150 text-black">EDIT</div>
            <div id="mealitem-delete-btn-{{$foodIndex}}" class="w-full bg-red-500 hover:bg-red-600 duration-150 text-white" data-id="{{$food_id}}" data-index="{{$foodIndex}}">DELETE</div>

            <div id="mealitem-delete-btn-confirmcontainer-{{$foodIndex}}" class="w-full flex p-0 hidden" data-id="{{$food_id}}">
                <div id="mealitem-delete-btn-no-{{$foodIndex}}" class="w-full bg-red-500">X</div>
                <div id="mealitem-delete-btn-yes-{{$foodIndex}}" class="w-full bg-green-500">🗑️</div>
            </div>

        </div>
    </ul>
</div>


<script>

        food_index = <?php echo json_encode($foodIndex, JSON_HEX_TAG); ?>;
        food_id = <?php echo json_encode($food_id, JSON_HEX_TAG); ?>;
    
        // $(document).ready(function() {
        //     $(document).trigger('on_update', [food_index, food_id]);
        // });
        // document.getElementById(`mealitem-delete-btn-${food_index}`).addEventListener("click", function() {

        //     // document.getElementById(`mealitem-delete-btn-${food_index}`).classList.add("hidden")
        //     // document.getElementById(`mealitem-delete-btn-confirmcontainer-${food_index}`).classList.remove("hidden")
        //     $(`#mealitem-delete-btn-${food_index}`).addClass('hidden');
        //     $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).removeClass('hidden');


        // });

        // document.getElementById(`mealitem-delete-btn-yes-${food_index}`).addEventListener("click", function() {

        //     $(`.meal_${food_id}`).remove();

        // });

        // document.getElementById(`mealitem-delete-btn-no-${food_index}`).addEventListener("click", function() {

        //     $(`#mealitem-delete-btn-${food_index}`).removeClass('hidden');
        //     $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).addClass('hidden');


        // });


        // console.log(`FOOD ID: ${food_id} LOADED IN`);
        

    // $(`#mealitem-delete-btn-${food_index}`).on('click', function() {
        
    //     $(`#mealitem-delete-btn-${food_index}`).addClass('hidden');
    //     $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).removeClass('hidden');

    // });

    // $(`#mealitem-delete-btn-yes-${food_index}`).on('click', function() {
        
    //     $(`.meal_${food_id}`).remove();
    //     reorderItems();

    // });

    // $(`#mealitem-delete-btn-no-${food_index}`).on('click', function() {
        
    //     $(`#mealitem-delete-btn-${food_index}`).removeClass('hidden');
    //     $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).addClass('hidden');

    // });


  
</script>


{{-- <script>
    document.getElementById("mealitem-delete-btn-{{$foodIndex}}").onclick = () => console.log('potato');
</script> --}}
@endforeach
