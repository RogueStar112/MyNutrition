<div class="relative [&>canvas]:mx-auto [&>canvas]:w-full">
                        <x-chartjs-component :chart="$pie_chart" /> 

                        @php
                            $nutrients_g_total = $pie_sum_fat + $pie_sum_carbs + $pie_sum_protein;
                            

                            $pie_sum_fat_perc = round((($pie_sum_fat) / $nutrients_g_total) * 100, 1);
                            
                            $pie_sum_carbs_perc = round((($pie_sum_carbs) / $nutrients_g_total) * 100, 1);
                            
                            $pie_sum_protein_perc = round((($pie_sum_protein) / $nutrients_g_total) * 100, 1);
                        @endphp

                        <div class="absolute top-[1rem] z-50 w-full h-full flex justify-center items-center flex-col select-none">
                            <div>{{date('d/m/Y', strtotime($pie_date_selected))}}</div>
                            <div class=" text-blue-500 text-4xl">{{$pie_sum_calories}}<span class="text-2xl items-end">kcal</span></div>

                            <div class=" text-orange-500 text-sm sm:text-lg">{{$pie_sum_fat}}<span class="text-sm sm:text-sm items-end">g Fat</div>

                            <div class=" text-red-500 text-sm sm:text-lg">{{$pie_sum_carbs}}<span class="text-sm sm:text-sm items-end">g Carbs</div>
                        
                            <div class=" text-green-500 text-sm sm:text-lg">{{$pie_sum_protein}}<span class="text-sm sm:text-sm items-end">g Protein</span></div>
                        </div>

                    <div class="absolute top-[-4.5rem] right-0 flex flex-col items-end justify-end gap-2 [&>*]:text-center [&>*]:w-full [&>*]:mx-2 bg-transparent p-4 rounded-lg">
                        <p class="bg-orange-500 text-slate-800 rounded-lg bottom-0 right-0">{{$pie_sum_fat_perc}}%</p>
                        <p class="bg-red-500 text-slate-800 rounded-lg bottom-0 right-0">{{$pie_sum_carbs_perc}}%</p>
                        <p class="bg-green-500 text-slate-800 rounded-lg bottom-0 right-0">{{$pie_sum_protein_perc}}%</p>
                    </div>
                </div> 

               
            </div>
