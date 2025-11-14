@extends('layouts.app')
@section('title', __('Register Student'))


@section('content')

<div x-data="{ step: 1 }" class="space-y-8">

    <!-- شريط الخطوات -->
    <div class="w-full flex items-center justify-center mt-4">
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
                                : 'bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300')">
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
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.04] shadow-xl">

        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ trans('student.Student Register') }}
            </h2>
        </div>

        @php
            $inputClass = '
                h-12 w-full rounded-xl border px-4 py-2 text-sm
                border-gray-300 dark:border-gray-700
                bg-white dark:bg-dark-900
                focus:border-brand-500 focus:ring-2 focus:ring-brand-400/20
                text-gray-800 dark:text-white/90
                placeholder:text-gray-400 dark:placeholder:text-white/30
                transition-all shadow-sm
            ';

            $labelClass = '
                block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300
            ';
        @endphp

        <form class="p-6 space-y-8">

            {{-- ---------------------- الخطوة 1: بيانات الطالب ---------------------- --}}
            <div x-show="step === 1" x-transition>
                <h3 class="text-base font-medium mb-4">{{ trans('student.Student’sDetails') }}</h3>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Full Name in Arabic') }}</label>
                        <input class="{{ $inputClass }}" placeholder="{{ trans('student.EnterFullNameInArabic') }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Full Name in English') }}</label>
                        <input class="{{ $inputClass }}" placeholder="{{ trans('student.EnterFullNameInEnglish') }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Date of Birth') }}</label>
                        <input type="date" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Nationality') }}</label>
                        <input class="{{ $inputClass }}" placeholder="{{ trans('student.Nationality') }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Present School') }}</label>
                        <input class="{{ $inputClass }}" placeholder="{{ trans('student.Present School') }}">
                    </div>

                    <div>
                        <label class="{{ $labelClass }}">{{ trans('student.Grade at Present School') }}</label>
                        <input class="{{ $inputClass }}" placeholder="{{ trans('student.Grade at Present School') }}">
                    </div>

                </div>

                <div class="flex justify-end mt-6">
                    <button @click="step = 2" type="button"
                        class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                        {{ trans('student.Next') }}
                    </button>
                </div>
            </div>



            {{-- ---------------------- الخطوة 2: متطلبات تسجيل الطالب ---------------------- --}}
            <div x-show="step === 2" x-transition>
                <h3 class="text-base font-medium mb-4">{{ trans('student.StudentRegistrationRequirements') }}</h3>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                    @foreach ([
                        'Personal photo',
                        'birth certificate',
                        'Vaccination certificate',
                        'Student’s previous and current certificates',
                        'A copy of the passport',
                        'Certificate from the Yemeni Ministry of Foreign Affairs and Consulate',
                        'Expatriate form',
                        'Medical fitness form'
                    ] as $field)

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.' . $field) }}</label>
                            <input class="{{ $inputClass }}" placeholder="{{ trans('student.Enter ' . $field) }}">
                        </div>

                    @endforeach

                </div>

                <div class="flex justify-between mt-6">
                    <button @click="step = 1" type="button"
                        class="px-6 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 shadow transition">
                        {{ trans('student.Previous') }}
                    </button>

                    <button @click="step = 3" type="button"
                        class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                        {{ trans('student.Next') }}
                    </button>
                </div>
            </div>



            {{-- ---------------------- الخطوة 3: بيانات الأب ---------------------- --}}
            <div x-show="step === 3" x-transition>
                <h3 class="text-base font-medium mb-4">{{ trans('student.Father’sDetails') }}</h3>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                    @foreach ([
                        'Father/Guardians’s Name',
                        'Occupation',
                        'Place of Work',
                        'Mobile Phone',
                        'Email'
                    ] as $field)

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.' . $field) }}</label>
                            <input class="{{ $inputClass }}" placeholder="{{ trans('student.' . $field) }}">
                        </div>

                    @endforeach

                </div>

                <div class="flex justify-between mt-6">
                    <button @click="step = 2" type="button"
                        class="px-6 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 shadow transition">
                        {{ trans('student.Previous') }}
                    </button>

                    <button @click="step = 4" type="button"
                        class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-600 text-white shadow transition">
                        {{ trans('student.Next') }}
                    </button>
                </div>
            </div>



            {{-- ---------------------- الخطوة 4: بيانات الأم ---------------------- --}}
            <div x-show="step === 4" x-transition>
                <h3 class="text-base font-medium mb-4">{{ trans('student.Mother’sDetails') }}</h3>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                    @foreach ([
                        'Mother’s Name in Arabic',
                        'Mother’s Name in English',
                        'Occupation',
                        'Place of Work',
                        'Mobile Phone',
                        'Work Phone',
                        'Home phone',
                        'Email'
                    ] as $field)

                        <div>
                            <label class="{{ $labelClass }}">{{ trans('student.' . $field) }}</label>
                            <input class="{{ $inputClass }}" placeholder="{{ trans('student.' . $field) }}">
                        </div>

                    @endforeach

                </div>

                <div class="flex justify-between mt-6">
                    <button @click="step = 3" type="button"
                        class="px-6 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 shadow transition">
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
