<div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6">

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">
            بيانات ولي الأمر (الأب / الأم)
        </h2>

        <!-- ===================== الأب ===================== -->
        <div class="mb-12">
             <div class="flex justify-between my-6">
            <h3 class="font-semibold text-lg text-gray-800 dark:text-white mb-4">
                بيانات  
            </h3>
            <div> @livewire('parent-modal')</div>
        </div>

            <!-- مربع البحث عن الأب -->
            <div class="relative mb-6">
                <input type="text" wire:model.live="fatherQuery"
                    class="w-full h-12 px-5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500"
                    placeholder="ابحث عن الأب بالاسم أو رقم الهوية أو الجوال">

                @if (!empty($fatherResults))
                    <div class="absolute w-full bg-white dark:bg-gray-900 border rounded-xl mt-2 shadow-lg z-50">
                        @foreach ($fatherResults as $father)
                            <div wire:click="selectFather({{ $father->id }})"
                                class="px-5 py-3 hover:bg-gray-100 cursor-pointer border-b last:border-none">

                                <p class="font-semibold">{{ $father->name_ar }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $father->national_id }} - {{ $father->phone }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <input type="hidden" name="father_id" value="{{ $fatherId }}">

            <!-- بيانات الأب -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mt-6">

                <div>
                    <label class="block mb-1 text-xs text-gray-500">الاسم بالعربي</label>
                    <input type="text" wire:model="father_name_ar" name="father_name_ar"
                        class="h-12 w-full rounded-xl border px-4 text-sm">
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-500">الاسم بالانجليزي</label>
                    <input type="text" wire:model="father_name_en" name="father_name_en"
                        class="h-12 w-full rounded-xl border px-4 text-sm">
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-500">رقم الهوية</label>
                    <input type="text" wire:model="father_national_id" name="father_national_id"
                        class="h-12 w-full rounded-xl border px-4 text-sm">
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-500">الجوال</label>
                    <input type="text" wire:model="father_mobile" name="father_mobile"
                        class="h-12 w-full rounded-xl border px-4 text-sm">
                </div>

            </div>
        </div>


        <!-- ===================== الأم ===================== -->


    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6">
        <div class="flex justify-between my-6">
            <h3 class="font-semibold text-lg text-gray-800 dark:text-white mb-4">
                بيانات الأم
            </h3>
            <div> @livewire('parent-modal')</div>
        </div>



        <!-- مربع البحث عن الأم -->
        <div class="relative mb-6">
            <input type="text" wire:model.live="motherQuery"
                class="w-full h-12 px-5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500"
                placeholder="ابحث عن الأم بالاسم أو رقم الهوية أو الجوال">

            @if (!empty($motherResults))
                <div class="absolute w-full bg-white dark:bg-gray-900 border rounded-xl mt-2 shadow-lg z-50">
                    @foreach ($motherResults as $mother)
                        <div wire:click="selectMother({{ $mother->id }})"
                            class="px-5 py-3 hover:bg-gray-100 cursor-pointer border-b last:border-none">

                            <p class="font-semibold">{{ $mother->name_ar }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $mother->national_id }} - {{ $mother->phone }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <input type="hidden" name="mother_id" value="{{ $motherId }}">

        <!-- بيانات الأم -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mt-6">

            <div>
                <label class="block mb-1 text-xs text-gray-500">الاسم بالعربي</label>
                <input type="text" wire:model="mother_name_ar" name="mother_name_ar"
                    class="h-12 w-full rounded-xl border px-4 text-sm">
            </div>

            <div>
                <label class="block mb-1 text-xs text-gray-500">الاسم بالانجليزي</label>
                <input type="text" wire:model="mother_name_en" name="mother_name_en"
                    class="h-12 w-full rounded-xl border px-4 text-sm">
            </div>

            <div>
                <label class="block mb-1 text-xs text-gray-500">رقم الهوية</label>
                <input type="text" wire:model="mother_national_id" name="mother_national_id"
                    class="h-12 w-full rounded-xl border px-4 text-sm">
            </div>

            <div>
                <label class="block mb-1 text-xs text-gray-500">الجوال</label>
                <input type="text" wire:model="mother_mobile" name="mother_mobile"
                    class="h-12 w-full rounded-xl border px-4 text-sm">
            </div>

        </div>
    </div>
</div>
