@extends('layouts.app')
@section('title', __('Register Employee'))

@section('content')
<div class="mx-auto max-w-[1100px] pb-10 text-start" dir="rtl">
    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-900 dark:text-white">
                {{ trans('employee.employee_details') }}
            </h2>
            <p class="mt-1 text-xs font-black uppercase tracking-widest italic text-gray-500 opacity-70">
                إضافة كادر جديد لمنظومة المدرسة
            </p>
        </div>

        <a href="{{ route('employees.index') }}"
           class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-bold text-gray-700 shadow-sm transition hover:bg-gray-50 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-200 dark:hover:bg-white/[0.07]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            رجوع
        </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-6 md:grid-cols-12">
            {{-- Left: Main --}}
            <div class="space-y-6 md:col-span-8">

                {{-- Card: Basic Info --}}
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="mb-6 flex items-center gap-3">
                        <span class="h-5 w-1 rounded-full bg-brand-500"></span>
                        <h3 class="text-lg font-black text-brand-500 dark:text-white">
                            المعلومات الأساسية
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        {{-- name_ar --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.full_name_in_arabic') }}
                            </label>
                            <input
                                name="name_ar"
                                value="{{ old('name_ar') }}"
                                required
                                placeholder="مثال: محمد السعدي"
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900 placeholder:text-gray-400
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:placeholder:text-gray-500 dark:focus:border-brand-800"
                            />
                            @error('name_ar')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- name_en --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.full_name_in_english') }}
                            </label>
                            <input
                                name="name_en"
                                value="{{ old('name_en') }}"
                                placeholder="Ex: Mohammed Al-Saadi"
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900 placeholder:text-gray-400
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:placeholder:text-gray-500 dark:focus:border-brand-800"
                            />
                            @error('name_en')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- email --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.email') }}
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="example@mail.com"
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900 placeholder:text-gray-400
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:placeholder:text-gray-500 dark:focus:border-brand-800"
                            />
                            @error('email')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- phone --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.phone') }}
                            </label>
                            <input
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="9677xxxxxxxx"
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900 placeholder:text-gray-400
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:placeholder:text-gray-500 dark:focus:border-brand-800"
                            />
                            @error('phone')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Card: Documents --}}
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="mb-6 flex items-center gap-3">
                        <span class="h-5 w-1 rounded-full bg-brand-500"></span>
                        <h3 class="text-lg font-black text-brand-500 dark:text-white">
                            الوثائق والمؤهلات
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        {{-- national_id_type --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.national_id_type') }}
                            </label>
                            <select
                                name="national_id_type"
                                class="h-12 w-full appearance-none rounded-2xl border border-gray-200 bg-white px-4 text-sm font-bold text-gray-900
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:focus:border-brand-800"
                            >
                                <option value="">{{ trans('employee.select_type') }}</option>
                                <option value="national_id" @selected(old('national_id_type')==='national_id')>{{ trans('employee.national_id') }}</option>
                                <option value="passport" @selected(old('national_id_type')==='passport')>{{ trans('employee.passport') }}</option>
                            </select>
                            @error('national_id_type')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- national_id --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.national_id_number') }}
                            </label>
                            <input
                                name="national_id"
                                value="{{ old('national_id') }}"
                                required
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900 placeholder:text-gray-400
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:placeholder:text-gray-500 dark:focus:border-brand-800"
                            />
                            @error('national_id')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- qualification --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.qualification') }}
                            </label>
                            <input
                                name="qualification"
                                value="{{ old('qualification') }}"
                                placeholder="بكالوريوس هندسة"
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900 placeholder:text-gray-400
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:placeholder:text-gray-500 dark:focus:border-brand-800"
                            />
                            @error('qualification')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- graduation_year --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.graduation_year') }}
                            </label>
                            <input
                                type="number"
                                name="graduation_year"
                                value="{{ old('graduation_year') }}"
                                placeholder="YYYY"
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900 placeholder:text-gray-400
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:placeholder:text-gray-500 dark:focus:border-brand-800"
                            />
                            @error('graduation_year')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Financial --}}
            <div class="space-y-6 md:col-span-4">
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="mb-6 flex items-center gap-3">
                        <span class="h-5 w-1 rounded-full bg-brand-500"></span>
                        <h3 class="text-lg font-black text-brand-500 dark:text-white">
                            التعيين المالي
                        </h3>
                    </div>

                    <div class="space-y-5">
                        {{-- department --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.department') }}
                            </label>
                            <select
                                name="department"
                                class="h-12 w-full appearance-none rounded-2xl border border-gray-200 bg-white px-4 text-sm font-bold text-gray-900
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:focus:border-brand-800"
                            >
                                <option value="admin" @selected(old('department')==='admin')>{{ trans('employee.admin') }}</option>
                                <option value="teaching" @selected(old('department')==='teaching')>{{ trans('employee.teaching') }}</option>
                                <option value="support" @selected(old('department')==='support')>{{ trans('employee.support') }}</option>
                            </select>
                            @error('department')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- job_title --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.job_title') }}
                            </label>
                            <input
                                name="job_title"
                                value="{{ old('job_title') }}"
                                required
                                placeholder="معلم حاسوب"
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900 placeholder:text-gray-400
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:placeholder:text-gray-500 dark:focus:border-brand-800"
                            />
                            @error('job_title')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- salary --}}
                        <div class="space-y-2">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.salary') }}
                            </label>
                            <div class="relative">
                                <input
                                    type="number"
                                    step="0.01"
                                    name="salary"
                                    value="{{ old('salary') }}"
                                    placeholder="0.00"
                                    class="h-12 w-full rounded-2xl border border-gray-200 bg-brand-50 px-4 pl-14 text-sm font-black text-brand-500
                                           focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                           dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:focus:border-brand-800"
                                />
                                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-[10px] font-black uppercase text-brand-500/70">
                                    ريال
                                </span>
                            </div>
                            @error('salary')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- weekly classes (teaching only) --}}
                        <div id="weeklyClassesField" class="space-y-2" style="display:none;">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.weekly_classes') }}
                            </label>
                            <input
                                type="number"
                                name="weekly_classes"
                                value="{{ old('weekly_classes', 0) }}"
                                class="h-12 w-full rounded-2xl border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-900
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:focus:border-brand-800"
                            />
                            @error('weekly_classes')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- subjects (teaching only) --}}
                        <div id="subjectsField" class="space-y-2" style="display:none;">
                            <label class="mr-2 text-[11px] font-black uppercase tracking-widest text-gray-400">
                                {{ trans('employee.subjects') }}
                            </label>
                            <select
                                name="subjects[]"
                                multiple
                                class="h-32 w-full rounded-2xl border border-gray-200 bg-white p-3 text-xs font-bold text-gray-900
                                       focus:border-brand-300 focus:shadow-focus-ring focus:outline-hidden
                                       dark:border-gray-800 dark:bg-white/[0.03] dark:text-white dark:focus:border-brand-800"
                            >
                                <option value="math">الرياضيات</option>
                                <option value="science">العلوم</option>
                                <option value="arabic">اللغة العربية</option>
                                <option value="english">اللغة الإنجليزية</option>
                            </select>
                            @error('subjects')
                                <p class="text-xs font-bold text-error-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="group w-full rounded-2xl bg-brand-500 py-4 text-sm font-black uppercase tracking-[0.2em] text-white shadow-lg transition hover:scale-[1.02] hover:bg-brand-600 active:scale-95">
                    <span class="flex items-center justify-center gap-3">
                        <svg class="h-5 w-5 transition group-hover:rotate-[-6deg]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ trans('student.save_data') }}
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const departmentSelect = document.querySelector('select[name="department"]');
    const weeklyClassesField = document.getElementById('weeklyClassesField');
    const subjectsField = document.getElementById('subjectsField');

    function toggleTeachingFields() {
        const isTeaching = departmentSelect && departmentSelect.value === 'teaching';
        weeklyClassesField.style.display = isTeaching ? 'block' : 'none';
        subjectsField.style.display = isTeaching ? 'block' : 'none';
    }

    toggleTeachingFields();
    departmentSelect && departmentSelect.addEventListener('change', toggleTeachingFields);
});
</script>
@endsection
