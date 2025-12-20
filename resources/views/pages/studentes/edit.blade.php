@extends('layouts.app')

@section('title', __('student.student_edit'))
@section('Breadcrumb', __('student.student_edit'))

@section('content')

 {{-- <livewire:edit-student :student="$student" /> --}}

{{-- <div x-data="{ open: false }" class="flex items-center gap-3">

    <button type="button" @click="open = true"
        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-700 shadow-sm transition-all hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        <svg class="fill-current text-brand-500" width="18" height="18" viewBox="0 0 24 24">
            <path
                d="M5 19h1.42l9.44-9.45-1.42-1.42L5 17.58V19zm16 2H3v-4.24L16.43 3.34a.996.996 0 0 1 1.41 0l2.82 2.82c.39.39.39 1.02 0 1.41L7.24 21H21v2z" />
        </svg>
        <span class="dark:text-white">{{ __('student.edit_data') }}</span>
    </button>

    {{-- ✅ المودال --}}
    <template x-teleport="body">
        <div x-show="open"
             x-transition.opacity
             @keydown.escape.window="open = false"
             class="fixed inset-0 z-[99999] flex items-center justify-center p-5 overflow-y-auto"
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

                {{-- ✅ هنا الفورم العادي (POST / PUT) --}}
                <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                academic_no
                            </label>
                            <input type="text" name="academic_no" value="{{ old('academic_no', $student->academic_no) }}"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                {{ __('student.student_name_ar') }} <span class="text-error-500">*</span>
                            </label>
                            <input type="text" name="name_ar" required value="{{ old('name_ar', $student->name_ar) }}"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                {{ __('student.student_name_en') }}
                            </label>
                            <input type="text" name="name_en" value="{{ old('name_en', $student->name_en) }}"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                birth_date
                            </label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date) }}"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                gender
                            </label>
                            <select name="gender"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                                <option value="">اختر</option>
                                <option value="male" @selected(old('gender', $student->gender) === 'male')>ذكر</option>
                                <option value="female" @selected(old('gender', $student->gender) === 'female')>أنثى</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                is_active
                            </label>
                            <select name="is_active"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                                <option value="1" @selected((int)old('is_active', $student->is_active) === 1)>نشط</option>
                                <option value="0" @selected((int)old('is_active', $student->is_active) === 0)>غير نشط</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3">
                        <button type="button" @click="open = false"
                            class="rounded-lg border px-4 py-2 font-bold">
                            {{ __('student.cancel') }}
                        </button>

                        <button type="submit"
                            class="rounded-lg bg-brand-500 px-4 py-2 font-bold text-white">
                            {{ __('student.save_data') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
{{-- </div> --}} --}}

@endsection
