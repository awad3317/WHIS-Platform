@extends('layouts.app')
@section('title', __('student.register_student'))
@section('Breadcrumb', __('student.new_student_register'))
@section('addButton')

@endsection
@section('content')
    <x-modals.success-modal />
    <x-modals.error-modal />
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
                                placeholder="{{ trans('student.enter_full_name_in_english') }}"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                        @error('name_en')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- Name AR -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.full_name_in_arabic') }}
                        </label>
                        <div>
                            <input value="{{ old('name_ar') }}" name="name_ar"
                                placeholder="{{ trans('student.enter_full_name_in_arabic') }}"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                        @error('name_ar')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.date_of_birth') }}
                        </label>
                        {{-- <div>
                            <input value="{{ old('birth_date') }}" type="date" name="birth_date"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div> --}}
                        <div class="relative">
                            <input value="{{ old('birth_date') }}" type="date" name="birth_date"
                                placeholder="Select date"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                onclick="this.showPicker()" />
                            <span
                                class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                        fill="" />
                                </svg>
                            </span>
                        </div>
                        @error('birth_date')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
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
                        @error('gender')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
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
                        @error('national_id_type')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- National ID -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.national_id_number') }}
                        </label>
                        <div>
                            <input value="{{ old('national_id') }}" name="national_id"
                                placeholder="{{ trans('student.Enter The National ID Number') }}"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                        @error('national_id')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nationality -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.nationality') }}
                        </label>
                        <div>
                            <input value="{{ old('nationality') }}" name="nationality"
                                placeholder="{{ trans('student.Enter The Nationality') }}"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                        @error('nationality')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- School -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.present_school') }}
                        </label>
                        <div>
                            <input value="{{ old('previous_school') }}" name="previous_school"
                                placeholder="{{ trans('student.Enter The Previous School') }}"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                        </div>
                        @error('previous_school')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
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
                        @error('class_id')
                            <span class="text-error-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- ==================== Parent Card ==================== -->

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl my-6">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        {{ trans('student.parent_details') }}
                    </h2>

                    <!-- زر إضافة ولي أمر جديد - خارج المودال -->
                    {{-- <button type="button" @click="isParentModalOpen = true"
                        class="inline-flex items-center px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        إضافة ولي أمر جديد
                    </button> --}}

                </div>
                @livewire('parents-register')
                {{-- <div class="p-6 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- اختيار ولي الأمر -->
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            ولي الأمر
                        </label>
                        <div class="flex gap-2">
                            <select id="parent_id" name="parent_id" required
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800">
                                <option value="">اختر ولي الأمر</option>
                                {{-- @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id')==$parent->id ? 'selected' : '' }}>
                                    {{ $parent->name_ar }} - {{ $parent->phone }}
                                </option>
                                @endforeach --}}
                {{-- </select> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div>  --}}
            </div>

            <!-- ==================== Files Card ==================== -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    {{ trans('student.student_files') }}
                </h2>
                <!-- قسم صورة الطالب -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">

                    <div class="mb-8">
                        <label class="block text-sm font-medium dark:text-white text-gray-700 mb-3">
                            {{ trans('student.student_image') }}
                        </label>
                        <div x-data="{ imagePreview: null }" class="relative">
                            <label for="studentImage"
                                class="cursor-pointer flex flex-row-reverse items-center justify-center rounded-xl border-2 border-dashed dark:bg-gray-800 border-gray-300 bg-gray-50 p-4 hover:border-brand-500 transition-colors duration-200 min-h-[120px] w-full">

                                <template x-if="imagePreview">
                                    <div class="flex justify-center items-center w-full">
                                        <img :src="imagePreview"
                                            class="h-20 w-20 rounded-lg object-cover border border-gray-200"
                                            alt="معاينة {{ trans('student.student_image') }}">
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
                                            {{ trans('student.upload_student_image') }}
                                        </span>
                                    </div>
                                </template>
                            </label>

                            <input id="studentImage" name="student_image" type="file" class="hidden"
                                accept="image/*" @change="imagePreview = URL.createObjectURL($event.target.files[0])" />
                        </div>
                    </div>

                    <!-- قسم شهادة الطالب -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium dark:text-white text-gray-700 mb-3">
                            {{ trans('student.student_certificate') }}
                        </label>

                        <div x-data="{ certificatePreview: null }" class="relative">
                            <label for="studentCertificate"
                                class="cursor-pointer flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 dark:bg-gray-800 bg-gray-50 p-4 hover:border-brand-500 transition-colors duration-200 min-h-[120px] w-full">

                                <template x-if="certificatePreview">
                                    <div class="flex justify-center items-center w-full">
                                        <div class="text-center">
                                            <div class="mb-2 flex justify-center">
                                                <div
                                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-success-100 text-success-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <span class="text-sm text-gray-700  font-medium"
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

                                        <span class="text-xs text-brand-500  font-medium">
                                            {{ trans('student.upload_student_certificate') }}
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

                    <h2 class="text-xl font-bold dark:text-white text-gray-800 mb-6">
                        {{ trans('student.additional_files') }}
                    </h2>

                    <div class="flex justify-between items-center mb-4">


                        <button type="button" @click="additionalFiles.push({ file: null, name: '' })"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs dark:text-white font-medium rounded-full shadow-sm text-black bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            {{ trans('student.add_file') }}
                        </button>
                    </div>


                    {{-- <template x-for="(fileItem, index) in additionalFiles" :key="index">
                        <div class="flex items-center space-x-3 mb-3 space-x-reverse">
                            <div class="flex-1">
                                    "text" :name="'additional_files_name[' + index + ']'" x-model="fileItem.name"
                                    placeholder="اسم الملف"
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

                                <input :id="'additionalFile_' + index" :name="'additional_files[' + index + ']'" type="file"
                                    class="hidden" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                    @change="fileItem.file = $event.target.files[0]">
                            </div>

                            <button type="button" @click="additionalFiles.splice(index, 1)"
                                class="text-error-500 hover:text-error-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </template> --}}
                    {{-- new --}}
                    <template x-for="(fileItem, index) in additionalFiles" :key="index">

                        <div
                            class="relative bg-white border dark:bg-gray-700 border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition mb-6">

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
                                    <label class="block text-sm font-semibold dark:text-white text-gray-700 mb-2">
                                        {{ trans('student.file_name') }}
                                    </label>

                                    <input type="text" :name="'additional_files_name[' + index + ']'"
                                        x-model="fileItem.name"
                                        placeholder="{{ trans('student.file_name_placeholder') }}"
                                        class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm
                                          focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-200">
                                    <span
                                        x-text="fileItem.file ? fileItem.file.name : trans('student.choose_file')"></span>

                                </div>

                                <!-- رفع الملف -->
                                <div>
                                    <label :for="'additionalFile_' + index"
                                        class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span
                                            x-text="fileItem.file ? fileItem.file.name : trans('student.choose_file')"></span>

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
                                                x-text="fileItem.file ? fileItem.file.name : trans('student.choose_file')">
                                            </span>
                                        </div>

                                        <span class="text-xs text-brand-500 font-semibold ">
                                            {{ trans('student.browse') }}
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
        {{-- @include('pages.parents.create-model') --}}

    </div>

@endsection
