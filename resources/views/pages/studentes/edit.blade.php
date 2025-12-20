<div x-data="{ isModalEditOpen: @if(session('openModalEdit')) true @else false @endif,imagePreview: null }">
    {{-- Modal box --}}
    <div x-show="isModalEditOpen" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999"
        style="display: none;">
        <div class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]" @click="isModalEditOpen = false">
        </div>
        <div class="relative w-full max-w-[630px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
            @php
                $student = session('student');
            @endphp
            @if ($student)
                <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                {{ __('student.academic_no') }}
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
                                {{ __('student.birth_date') }}
                            </label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date) }}"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                {{ __('student.gender') }}
                            </label>
                            <select name="gender"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                                <option value="">اختر</option>
                                <option value="male" @selected(old('gender', $student->gender) == 'male')>ذكر</option>
                                <option value="female" @selected(old('gender', $student->gender) == 'female')>أنثى
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                {{ __( 'student.status') }}
                            </label>
                            <select name="is_active"
                                class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                                <option value="1" @selected((int) old('is_active', $student->is_active) === 1)>نشط
                                </option>
                                <option value="0" @selected((int) old('is_active', $student->is_active) === 0)>غير نشط
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3">
                        <button type="button" @click="isModalEditOpen = false"
                            class="rounded-lg border px-4 py-2 font-bold">
                            {{ __('student.cancel') }}
                        </button>

                        <button type="submit" class="rounded-lg bg-brand-500 px-4 py-2 font-bold text-white">
                            {{ __('student.save_data') }}
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>