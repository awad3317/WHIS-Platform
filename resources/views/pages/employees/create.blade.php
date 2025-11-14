@extends('layouts.app')
@section('title', __('Register Employee'))

@section('content')

<div x-data="{ step: 1 }" class="space-y-8">

    <!-- شريط الخطوات الجديد -->
    <div class="w-full flex items-center justify-center">
        <div class="flex items-center space-x-6 rtl:space-x-reverse">

            <template x-for="i in 4">

                <div class="flex items-center space-x-4 rtl:space-x-reverse">

                    <!-- الدائرة -->
                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full text-lg font-semibold transition-all duration-300"
                        :class="step === i
                            ? 'bg-brand-500 text-white shadow-lg'
                            : (step > i
                                ? 'bg-success-500 text-white shadow'
                                : 'bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300')" >
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
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.04] shadow-xl">

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
                               bg-white dark:bg-dark-900
                               focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                               transition-all shadow-sm';
                $labelClass = 'block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300';
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

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Datebirth') }}</label>
                        <input type="date" class="{{ $inputClass }}">
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
                        <label class="{{ $labelClass }}">{{ trans('student.Graduation date') }}</label>
                        <input type="date" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.The academic level he studies') }}</label>
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                </div>

                <div class="flex justify-between mt-6">
                    <button @click="step = 1" type="button"
                        class="px-6 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600 transition">
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
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Number of study classes') }}</label>
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.The subject he studies') }}</label>
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Number of servings') }}</label>
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                </div>

                <div class="flex justify-between mt-6">
                    <button @click="step = 2" type="button"
                        class="px-6 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600 transition">
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
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.ID Number') }}</label>
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Salary') }}</label>
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Phone number') }}</label>
                        <input type="text" class="{{ $inputClass }}">
                    </div>

                </div>

                <div class="flex justify-between mt-6">
                    <button @click="step = 3" type="button"
                        class="px-6 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600 transition">
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
