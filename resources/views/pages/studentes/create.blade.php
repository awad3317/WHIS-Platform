@extends('layouts.app')
@section('title', __('Register Student'))


@section('content')

    <div x-data="{ step: 1 }" class="space-y-8">

        <!-- شريط الخطوات -->
        <div class="w-full flex items-center justify-center mt-4">
            <div class="flex items-center space-x-6 rtl:space-x-reverse">

                <template x-for="i in 4">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse my-6">

                        <!-- الدائرة -->
                        <div class="flex items-center justify-center w-12 h-12 rounded-full text-lg font-semibold transition-all duration-300"
                            :class="step === i ?
                                'bg-brand-500 text-white shadow-lg' :
                                (step > i ?
                                    'bg-success-500  text-white shadow' :
                                    'bg-gray-300 dark:bg-gray-100 text-gray-700 dark:text-gray-300')">
                            <span x-text="i"></span>
                        </div>

                        <!-- الخط -->
                        <template x-if="i < 4">
                            <div class="w-16 h-1 rounded-full transition-all duration-300"
                                :class="step > i ? 'bg-success-500' : 'bg-gray-300 dark:bg-gray-700'"></div>
                        </template>

                    </div>
                </template>

            </div>
        </div>

        <!-- صندوق المحتوى -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl">

            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    {{ trans('student.Student Register') }}
                </h2>
            </div>



            <form class="p-6 space-y-8">

                {{-- ---------------------- الخطوة 1: بيانات الطالب ---------------------- --}}
                <div x-show="step === 1" x-transition>
                    <h3 class="text-base dark:text-white font-medium mb-4">{{ trans('student.Student’sDetails') }}</h3>

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Full Name in Arabic') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.EnterFullNameInArabic') }}">
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Full Name in English') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.EnterFullNameInEnglish') }}">
                        </div>


                        <div class="relative">
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Date of Birth') }}</label>

                            <input type="date" placeholder="Select date"
                                placeholder="{{ trans('student.Enter The Graduation Date') }}"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                onclick="this.showPicker()" />
                            <span
                                class="pointer-events-none absolute  right-3 -translate-y-1/2 text-gray-700 dark:text-gray-400"
                                style="top: 65% !important">
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                        fill="" />
                                </svg>
                            </span>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Nationality') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Nationality') }}">
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Present School') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Present School') }}">
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Grade at Present School') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Grade at Present School') }}">
                        </div>

                    </div>

                    <div class="flex justify-end mt-6">
                        <button @click="step = 2" type="button"
                            class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                            {{ trans('student.Next') }}
                        </button>
                    </div>
                </div>


                {{-- ---------------------- الخطوة 2: بيانات الأب ---------------------- --}}
                <div x-show="step === 2" x-transition>
                    <h3 class="text-base font-medium mb-4 dark:text-white ">{{ trans('student.Father’sDetails') }}</h3>

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">



                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Father/Guardians’s Name') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Father/Guardians’s Name') }}">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Occupation') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Occupation') }}">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Place of Work') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Place of Work') }}">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Mobile Phone') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Mobile Phone') }}">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Email') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Email') }}">
                        </div>

                    </div>

                    <div class="flex justify-between mt-6">
                        <button @click="step = 1" type="button"
                            class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                            {{ trans('student.Previous') }}
                        </button>

                        <button @click="step = 3" type="button"
                            class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                            {{ trans('student.Next') }}
                        </button>
                    </div>
                </div>


                {{-- ---------------------- الخطوة 3: بيانات الأم ---------------------- --}}
                <div x-show="step === 3" x-transition>
                    <h3 class="text-base font-medium mb-4 dark:text-white ">{{ trans('student.Mother’sDetails') }}</h3>

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                 
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Mother’s Name in Arabic') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Mother’s Name in Arabic') }}">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Mother’s Name in English') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Mother’s Name in English') }}">
                        </div>
                            <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Occupation') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Occupation') }}">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Place of Work') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Place of Work') }}">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Mobile Phone') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Mobile Phone') }}">
                        </div>

                            <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Work Phone') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Work Phone') }}">
                        </div>
                               <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Home phone') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Home phone') }}">
                        </div>
                               <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Email') }}</label>
                            <input
                                class="h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-gray-500
                placeholder:text-gray-400 dark:placeholder:text-gray-500
                transition-all shadow-sm"
                                placeholder="{{ trans('student.Email') }}">
                        </div>
                        

                    </div>


                    <div class="flex justify-between mt-6">
                        <button @click="step = 2" type="button"
                            class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                            {{ trans('student.Previous') }}
                        </button>

                        <button @click="step = 4" type="button"
                            class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                            {{ trans('student.Next') }}
                        </button>
                    </div>

                </div>

                {{-- ---------------------- الخطوة 4: متطلبات تسجيل الطالب ---------------------- --}}
                <div x-show="step === 4" x-transition>
                    <h3 class="text-base font-medium mb-4 dark:text-white">
                        {{ trans('student.StudentRegistrationRequirements') }}
                    </h3>

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        @foreach (['Personal photo', 'birth certificate', 'Vaccination certificate', 'Student’s previous and current certificates', 'A copy of the passport', 'Certificate from the Yemeni Ministry of Foreign Affairs and Consulate', 'Expatriate form', 'Medical fitness form'] as $field)
                            <div class="space-y-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">
                                    {{ trans('student.' . $field) }}
                                </label>
                                <div class="relative">
                                    <label for="fileUpload"
                                        class="cursor-pointer block rounded-xl border border-dashed border-gray-300 bg-gray-50 p-7 lg:p-10 dark:border-gray-700 dark:bg-gray-900 hover:border-brand-500 dark:hover:border-brand-500">

                                        <div class="dz-message m-0 text-center">
                                            <div class="mb-[22px] flex justify-center">
                                                <div
                                                    class="flex h-[68px] w-[68px] items-center justify-center rounded-full bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                                    <svg class="fill-current" width="29" height="28"
                                                        viewBox="0 0 29 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M14.5019 3.91699C14.2852 3.91699 14.0899 2.00891 13.953 4.15589L8.57363 9.53186C8.28065 9.82466 8.2805 10.2995 8.5733 10.5925C8.8661 10.8855 9.34097 10.8857 9.63396 10.5929L13.7519 6.47752V18.667C13.7519 19.0812 14.0877 19.417 14.5019 19.417C14.9161 19.417 15.2519 19.0812 15.2519 18.667V6.48234L19.3653 10.5929C19.6583 10.8857 20.1332 10.8855 20.426 10.5925C20.7188 10.2995 20.7186 9.82463 20.4256 9.53184L15.0838 4.19378C14.9463 4.02488 14.7367 3.91699 14.5019 3.91699ZM5.91626 18.667C5.91626 18.2528 5.58047 17.917 5.16626 17.917C4.75205 17.917 4.41626 18.2528 4.41626 18.667V21.8337C4.41626 23.0763 5.42362 24.0837 6.66626 24.0837H22.3339C23.5766 24.0837 24.5839 23.0763 24.5839 21.8337V18.667C24.5839 18.2528 24.2482 17.917 23.8339 17.917C23.4197 17.917 23.0839 18.2528 23.0839 18.667V21.8337C23.0839 22.2479 22.7482 22.5837 22.3339 22.5837H6.66626C6.25205 22.5837 5.91626 22.2479 5.91626 21.8337V18.667Z"
                                                            fill="" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <h4 class="text-theme-xl mb-3 font-semibold text-gray-800 dark:text-white/90">
                                                Drop File Here
                                            </h4>

                                            <span
                                                class="mx-auto mb-5 block w-full max-w-[290px] text-sm text-gray-700 dark:text-gray-400">
                                                Drag and drop your PNG, JPG, WebP, SVG images here or browse
                                            </span>

                                            <span class="text-theme-sm text-brand-500 font-medium underline">
                                                Browse File
                                            </span>
                                        </div>
                                    </label>

                                    <!-- hidden file input -->
                                    <input id="fileUpload" type="file" class="hidden" />
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="flex justify-between mt-6">
                        <button @click="step = 3" type="button"
                            class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                            {{ trans('student.Previous') }}
                        </button>

                        <button type="submit"
                            class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                            {{ trans('student.Save Data') }}
                        </button>
                    </div>

                </div>


            </form>

        </div>

    </div>

@endsection
