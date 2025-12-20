@extends('layouts.app')

@section('title', __('student.student_show'))
@section('Breadcrumb', __('student.student_show'))

@section('content')
    <x-modals.success-modal />

    <div class="space-y-6 max-w-[1200px] mx-auto text-start px-4 sm:px-0">

        <div
            class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-800 backdrop-blur-xl">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-5">
                    <div
                        class="relative h-28 w-28 flex-shrink-0 overflow-hidden rounded-2xl border-2 border-white dark:border-gray-700 shadow-xl">
                        <img src="{{ $photo }}" alt="student" class="h-full w-full object-cover">
                        @if ($student->is_active)
                            <span
                                class="absolute bottom-1 inset-inline-end-1 h-4 w-4 rounded-full border-2 border-white bg-success-500 dark:border-gray-700"></span>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ app()->getLocale() == 'ar' ? $student->name_ar : $student->name_en }}
                        </h3>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 italic">
                            {{ __('student.academic_no') }}: <span
                                class="text-brand-500 dark:text-brand-400 font-bold">#{{ $student->academic_no }}</span>
                        </p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span @class([
                                'inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold tracking-wide transition-colors',
                                'bg-success-100 text-success-700 dark:bg-success-500 dark:text-success-400' =>
                                    $student->is_active,
                                'bg-error-100 text-error-700 dark:bg-error-500 dark:text-error-400' => !$student->is_active,
                            ])>
                                {{ $student->is_active ? __('student.active') : __('student.inactive') }}
                            </span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-brand-50 text-brand-700 dark:bg-brand-500 dark:text-white">
                                {{ $student->nationality }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- <div class="flex items-center gap-3">
                    <a href="{{ route('students.edit', $student->id) }}"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-700 shadow-sm transition-all hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                        <svg class="fill-current text-brand-500" width="18" height="18" viewBox="0 0 24 24">
                            <path
                                d="M5 19h1.42l9.44-9.45-1.42-1.42L5 17.58V19zm16 2H3v-4.24L16.43 3.34a.996.996 0 0 1 1.41 0l2.82 2.82c.39.39.39 1.02 0 1.41L7.24 21H21v2z" />
                        </svg>
                        <span class="dark:text-white">
                            {{ __('student.edit_data') }}
                        </span>
                    </a>
                </div> --}}
                <div x-data="{ open: false }" class="flex items-center gap-3">

                    <button type="button" @click="open = true"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-700 shadow-sm transition-all hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                        <svg class="fill-current text-brand-500" width="18" height="18" viewBox="0 0 24 24">
                            <path
                                d="M5 19h1.42l9.44-9.45-1.42-1.42L5 17.58V19zm16 2H3v-4.24L16.43 3.34a.996.996 0 0 1 1.41 0l2.82 2.82c.39.39.39 1.02 0 1.41L7.24 21H21v2z" />
                        </svg>
                        <span class="dark:text-white">{{ __('student.edit_data') }}</span>
                    </button>

                    <template x-teleport="body">
                        <div x-show="open" x-transition.opacity @keydown.escape.window="open = false"
                            class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
                            style="display:none;">

                            {{-- Overlay --}}
                            <div class="fixed inset-0 bg-gray-400/50 backdrop-blur-[32px]" @click="open = false"></div>

                            {{-- Modal box --}}
                            <div x-transition
                                class="relative w-full max-w-[900px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">

                                <div class="mb-6 flex items-center justify-between">
                                    <h4 class="text-lg font-black text-gray-800 dark:text-white/90">
                                        {{ __('student.student_edit') }}
                                    </h4>

                                    <button type="button" @click="open = false"
                                        class="rounded-xl border border-gray-200 px-3 py-2 text-sm font-bold dark:border-gray-700">
                                        ✕
                                    </button>
                                </div>

                                <form action="{{ route('students.update', $student->id) }}" method="POST"
                                    class="space-y-6">
                                    @csrf
                                    @method('PUT')

                                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                                        {{-- الاسم بالعربي --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.full_name_in_arabic') }} <span
                                                    class="text-error-500">*</span>
                                            </label>
                                            <input type="text" name="name_ar" required
                                                value="{{ old('name_ar', $student->name_ar) }}"
                                                placeholder="{{ __('student.enter_full_name_in_arabic') }}"
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                                                    focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                                                    dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                            @error('name_ar')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- الاسم بالإنجليزي --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.full_name_in_english') }} <span
                                                    class="text-error-500">*</span>
                                            </label>
                                            <input type="text" name="name_en" required
                                                value="{{ old('name_en', $student->name_en) }}"
                                                placeholder="{{ __('student.enter_full_name_in_english') }}"
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                            @error('name_en')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- تاريخ الميلاد --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.date_of_birth') }} <span class="text-error-500">*</span>
                                            </label>
                                            <input type="date" name="birth_date" required
                                                value="{{ old('birth_date', $student->birth_date) }}"
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                onclick="this.showPicker()" />
                                            @error('birth_date')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- الجنس --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.gender') }} <span class="text-error-500">*</span>
                                            </label>
                                            <select name="gender" required
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                                <option value="">{{ __('student.select_gender') }}</option>
                                                <option value="male" @selected(old('gender', $student->gender) === 'male')>
                                                    {{ __('student.male') }}</option>
                                                <option value="female" @selected(old('gender', $student->gender) === 'female')>
                                                    {{ __('student.female') }}</option>
                                            </select>
                                            @error('gender')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.national_id_type') }} <span class="text-error-500">*</span>
                                            </label>
                                            <select name="national_id_type" required
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                                <option value="">{{ __('student.select_type') }}</option>
                                                <option value="national_id" @selected(old('national_id_type', $student->national_id_type) === 'national_id')>
                                                    {{ __('student.national_id') }}
                                                </option>
                                                <option value="passport" @selected(old('national_id_type', $student->national_id_type) === 'passport')>
                                                    {{ __('student.passport') }}
                                                </option>
                                                <option value="residency" @selected(old('national_id_type', $student->national_id_type) === 'residency')>
                                                    {{ __('student.residency') }}
                                                </option>
                                            </select>
                                            @error('national_id_type')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- رقم الهوية --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.national_id_number') }} <span
                                                    class="text-error-500">*</span>
                                            </label>
                                            <input type="text" name="national_id" required
                                                value="{{ old('national_id', $student->national_id) }}"
                                                placeholder="{{ __('student.Enter The National ID Number') }}"
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                            @error('national_id')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- الجنسية --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.nationality') }} <span class="text-error-500">*</span>
                                            </label>
                                            <input type="text" name="nationality" required
                                                value="{{ old('nationality', $student->nationality) }}"
                                                placeholder="{{ __('student.Enter The Nationality') }}"
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                            @error('nationality')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- المدرسة السابقة --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.present_school') }} <span class="text-error-500">*</span>
                                            </label>
                                            <input type="text" name="previous_school" required
                                                value="{{ old('previous_school', $student->previous_school) }}"
                                                placeholder="{{ __('student.Enter The Previous School') }}"
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                            @error('previous_school')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- تاريخ التسجيل --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.enrollment_date') }} <span class="text-error-500">*</span>
                                            </label>
                                            <input type="date" name="enrollment_date" required
                                                value="{{ old('enrollment_date', $student->enrollment_date) }}"
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                onclick="this.showPicker()" />
                                            @error('enrollment_date')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- الحالة --}}
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ __('student.is_active') ?? 'الحالة' }} <span
                                                    class="text-error-500">*</span>
                                            </label>
                                            <select name="is_active" required
                                                class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800 shadow-theme-xs
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                                <option value="1" @selected((int) old('is_active', $student->is_active) === 1)>
                                                    {{ __('student.active') }}</option>
                                                <option value="0" @selected((int) old('is_active', $student->is_active) === 0)>
                                                    {{ __('student.inactive') }}</option>
                                            </select>
                                            @error('is_active')
                                                <span class="text-error-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="mt-8 flex items-center justify-end gap-3">
                                        <button type="button" @click="open = false"
                                            class="rounded-lg border border-gray-200 px-4 py-2 font-bold text-gray-700 dark:border-gray-700 dark:text-gray-200">
                                            {{ __('student.cancel') }}
                                        </button>

                                        <button type="submit"
                                            class="rounded-lg bg-brand-500 px-4 py-2 font-bold text-white hover:bg-brand-600">
                                            {{ __('student.save_data') }}
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </template>
                </div>

            </div>
        </div>

        <div x-data="{ activeTab: 'personal' }" class="space-y-6">
            <div
                class="flex items-center p-1 bg-gray-100 dark:bg-gray-800 rounded-2xl w-fit backdrop-blur-sm shadow-inner overflow-x-auto">
                <button @click="activeTab = 'personal'"
                    :class="activeTab === 'personal' ? 'bg-brand-500 text-white shadow-md dark:bg-brand-500 dark:text-white' :
                        'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                    class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap">
                    {{ __('student.personal_info') }}
                </button>
                <button @click="activeTab = 'parents'"
                    :class="activeTab === 'parents' ? 'bg-brand-500 text-white shadow-md dark:bg-brand-500 dark:text-white' :
                        'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                    class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap">
                    {{ __('student.parents_info') }}
                </button>
                <button @click="activeTab = 'files'"
                    :class="activeTab === 'files' ? 'bg-brand-500 text-white shadow-md dark:bg-brand-500 dark:text-white' :
                        'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                    class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap">
                    {{ __('student.student_files') }} <span
                        class="ms-1 opacity-60">({{ $student->files->count() }})</span>
                </button>
            </div>

            <div x-show="activeTab === 'personal'" x-transition:enter="transition ease-out duration-300 translate-y-4"
                class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div
                    class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm dark:border-gray-800 dark:bg-gray-800">
                    <h3 class="text-lg font-black text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <span class="h-5 border-s-4 border-brand-500 text-brand-500 rounded-full">
                            {{ __('student.basic_info') }}

                        </span>
                    </h3>
                    <div class="grid grid-cols-1 gap-y-5">
                        <div class="flex flex-col  border-gray-50 dark:border-gray-800 pb-2">
                            <span
                                class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.full_name') }}</span>
                            <span class="text-base font-semibold text-gray-800 dark:text-gray-400">
                                {{ app()->getLocale() == 'ar' ? $student->name_ar : $student->name_en }}
                            </span>
                        </div>
                        <div class="flex flex-col  border-gray-50 dark:border-gray-800 pb-2">
                            <span
                                class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.date_of_birth') }}</span>
                            <span
                                class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->birth_date }}</span>
                        </div>
                        <div class="flex flex-col  border-gray-50 dark:border-gray-800 pb-2">
                            <span
                                class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.gender') }}</span>
                            <span
                                class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->gender }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm dark:border-gray-800 dark:bg-gray-800">
                    <h3 class="text-lg font-black text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <span class="h-5 border-s-4 text-brand-500 rounded-full">
                            {{ __('student.registration_info') }}

                        </span>
                    </h3>
                    <div class="grid grid-cols-1 gap-y-5">
                        <div class="flex flex-col  border-gray-50 dark:border-gray-800 pb-2">
                            <span
                                class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.national_id') }}</span>
                            <span
                                class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->national_id }}</span>
                        </div>
                        <div class="flex flex-col  border-gray-50 dark:border-gray-800 pb-2">
                            <span
                                class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.present_school') }}</span>
                            <span
                                class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->previous_school ?? '---' }}</span>
                        </div>
                        <div class="flex flex-col  border-gray-50 dark:border-gray-800 pb-2">
                            <span
                                class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.enrollment_date') }}</span>
                            <span
                                class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->enrollment_date }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'parents'" x-transition class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                @forelse($student->parents as $parent)
                    <div x-data="{ open: false }"
                        class="group rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md
                   dark:border-gray-800 dark:bg-gray-800 flex items-start gap-5">

                        <div
                            class="h-14 w-14 rounded-2xl bg-brand-50 flex items-center justify-center text-2xl dark:bg-brand-500/10">
                            {{ $parent->pivot->relationship == 'father' ? '👨‍💼' : '👩‍💼' }}
                        </div>

                        <div class="flex-1 space-y-3">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">
                                        {{ app()->getLocale() == 'ar' ? $parent->name_ar : $parent->name_en }}
                                    </h4>
                                    {{-- 
                                    <span
                                        class="mt-2 inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black uppercase
                                   bg-brand-50 text-brand-700 dark:bg-brand-500/20 dark:text-brand-400">
                                        {{ __('student.' . $parent->pivot->relationship) }}
                                    </span> --}}
                                </div>

                                <!-- زر تعديل -->
                                <button type="button" @click="open = true"
                                    class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2
                               text-xs font-black text-gray-700 shadow-sm transition-all hover:bg-gray-50
                               dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                    <svg class="fill-current text-brand-500" width="16" height="16"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M5 19h1.42l9.44-9.45-1.42-1.42L5 17.58V19zm16 2H3v-4.24L16.43 3.34a.996.996 0 0 1 1.41 0l2.82 2.82c.39.39.39 1.02 0 1.41L7.24 21H21v2z" />
                                    </svg>
                                    <span>{{ __('student.edit_data') }}</span>
                                </button>
                            </div>

                            <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400 font-medium">
                                <p class="flex items-center gap-2 tracking-wide"><i
                                        class="far fa-phone"></i>{{ $parent->phone }}</p>
                                <p class="flex items-center gap-2 tracking-wide"><i
                                        class="far fa-envelope"></i>{{ $parent->email ?? '---' }}</p>
                            </div>
                        </div>

                        <template x-teleport="body">
                            <div x-show="open" x-transition.opacity @keydown.escape.window="open=false"
                                class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
                                style="display:none;">
                                <div class="absolute inset-0 bg-gray-400/50 backdrop-blur-[32px]" @click="open=false">
                                </div>

                                <div class="relative flex min-h-screen items-center justify-center p-5">
                                    <div class="w-full max-w-[700px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">

                                        <div class="mb-6 flex items-center justify-between">
                                            <h4 class="text-lg font-black text-gray-800 dark:text-white/90">
                                                {{ __('student.edit_parent') ?? 'تعديل ولي الأمر' }}
                                            </h4>

                                            <button type="button" @click="open=false"
                                                class="rounded-xl border border-gray-200 px-3 py-2 text-sm font-bold
                                           dark:border-gray-700 dark:text-white">
                                                ✕
                                            </button>
                                        </div>

                                        <form action="{{ route('students.parents.update', [$student->id, $parent->id]) }}"
                                            method="POST" class="space-y-6">
                                            @csrf
                                            @method('PUT')

                                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                        {{ __('student.parent_name_ar') ?? 'الاسم بالعربي' }}
                                                    </label>
                                                    <input name="name_ar" value="{{ old('name_ar', $parent->name_ar) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                        {{ __('student.parent_name_en') ?? 'الاسم بالإنجليزي' }}
                                                    </label>
                                                    <input name="name_en" value="{{ old('name_en', $parent->name_en) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                        {{ __('student.parent_phone') ?? 'الهاتف' }}
                                                    </label>
                                                    <input name="phone" value="{{ old('phone', $parent->phone) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                        {{ __('student.parent_mobile') ?? 'الجوال' }}
                                                    </label>
                                                    <input name="mobile" value="{{ old('mobile', $parent->mobile) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                        {{ __('student.parent_email') ?? 'البريد' }}
                                                    </label>
                                                    <input type="email" name="email"
                                                        value="{{ old('email', $parent->email) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                        {{ __('student.parent_national_id') ?? 'رقم الهوية' }}
                                                    </label>
                                                    <input name="national_id"
                                                        value="{{ old('national_id', $parent->national_id) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                        {{ __('student.parent_job_title') ?? 'المسمى الوظيفي' }}
                                                    </label>
                                                    <input name="job_title"
                                                        value="{{ old('job_title', $parent->job_title) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                        {{ __('student.parent_workplace') ?? 'جهة العمل' }}
                                                    </label>
                                                    <input name="workplace"
                                                        value="{{ old('workplace', $parent->workplace) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                                <div class="space-y-2">
                                                    <input name="relationship" type="hidden"
                                                        value="{{ old('relationship', $parent->relationship) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />

                                                </div>
                                                <div class="space-y-2">
                                                    <input name="gender" type="hidden"
                                                        value="{{ old('gender', $parent->gender) }}"
                                                        class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                       focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                </div>

                                            </div>

                                            <div class="flex items-center justify-end gap-3">
                                                <button type="button" @click="open=false"
                                                    class="rounded-lg border border-gray-200 px-4 py-2 font-bold text-gray-700
                   dark:border-gray-700 dark:text-gray-200">
                                                    {{ __('student.cancel') ?? 'إلغاء' }}
                                                </button>

                                                <button type="submit"
                                                    class="rounded-lg bg-brand-500 px-4 py-2 font-bold text-white hover:bg-brand-600">
                                                    {{ __('student.save_data') ?? 'حفظ' }}
                                                </button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>

                @empty
                    <div
                        class="col-span-full p-20 bg-gray-50/50 dark:bg-gray-800/20 rounded-[2.5rem] border-2 border-dashed border-gray-200 dark:border-gray-800 text-center text-gray-400 italic">
                        {{ __('student.no_data') }}
                    </div>
                @endforelse
            </div>


            {{-- <div x-show="activeTab === 'files'" x-transition class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($student->files as $file)
                    <div
                        class="flex items-center justify-between rounded-2xl border border-gray-100 bg-white py-4 pl-4 pr-4 dark:border-gray-800 dark:bg-white/[0.03] xl:pr-5">
                        <div class="flex items-center gap-4">
                            <div
                                class="flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-success-500/[0.08] text-success-500">
                                <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.05 3.9L8.45 4.35L9.05 3.9ZM2.25 2.25H6.5V0.75H2.25V2.25ZM1.5 15V3H0V15H1.5ZM17.75 15.75H2.25V17.25H17.75V15.75ZM18.5 6V15H20V6H18.5ZM17.75 3.75H10.25V5.25H17.75V3.75ZM9.65 3.45L8.3 1.65L7.1 2.55L8.45 4.35L9.65 3.45ZM10.25 3.75C10.0139 3.75 9.79164 3.63885 9.65 3.45L8.45 4.35C8.87492 4.91656 9.5418 5.25 10.25 5.25V3.75ZM20 6C20 4.75736 18.9926 3.75 17.75 3.75V5.25C18.1642 5.25 18.5 5.58579 18.5 6H20ZM17.75 17.25C18.9926 17.25 20 16.2426 20 15H18.5C18.5 15.4142 18.1642 15.75 17.75 15.75V17.25ZM0 15C0 16.2426 1.00736 17.25 2.25 17.25V15.75C1.83579 15.75 1.5 15.4142 1.5 15H0ZM6.5 2.25C6.73607 2.25 6.95836 2.36115 7.1 2.55L8.3 1.65C7.87508 1.08344 7.2082 0.75 6.5 0.75V2.25ZM2.25 0.75C1.00736 0.75 0 1.75736 0 3H1.5C1.5 2.58579 1.83579 2.25 2.25 2.25V0.75Z"
                                        fill="" />
                                </svg>
                            </div>

                            <div>
                                <h4 class="mb-1 text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ basename($file->file_name) }}
                                </h4>
                                <span class="block text-sm text-gray-500 dark:text-gray-400">
                                    <a href="{{ Route('student.downloadFile', $file->id) }}" download
                                        class="text-[10px] font-black uppercase text-success-500 dark:text-success-400">
                                        {{ __('student.download') }}
                                    </a>

                                </span>
                            </div>
                        </div>

                        <div>
                            <span class="mb-1 block text-right text-sm text-gray-500 dark:text-gray-400">
                                <a href="{{ route('student.viewFiles', $file->id) }}" target="_blank"
                                    class="text-[10px] font-black uppercase text-blue-500 dark:text-blue-400 hover:underline">
                                    {{ __('student.open') }}
                                </a>
                            </span>
                                <button type="button" @click="open = true"
                                    class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2
                               text-xs font-black text-gray-700 shadow-sm transition-all hover:bg-gray-50
                               dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                    <svg class="fill-current text-brand-500" width="16" height="16"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M5 19h1.42l9.44-9.45-1.42-1.42L5 17.58V19zm16 2H3v-4.24L16.43 3.34a.996.996 0 0 1 1.41 0l2.82 2.82c.39.39.39 1.02 0 1.41L7.24 21H21v2z" />
                                    </svg>
                                    {{-- <span>{{ __('student.edit_data') }}</span> --}}
            {{-- </button>
                           
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 text-center text-gray-400 font-bold italic border-2 border-dashed border-gray-200 dark:border-gray-800 rounded-[2.5rem] uppercase tracking-widest">
                        {{ __('student.no_attachments') }}
                    </div>
                @endforelse --}}
            {{-- </div> --}}
            <div x-show="activeTab === 'files'" x-transition class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                @forelse($student->files as $file)
                    <div x-data="{ open: false, newFileName: null }"
                        class="flex items-center justify-between rounded-2xl border border-gray-100 bg-white py-4 pl-4 pr-4
                    dark:border-gray-800 dark:bg-white/[0.03] xl:pr-5">

                        {{-- معلومات الملف --}}
                        <div class="flex items-center gap-4">
                            <div
                                class="flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-success-500/[0.08] text-success-500">
                                <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.05 3.9L8.45 4.35L9.05 3.9ZM2.25 2.25H6.5V0.75H2.25V2.25ZM1.5 15V3H0V15H1.5ZM17.75 15.75H2.25V17.25H17.75V15.75ZM18.5 6V15H20V6H18.5ZM17.75 3.75H10.25V5.25H17.75V3.75ZM9.65 3.45L8.3 1.65L7.1 2.55L8.45 4.35L9.65 3.45ZM10.25 3.75C10.0139 3.75 9.79164 3.63885 9.65 3.45L8.45 4.35C8.87492 4.91656 9.5418 5.25 10.25 5.25V3.75ZM20 6C20 4.75736 18.9926 3.75 17.75 3.75V5.25C18.1642 5.25 18.5 5.58579 18.5 6H20ZM17.75 17.25C18.9926 17.25 20 16.2426 20 15H18.5C18.5 15.4142 18.1642 15.75 17.75 15.75V17.25ZM0 15C0 16.2426 1.00736 17.25 2.25 17.25V15.75C1.83579 15.75 1.5 15.4142 1.5 15H0ZM6.5 2.25C6.73607 2.25 6.95836 2.36115 7.1 2.55L8.3 1.65C7.87508 1.08344 7.2082 0.75 6.5 0.75V2.25ZM2.25 0.75C1.00736 0.75 0 1.75736 0 3H1.5C1.5 2.58579 1.83579 2.25 2.25 2.25V0.75Z"
                                        fill="" />
                                </svg>
                            </div>

                            <div>
                                <h4 class="mb-1 text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $file->description ?: basename($file->file_name) }}
                                </h4>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ __('student.file_type') ?? 'نوع الملف' }}: <span
                                        class="font-bold">{{ $file->file_type ?? '---' }}</span>
                                </p>

                                <div class="mt-2 flex gap-3">
                                    <a href="{{ route('student.downloadFile', $file->id) }}" download
                                        class="text-[10px] font-black uppercase text-success-500 dark:text-success-400">
                                        {{ __('student.download') ?? 'تحميل' }}
                                    </a>

                                    <a href="{{ route('student.viewFiles', $file->id) }}" target="_blank"
                                        class="text-[10px] font-black uppercase text-blue-500 dark:text-blue-400 hover:underline">
                                        {{ __('student.open') ?? 'فتح' }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- زر التعديل --}}
                        <button type="button" @click="open=true"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2
                           text-xs font-black text-gray-700 shadow-sm transition-all hover:bg-gray-50
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                            <svg class="fill-current text-brand-500" width="16" height="16" viewBox="0 0 24 24">
                                <path
                                    d="M5 19h1.42l9.44-9.45-1.42-1.42L5 17.58V19zm16 2H3v-4.24L16.43 3.34a.996.996 0 0 1 1.41 0l2.82 2.82c.39.39.39 1.02 0 1.41L7.24 21H21v2z" />
                            </svg>
                            <span>{{ __('student.edit') ?? 'تعديل' }}</span>
                        </button>

                        {{-- المودال --}}
                        <template x-teleport="body">
                            <div x-show="open" x-transition.opacity @keydown.escape.window="open=false"
                                class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
                                style="display:none;">

                                {{-- overlay --}}
                                <div class="fixed inset-0 bg-gray-400/50 backdrop-blur-[32px]" @click="open=false"></div>

                                {{-- modal --}}
                                <div
                                    class="relative w-full max-w-[700px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">

                                    <div class="mb-6 flex items-center justify-between">
                                        <h4 class="text-lg font-black text-gray-800 dark:text-white/90">
                                            {{ __('student.edit_file') ?? 'تعديل ملف الطالب' }}
                                        </h4>

                                        <button type="button" @click="open=false"
                                            class="rounded-xl border border-gray-200 px-3 py-2 text-sm font-bold
                                           dark:border-gray-700 dark:text-white">
                                            ✕
                                        </button>
                                    </div>

                                    {{-- مهم: enctype لأننا سنرفع ملف --}}
                                    <form action="{{ route('students.files.update', [$student->id, $file->id]) }}"
                                        method="POST" enctype="multipart/form-data" class="space-y-6">
                                        @csrf
                                        @method('PUT')

                                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                                            {{-- file_type --}}
                                            <div class="space-y-2">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    {{ __('student.file_type') ?? 'نوع الملف' }}
                                                </label>
                                                <input name="file_type" value="{{ old('file_type', $file->file_type) }}"
                                                    class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                                                  focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                                                  dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                            </div>

                                            {{-- description --}}
                                            <div class="space-y-2">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    {{ __('student.description') ?? 'الوصف' }}
                                                </label>
                                                <input name="description"
                                                    value="{{ old('description', $file->description) }}"
                                                    class="h-12 w-full rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-800
                                                  focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20
                                                  dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                            </div>

                                            {{-- عرض اسم الملف الحالي (بدون تعديل مباشر) --}}
                                            <div class="space-y-2 sm:col-span-2">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    {{ __('student.current_file') ?? 'الملف الحالي' }}
                                                </label>

                                                <div
                                                    class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700
                                                dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200">
                                                    {{ basename($file->file_name) }}
                                                </div>
                                            </div>

                                            {{-- استبدال الملف --}}
                                            <div class="space-y-2 sm:col-span-2">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    {{ __('student.replace_file') ?? 'استبدال الملف' }}
                                                </label>

                                                <input type="file" name="new_file"
                                                    class="block w-full text-sm text-gray-700 dark:text-gray-200"
                                                    @change="newFileName = $event.target.files[0]?.name">

                                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="newFileName">
                                                </p>

                                                <p class="text-xs text-warning-500 dark:text-warning/90">
                                                    {{ __('student.replace_file_hint') ?? 'إذا رفعت ملفًا جديدًا سيتم استبدال الملف الحالي.' }}
                                                </p>
                                            </div>

                                        </div>

                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="open=false"
                                                class="rounded-lg border border-gray-200 px-4 py-2 font-bold text-gray-700
                                               dark:border-gray-700 dark:text-gray-200">
                                                {{ __('student.cancel') ?? 'إلغاء' }}
                                            </button>

                                            <button type="submit"
                                                class="rounded-lg bg-brand-500 px-4 py-2 font-bold text-white hover:bg-brand-600">
                                                {{ __('student.save_data') ?? 'حفظ' }}
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </template>

                    </div>

                @empty
                    <div
                        class="col-span-full py-20 text-center text-gray-400 font-bold italic border-2 border-dashed border-gray-200
                    dark:border-gray-800 rounded-[2.5rem] uppercase tracking-widest">
                        {{ __('student.no_attachments') ?? 'لا توجد ملفات' }}
                    </div>
                @endforelse

            </div>



        </div>
    @endsection
