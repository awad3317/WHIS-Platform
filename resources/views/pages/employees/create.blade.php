@extends('layouts.app')
@section('title', __('Register Employee'))

@section('content')

    <div x-data="{ step: 1 }" class="space-y-8">

        <!-- شريط الخطوات الجديد -->
        <div class="w-full flex items-center justify-center">
            <div class="flex items-center space-x-6 rtl:space-x-reverse my-6">

                <template x-for="i in 4">

                    <div class="flex items-center space-x-4 rtl:space-x-reverse">

                        <!-- الدائرة -->
                        <div class="flex items-center justify-center w-12 h-12 rounded-full text-lg font-semibold transition-all duration-300"
                            :class="step === i ?
                                'bg-brand-500 text-white shadow-lg' :
                                (step > i ?
                                    'bg-success-500 dark:bg-success-200 text-white shadow' :
                                    'bg-gray-300 dark:bg-gray-100 text-gray-700 dark:text-gray-300')">
                            <span x-text="i"></span>
                        </div>

                        <!-- الخط -->
                        <template x-if="i < 4">
                            <div class="w-16 h-1 rounded-full transition-all duration-300"
                                :class="step > i ? 'bg-success-500' : 'bg-gray-300 dark:bg-gray-700'">
                            </div>
                        </template>

                    </div>

                </template>

            </div>
        </div>


        <!-- المحتوى -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl">

            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    {{ __('Register Employee') }}
                </h2>
            </div>

            <form class="space-y-8 p-6">

                <!-- تنسيق الحقول الموحد -->
                @php
                    $inputClass = 'h-12 w-full rounded-xl border px-4 py-2 text-sm
                               border-gray-300 dark:border-gray-700
                               bg-white dark:bg-dark-600
                               focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                               transition-all shadow-sm';
                    $labelClass = 'block mb-2 text-sm font-medium text-gray-700 dark:text-white';
                @endphp


                {{-- الخطوة 1 --}}
                <div x-show="step === 1" x-transition>
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.EmployeeName') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Employee Name') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Directorate') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Directorate') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.JobTitle') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Job Title') }}"
                                class="{{ $inputClass }}">
                        </div>


                        <div class="relative">
                            <label class="{{ $labelClass }}">{{ trans('student.Datebirth') }}</label>

                            <input type="date" placeholder="Select date"
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
                    </div>

                    <div class="flex justify-end mt-6">
                        <button @click="step = 2" type="button"
                            class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                            {{ trans('student.Next') }}
                        </button>
                    </div>
                </div>



                {{-- الخطوة 2 --}}
                <div x-show="step === 2" x-transition>
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Qualification') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Qualification') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Department') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Department') }}"
                                class="{{ $inputClass }}">
                        </div>

                        
                   
                        <div>
                            <label
                                class="{{ $labelClass }}">{{ trans('student.The academic level he studies') }}</label>
                            <input type="text"
                                placeholder="{{ trans('student.Enter The The academic level he studies') }}"
                                class="{{ $inputClass }}">
                        </div>
     <div class="relative">
                            <label class="{{ $labelClass }}">{{ trans('student.Graduation date') }}</label>

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



                {{-- الخطوة 3 --}}
                <div x-show="step === 3" x-transition>
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Classes') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Classes') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Number of study classes') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Number of study classes') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.The subject he studies') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Subject He Studies') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Number of servings') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Number of servings') }}"
                                class="{{ $inputClass }}">
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



                {{-- الخطوة 4 --}}
                <div x-show="step === 4" x-transition>
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Identity type') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Identity type') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.ID Number') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The ID Number') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Salary') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Salary') }}"
                                class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.Phone number') }}</label>
                            <input type="text" placeholder="{{ trans('student.Enter The Phone number') }}"
                                class="{{ $inputClass }}">
                        </div>

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
