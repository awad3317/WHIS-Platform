@extends('layouts.app')
@section('title', __('Register Student'))

@section('content')

    <div x-data="{
        errors: {},
    
        student: { editable: true, approved: false },
        father: { editable: true, approved: false },
        mother: { editable: true, approved: false },
        files: { editable: true, approved: false },
        isModalOpen: false,
    
        saveFather() {
            this.errors = {}
    
            if (!this.$refs.modal_father_name?.value.trim())
                this.errors.father_name = '{{ trans('student.Father/Guardians’s Name') }} {{ trans('validation.required') }}'
    
            if (!this.$refs.modal_father_phone?.value.trim())
                this.errors.father_phone = '{{ trans('student.Mobile Phone') }} {{ trans('validation.required') }}'
    
            if (Object.keys(this.errors).length == 0) {
                this.$refs.father_name.value = this.$refs.modal_father_name.value
                this.$refs.father_phone.value = this.$refs.modal_father_phone.value
                this.isModalOpen = false
            }
        },
    
        /* ========== Student ========== */
        approveStudent() {
            this.errors = {}
    
            if (!this.$refs.name_en?.value.trim())
                this.errors.name_en = '{{ trans('student.Full Name in English') }} {{ trans('validation.required') }}'
    
            if (!this.$refs.name_ar?.value.trim())
                this.errors.name_ar = '{{ trans('student.Full Name in Arabic') }} {{ trans('validation.required') }}'
    
            if (!this.$refs.birth_date?.value)
                this.errors.birth_date = '{{ trans('student.Date of Birth') }} {{ trans('validation.required') }}'
    
            if (!this.$refs.nationality?.value.trim())
                this.errors.nationality = '{{ trans('student.Nationality') }} {{ trans('validation.required') }}'
    
            if (!this.$refs.previous_school?.value.trim())
                this.errors.previous_school = '{{ trans('student.Present School') }} {{ trans('validation.required') }}'
    
            if (!this.$refs.class_id?.value.trim())
                this.errors.class_id = '{{ trans('student.Class') }} {{ trans('validation.required') }}'
    
            if (Object.keys(this.errors).length === 0) {
                this.student.editable = false
                this.student.approved = true
            }
        },
    
        /* ========== Father ========== */
        approveFather() {
            this.errors = {}
    
            if (!this.$refs.father_name?.value.trim())
                this.errors.father_name = '{{ trans('student.Father/Guardians’s Name') }} {{ trans('validation.required') }}'
    
            if (!this.$refs.father_phone?.value.trim())
                this.errors.father_phone = '{{ trans('student.Mobile Phone') }} {{ trans('validation.required') }}'
    
            if (Object.keys(this.errors).length === 0) {
                this.father.editable = false
                this.father.approved = true
            }
        },
    
        /* ========== Mother ========== */
        approveMother() {
            this.errors = {}
    
            if (!this.$refs.mother_name?.value.trim())
                this.errors.mother_name = '{{ trans('student.Mother’s Name in Arabic') }} {{ trans('validation.required') }}'
    
            if (!this.$refs.mother_phone?.value.trim())
                this.errors.mother_phone = '{{ trans('student.Mobile Phone') }} {{ trans('validation.required') }}'
    
            if (Object.keys(this.errors).length === 0) {
                this.mother.editable = false
                this.mother.approved = true
            }
        },
    
        /* ========== Files ========== */
        approveFiles() {
            this.errors = {}
            if (!this.$refs.files?.files || this.$refs.files.files.length === 0)
                this.errors.files = '{{ trans('student.StudentRegistrationRequirements') }} {{ trans('validation.required') }}'
    
            if (Object.keys(this.errors).length === 0) {
                this.files.editable = false
                this.files.approved = true
            }
        },
    
    
    }">
        <form class="space-y-8">

            <!-- ==================== Student Card ==================== -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl my-6">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        {{ trans('student.Student’sDetails') }}
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Name EN -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.Full Name in English') }}
                        </label>

                        <div x-show="student.editable">
                            <input x-ref="name_en" name="name_en"
                                   class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white"/>
                            <p x-show="errors.name_en" class="text-error-500 text-sm mt-1" x-text="errors.name_en"></p>
                        </div>

                        <div x-show="student.approved">
                            <p class="bg-gray-100 p-3 rounded-lg text-gray-800" x-text="$refs.name_en?.value"></p>
                        </div>
                    </div>
                    <!-- Name AR -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.Full Name in Arabic') }}
                        </label>

                        <div x-show="student.editable">
                            <input x-ref="name_ar" name="name_ar"
                                  class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                            <p x-show="errors.name_ar" class="text-error-500 text-sm mt-1" x-text="errors.name_ar"></p>
                        </div>

                        <div x-show="student.approved">
                            <p class="bg-gray-100 p-3 rounded-lg text-gray-800" x-text="$refs.name_en?.value"></p>
                        </div>
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.Date of Birth') }}
                        </label>

                        <div x-show="student.editable">
                            <input x-ref="birth_date" type="date"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                            <p x-show="errors.birth_date" class="text-error-500 text-sm mt-1" x-text="errors.birth_date">
                            </p>
                        </div>

                        <div x-show="student.approved">
                            <p class="bg-gray-100 p-3 rounded-lg text-gray-800" x-text="$refs.birth_date?.value"></p>
                        </div>
                    </div>

                    <!-- Nationality -->
                    <div>
                        <label
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Nationality') }}</label>

                        <div x-show="student.editable">
                            <input x-ref="nationality"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                            <p x-show="errors.nationality" class="text-error-500 text-sm mt-1" x-text="errors.nationality">
                            </p>
                        </div>

                        <div x-show="student.approved">
                            <p class="bg-gray-100 p-3 rounded-lg text-gray-800" x-text="$refs.nationality?.value"></p>
                        </div>
                    </div>

                    <!-- School -->
                    <div>
                        <label
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Present School') }}</label>

                        <div x-show="student.editable">
                            <input x-ref="previous_school"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                            <p x-show="errors.previous_school" class="text-error-500 text-sm mt-1"
                                x-text="errors.previous_school"></p>
                        </div>

                        <div x-show="student.approved">
                            <p class="bg-gray-100 p-3 rounded-lg text-gray-800" x-text="$refs.previous_school?.value"></p>
                        </div>
                    </div>

                    <!-- Grade -->
                    <div>
                        <label
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Grade at Present School') }}</label>

                        <div x-show="student.editable">
                            <input x-ref="class_id"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                            <p x-show="errors.class_id" class="text-error-500 text-sm mt-1" x-text="errors.class_id"></p>
                        </div>

                        <div x-show="student.approved">
                            <p class="bg-gray-100 p-3 rounded-lg text-gray-800" x-text="$refs.class_id?.value"></p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end p-6 gap-3">
                    <button type="button" x-show="student.editable" @click="approveStudent()"
                        class="px-6 py-2 rounded-lg bg-success-500 text-white">
                        اعتماد
                    </button>

                    <button type="button" x-show="student.approved" @click="student.approved=false; student.editable=true"
                        class="px-6 py-2 rounded-lg bg-warning-500 text-white">
                        تعديل
                    </button>
                </div>
            </div>

            <!-- ==================== Father Card ==================== -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl my-6">

                <!-- العنوان -->
                <div class="px-6 py-5 border-b flex items-center justify-between">

                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        {{ trans('student.Father’sDetails') }}
                    </h2>

                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                        @click="isModalOpen = true">
                        اضافة اب جديد
                    </button>

                </div>


                <!-- زر الإضافة + المودال -->
                <div class="border-t border-gray-100 p-6 dark:border-gray-800">
                    <div>


                        <div x-show="isModalOpen"
                            class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
                            style="display: none;">

                            <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]">
                            </div>

                            <div @click.outside="isModalOpen = false"
                                class="relative w-full max-w-[630px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">

                                <!-- close btn -->
                                <button @click="isModalOpen = false"
                                    class="group absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-200 text-gray-500 transition-colors hover:bg-gray-300 hover:text-gray-500 dark:bg-gray-800 dark:hover:bg-gray-700 sm:right-6 sm:top-6 sm:h-11 sm:w-11">

                                    <svg class="transition-colors fill-current group-hover:text-gray-600 dark:group-hover:text-gray-200"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                                            fill=""></path>
                                    </svg>
                                </button>

                                <form>
                                    <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                                        Personal Information
                                    </h4>

                                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">
                                        <div class="col-span-1">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">First
                                                Name</label>
                                            <input type="text" placeholder="Musharof"
                                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs">
                                        </div>

                                        <div class="col-span-1">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Last
                                                Name</label>
                                            <input type="text" placeholder="Chowdhury"
                                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs">
                                        </div>

                                        <div class="col-span-1">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                                            <input type="email" placeholder="randomuser@pimjo.com"
                                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs">
                                        </div>

                                        <div class="col-span-1">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Phone</label>
                                            <input type="text" placeholder="+09 363 398 46"
                                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs">
                                        </div>

                                        <div class="col-span-1 sm:col-span-2">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Bio</label>
                                            <input type="text" placeholder="Team Manager"
                                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs">
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end w-full gap-3 mt-6">
                                        <button @click="isModalOpen = false" type="button"
                                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 sm:w-auto">
                                            Close
                                        </button>

                                        <button type="button" @click="saveFather()"
                                            class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- الحقول -->
                <div class="p-6 grid grid-cols-1 xl:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.Father/Guardians’s Name') }}
                        </label>

                        <div x-show="father.editable">
                            <input x-ref="father_name"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white  " />
                            <p x-show="errors.father_name" class="text-error-500" x-text="errors.father_name"></p>
                        </div>

                        <div x-show="father.approved">
                            <p class="bg-gray-100 p-3 rounded-lg" x-text="$refs.father_name?.value"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                            {{ trans('student.Mobile Phone') }}
                        </label>

                        <div x-show="father.editable">
                            <input x-ref="father_phone"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                            <p x-show="errors.father_phone" class="text-error-500" x-text="errors.father_phone"></p>
                        </div>

                        <div x-show="father.approved">
                            <p class="bg-gray-100 p-3 rounded-lg" x-text="$refs.father_phone?.value"></p>
                        </div>
                    </div>

                </div>

                <!-- أزرار التحكم -->
                <div class="flex justify-end p-6 gap-3">
                    <button type="button" x-show="father.editable" @click="approveFather()"
                        class="px-6 py-2 rounded-lg bg-success-500 text-white">
                        اعتماد
                    </button>

                    <button type="button" x-show="father.approved" @click="father.approved=false; father.editable=true"
                        class="px-6 py-2 rounded-lg bg-warning-500 text-white">
                        تعديل
                    </button>
                </div>

            </div>


            <!-- ==================== Mother Card ==================== -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl my-6">

                <div class="px-6 py-5 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        {{ trans('student.Mother’sDetails') }}
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 xl:grid-cols-2 gap-6">

                    <div>
                        <label
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Mother’s Name in Arabic') }}</label>

                        <div x-show="mother.editable">
                            <input x-ref="mother_name"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                            <p x-show="errors.mother_name" class="text-error-500" x-text="errors.mother_name"></p>
                        </div>

                        <div x-show="mother.approved">
                            <p class="bg-gray-100 p-3 rounded-lg" x-text="$refs.mother_name?.value"></p>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">{{ trans('student.Mobile Phone') }}</label>

                        <div x-show="mother.editable">
                            <input x-ref="mother_phone"
                                class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white" />
                            <p x-show="errors.mother_phone" class="text-error-500" x-text="errors.mother_phone"></p>
                        </div>

                        <div x-show="mother.approved">
                            <p class="bg-gray-100 p-3 rounded-lg" x-text="$refs.mother_phone?.value"></p>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end p-6 gap-3">
                    <button type="button" x-show="mother.editable" @click="approveMother()"
                        class="px-6 py-2 rounded-lg bg-success-500 text-white">
                        اعتماد
                    </button>

                    <button type="button" x-show="mother.approved" @click="mother.approved=false; mother.editable=true"
                        class="px-6 py-2 rounded-lg bg-warning-500 text-white">
                        تعديل
                    </button>
                </div>

            </div>

            <!-- ==================== Files Card ==================== -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl my-6">

                <div class="px-6 py-5 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        {{ trans('student.StudentRegistrationRequirements') }}
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">

                    @foreach (['Personal photo', 'birth certificate', 'Vaccination certificate', 'Student’s previous and current certificates', 'A copy of the passport', 'Certificate from the Yemeni Ministry of Foreign Affairs and Consulate', 'Expatriate form', 'Medical fitness form'] as $field)
                        <div class="space-y-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-white">
                                {{ trans('student.' . $field) }}
                            </label>
                            <div class="relative">
                                <label for="fileUpload"
                                    class="cursor-pointer block rounded-xl border border-dashed border-gray-300 bg-gray-50 p-7 lg:p-10 dark:border-gray-100 dark:text-white dark:bg-gray-900 hover:border-brand-500 dark:hover:border-brand-500">

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

                    <div x-show="files.approved">
                        <p class="bg-gray-100 p-3 rounded-lg text-gray-800">
                            {{ __('Files Approved') }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-end p-6 gap-3">
                    <button type="button" x-show="files.editable" @click="approveFiles()"
                        class="px-6 py-2 rounded-lg bg-success-500 text-white">
                        اعتماد
                    </button>
                    <button type="button" x-show="files.approved" @click="files.approved=false; files.editable=true"
                        class="px-6 py-2 rounded-lg bg-warning-500 text-white">
                        تعديل
                    </button>

                    <button type="submit" class="px-6 py-2 rounded-lg bg-brand-500 text-white">
                        {{ trans('student.Save Data') }}
                    </button>
                </div>

            </div>

        </form>
    </div>

@endsection
