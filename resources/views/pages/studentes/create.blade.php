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
                                    {{ trans('student.male') }}
                                </option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                    {{ trans('student.female') }}
                                </option>
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
                                <option value="national_id"
                                    {{ old('national_id_type') == 'national_id' ? 'selected' : '' }}>
                                    {{ trans('student.national_id') }}
                                </option>
                                <option value="passport" {{ old('national_id_type') == 'passport' ? 'selected' : '' }}>
                                    {{ trans('student.passport') }}
                                </option>
                                <option value="residency" {{ old('national_id_type') == 'residency' ? 'selected' : '' }}>
                                    {{ trans('student.residency') }}
                                </option>
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
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name_ar }} - {{ $class->section }} (الصف {{ $class->grade_level }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== Parent Card ==================== -->

            <!-- ==================== Files Card ==================== -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">ملفات الطالب</h2>
                <!-- قسم صورة الطالب -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            صورة الطالب
                        </label>
                        <div x-data="{ imagePreview: null }" class="relative">
                            <label for="studentImage"
                                class="cursor-pointer flex flex-row-reverse items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-4 hover:border-brand-500 transition-colors duration-200 min-h-[120px] w-full">

                                <template x-if="imagePreview">
                                    <div class="flex justify-center items-center w-full">
                                        <img :src="imagePreview"
                                            class="h-20 w-20 rounded-lg object-cover border border-gray-200"
                                            alt="معاينة صورة الطالب">
                                    </div>
                                </template>

                                <template x-if="!imagePreview">
                                    <div class="text-center">
                                        <div class="mb-2 flex justify-center">
                                            <div
                                                class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 text-gray-600">
                                                <svg class="fill-current w-5 h-5" viewBox="0 0 29 28" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M14.5019 3.91699C14.2852 3.91699 14.0899 2.00891 13.953 4.15589L8.57363 9.53186C8.28065 9.82466 8.2805 10.2995 8.5733 10.5925C8.8661 10.8855 9.34097 10.8857 9.63396 10.5929L13.7519 6.47752V18.667C13.7519 19.0812 14.0877 19.417 14.5019 19.417C14.9161 19.417 15.2519 19.0812 15.2519 18.667V6.48234L19.3653 10.5929C19.6583 10.8857 20.1332 10.8855 20.426 10.5925C20.7188 10.2995 20.7186 9.82463 20.4256 9.53184L15.0838 4.19378C14.9463 4.02488 14.7367 3.91699 14.5019 3.91699ZM5.91626 18.667C5.91626 18.2528 5.58047 17.917 5.16626 17.917C4.75205 17.917 4.41626 18.2528 4.41626 18.667V21.8337C4.41626 23.0763 5.42362 24.0837 6.66626 24.0837H22.3339C23.5766 24.0837 24.5839 23.0763 24.5839 21.8337V18.667C24.5839 18.2528 24.2482 17.917 23.8339 17.917C23.4197 17.917 23.0839 18.2528 23.0839 18.667V21.8337C23.0839 22.2479 22.7482 22.5837 22.3339 22.5837H6.66626C6.25205 22.5837 5.91626 22.2479 5.91626 21.8337V18.667Z"
                                                        fill="" />
                                                </svg>
                                            </div>
                                        </div>

                                        <span class="text-xs text-brand-500 font-medium">
                                            اضغط لرفع صورة الطالب
                                        </span>
                                    </div>
                                </template>
                            </label>

                            <input id="studentImage" name="student_image" type="file" class="hidden" accept="image/*"
                                @change="imagePreview = URL.createObjectURL($event.target.files[0])" />
                        </div>
                    </div>

                    <!-- قسم شهادة الطالب -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            شهادة الطالب
                        </label>

                        <div x-data="{ certificatePreview: null }" class="relative">
                            <label for="studentCertificate"
                                class="cursor-pointer flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-4 hover:border-brand-500 transition-colors duration-200 min-h-[120px] w-full">

                                <template x-if="certificatePreview">
                                    <div class="flex justify-center items-center w-full">
                                        <div class="text-center">
                                            <div class="mb-2 flex justify-center">
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-success-100 text-success-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <span class="text-sm text-gray-700 font-medium"
                                                x-text="$event.target.files[0].name"></span>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="!certificatePreview">
                                    <div class="text-center">
                                        <div class="mb-2 flex justify-center">
                                            <div
                                                class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <span class="text-xs text-brand-500 font-medium">
                                            اضغط لرفع شهادة الطالب
                                        </span>
                                    </div>
                                </template>
                            </label>

                            <input id="studentCertificate" name="student_certificate" type="file" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                @change="certificatePreview = $event.target.files[0] ? true : null" />
                        </div>
                    </div>
                </div>
                <!-- قسم الملفات الإضافية -->
                <div x-data="{ additionalFiles: [] }" class="mb-6">

                    <h2 class="text-xl font-bold text-gray-800 mb-6">ملفات إضافية</h2>

                    <div class="flex justify-between items-center mb-4">


                        <button type="button" @click="additionalFiles.push({ file: null, name: '' })"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-black bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            إضافة ملف
                        </button>
                    </div>

                    {{-- <template x-for="(fileItem, index) in additionalFiles" :key="index">
                        <div class="flex items-center space-x-3 mb-3 space-x-reverse">
                            <div class="flex-1">
                                <input type="text" :name="'additional_files_name[' + index + ']'"
                                    x-model="fileItem.name" placeholder="اسم الملف"
                                    class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm
                    focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-200">
                            </div>

                            <div class="relative flex-1">
                                <label :for="'additionalFile_' + index"
                                    class="cursor-pointer flex items-center justify-between rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 hover:border-brand-500 transition-colors duration-200">
                                    <span x-text="fileItem.file ? fileItem.file.name : 'اختر ملف'"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </label>

                                <input :id="'additionalFile_' + index" :name="'additional_files[' + index + ']'"
                                    type="file" class="hidden" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                    @change="fileItem.file = $event.target.files[0]">
                            </div>

                            <button type="button" @click="additionalFiles.splice(index, 1)"
                                class="text-error-500 hover:text-error-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </template> --}}
                    {{-- new --}}
                    <template x-for="(fileItem, index) in additionalFiles" :key="index">

                        <div
                            class="relative bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition mb-6">

                            <!-- زر حذف -->
                           <button type="button" @click="additionalFiles.splice(index, 1)"
                                class="text-error-500 hover:text-error-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">

                                <!-- اسم الملف -->
                                <div>
                                    <label  class="block text-sm font-semibold text-gray-700 mb-2">
                                        اسم الملف
                                    </label>

                                    <input type="text" :name="'additional_files_name[' + index + ']'"
                                    x-model="fileItem.name" placeholder="اسم الملف"
                                        class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm
                              focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-200">
                                                                  <span x-text="fileItem.file ? fileItem.file.name : 'اختر ملف'"></span>

                                </div>

                                <!-- رفع الملف -->
                                <div>
                                    <label :for="'additionalFile_' + index" class="block text-sm font-semibold text-gray-700 mb-2">
                                                                            <span x-text="fileItem.file ? fileItem.file.name : 'اختر ملف'"></span>
                                    
                                    </label>

                                    <label :for="'additionalFile_' + index"
                                        class="cursor-pointer h-[54px] flex items-center justify-between gap-3 px-4
                           rounded-xl border-2 border-dashed border-gray-300 bg-gray-50
                           hover:bg-white hover:border-brand-500 transition">

                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 flex items-center justify-center
                                    rounded-full bg-brand-50 text-brand-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-3-3v6m5 5H7a2 2 0
                                             01-2-2V5a2 2 0
                                             012-2h5.586a1 1
                                             0 01.707.293l5.414
                                             5.414a1 1 0
                                             01.293.707V19a2
                                             2 0 01-2 2z" />
                                                </svg>
                                            </div>

                                            <span class="text-sm text-gray-700 truncate max-w-[220px]"
                                                x-text="fileItem.file ? fileItem.file.name : 'اضغط لاختيار ملف'">
                                            </span>
                                        </div>

                                        <span class="text-xs text-brand-500 font-semibold">
                                            تصفح
                                        </span>
                                    </label>

                                <input :id="'additionalFile_' + index" :name="'additional_files[' + index + ']'"
                                    type="file" class="hidden" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                    @change="fileItem.file = $event.target.files[0]">

                                </div>

                            </div>

                        </div>

                    </template>


                </div>

            </div>

            <!-- ==================== Submit Button ==================== -->
            <button type="submit" class="px-6 py-2 my-6 space-y-5 rounded-lg bg-brand-500 text-white">
                {{ trans('student.save_data') }}
            </button>
        </form>
    </div>
@endsection
