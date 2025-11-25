@extends('layouts.app')
@section('title', __('student.register_student'))
@section('Breadcrumb', __('student.new_student_register'))
@section('addButton')
    <x-modals.success-modal />
    <x-modals.error-modal />
@endsection
@section('content')
    <div>
        <form class="space-y-8" method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- ==================== Student Card ==================== -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl my-6">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        {{ trans('student.student_details') }}
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Name EN -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.full_name_in_english') }}
                        </label>
                        <div>
                            <input value="{{ old('name_en') }}" name="name_en"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                    </div>
                    
                    <!-- Name AR -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.full_name_in_arabic') }}
                        </label>
                        <div>
                            <input value="{{ old('name_ar') }}" name="name_ar"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.date_of_birth') }}
                        </label>
                        <div>
                            <input value="{{ old('birth_date') }}" type="date" name="birth_date"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.gender') }}
                        </label>
                        <div>
                            <select name="gender"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800">
                                <option value="">{{ trans('student.select_gender') }}</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                    {{ trans('student.male') }}</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                    {{ trans('student.female') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- National ID Type -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.national_id_type') }}
                        </label>
                        <div>
                            <select name="national_id_type"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800">
                                <option value="">{{ trans('student.select_type') }}</option>
                                <option value="national_id" {{ old('national_id_type') == 'national_id' ? 'selected' : '' }}>
                                    {{ trans('student.national_id') }}</option>
                                <option value="passport" {{ old('national_id_type') == 'passport' ? 'selected' : '' }}>
                                    {{ trans('student.passport') }}</option>
                                <option value="residency" {{ old('national_id_type') == 'residency' ? 'selected' : '' }}>
                                    {{ trans('student.residency') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- National ID -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.national_id_number') }}
                        </label>
                        <div>
                            <input value="{{ old('national_id') }}" name="national_id"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                    </div>

                    <!-- Nationality -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.nationality') }}
                        </label>
                        <div>
                            <input value="{{ old('nationality') }}" name="nationality"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                    </div>

                    <!-- School -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.present_school') }}
                        </label>
                        <div>
                            <input value="{{ old('previous_school') }}" name="previous_school"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                    </div>

                    <!-- Grade -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.grade_at_present_school') }}
                        </label>
                        <div>
                            <select name="class_id"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800">
                                <option value="">{{ trans('student.select_class') }}</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name_ar }} - {{ $class->section }} (الصف {{ $class->grade_level }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            

            <button type="submit" class="px-6 py-2 rounded-lg bg-brand-500 text-white">
                {{ trans('student.save_data') }}
            </button>
        </form>
    </div>
@endsection