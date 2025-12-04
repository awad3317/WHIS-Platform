@extends('layouts.app')
@section('title', __('Register Employee'))

@section('content')

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700 shadow-xl my-6">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ trans('employee.employee_details') }}
            </h2>
        </div>
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="p-6 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- الاسم بالعربية -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.full_name_in_arabic') }}
                    </label>
                    <div>
                        <input value="{{ old('name_ar') }}" name="name_ar" required
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- الاسم بالإنجليزية -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.full_name_in_english') }}
                    </label>
                    <div>
                        <input value="{{ old('name_en') }}" name="name_en"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- البريد الإلكتروني -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.email') }}
                    </label>
                    <div>
                        <input type="email" value="{{ old('email') }}" name="email"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- رقم الهوية الوطنية -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.national_id_number') }}
                    </label>
                    <div>
                        <input value="{{ old('national_id') }}" name="national_id" required
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- نوع الهوية -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.national_id_type') }}
                    </label>
                    <div>
                        <select name="national_id_type"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800">
                            <option value="">{{ trans('employee.select_type') }}</option>
                            <option value="national_id" {{ old('national_id_type') == 'national_id' ? 'selected' : '' }}>
                                {{ trans('employee.national_id') }}
                            </option>
                            <option value="passport" {{ old('national_id_type') == 'passport' ? 'selected' : '' }}>
                                {{ trans('employee.passport') }}
                            </option>
                            <option value="residence_id" {{ old('national_id_type') == 'residence_id' ? 'selected' : '' }}>
                                {{ trans('employee.residence_id') }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- المسمى الوظيفي -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.job_title') }}
                    </label>
                    <div>
                        <input value="{{ old('job_title') }}" name="job_title" required
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- القسم -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.department') }}
                    </label>
                    <div>
                        <select name="department"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800">
                            <option value="">{{ trans('employee.select_department') }}</option>
                            <option value="admin" {{ old('department') == 'admin' ? 'selected' : '' }}>
                                {{ trans('employee.admin') }}
                            </option>
                            <option value="teaching" {{ old('department') == 'teaching' ? 'selected' : '' }}>
                                {{ trans('employee.teaching') }}
                            </option>
                            <option value="support" {{ old('department') == 'support' ? 'selected' : '' }}>
                                {{ trans('employee.support') }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- المؤهل العلمي -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.qualification') }}
                    </label>
                    <div>
                        <input value="{{ old('qualification') }}" name="qualification"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- سنة التخرج -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.graduation_year') }}
                    </label>
                    <div>
                        <input type="number" min="1900" max="{{ date('Y') }}" value="{{ old('graduation_year') }}"
                            name="graduation_year" placeholder="YYYY"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- رقم الهاتف -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.phone') }}
                    </label>
                    <div>
                        <input type="tel" value="{{ old('phone') }}" name="phone"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- الراتب -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.salary') }}
                    </label>
                    <div>
                        <input type="number" step="0.01" min="0" value="{{ old('salary') }}" name="salary"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- عدد الحصص الأسبوعية (للمعلمين) -->
                <div id="weeklyClassesField" style="display: none;">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.weekly_classes') }}
                    </label>
                    <div>
                        <input type="number" min="0" value="{{ old('weekly_classes', 0) }}" name="weekly_classes"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800" />
                    </div>
                </div>

                <!-- المواد الدراسية (للمعلمين) -->
                <div id="subjectsField" style="display: none;">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.subjects') }}
                    </label>
                    <div>
                        <select name="subjects[]" multiple
                            class="h-32 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800">
                            <!-- يمكنك إضافة خيارات المواد هنا -->
                            <option value="math" {{ in_array('math', old('subjects', [])) ? 'selected' : '' }}>
                                الرياضيات
                            </option>
                            <option value="science" {{ in_array('science', old('subjects', [])) ? 'selected' : '' }}>
                                العلوم
                            </option>
                            <option value="arabic" {{ in_array('arabic', old('subjects', [])) ? 'selected' : '' }}>
                                اللغة العربية
                            </option>
                            <option value="english" {{ in_array('english', old('subjects', [])) ? 'selected' : '' }}>
                                اللغة الإنجليزية
                            </option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">{{ trans('employee.hold_ctrl_to_select_multiple') }}</p>
                    </div>
                </div>

                <!-- الحالة -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">
                        {{ trans('employee.status') }}
                    </label>
                    <div>
                        <select name="is_active"
                            class="h-12 w-full rounded-xl border px-4 text-sm border-gray-300 dark:border-gray-100 dark:text-white dark:bg-gray-800">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                                {{ trans('employee.active') }}
                            </option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                                {{ trans('employee.inactive') }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="px-6 py-2 my-6 space-y-5 rounded-lg bg-brand-500 text-white">
                {{ trans('student.save_data') }}
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const departmentSelect = document.querySelector('select[name="department"]');
            const weeklyClassesField = document.getElementById('weeklyClassesField');
            const subjectsField = document.getElementById('subjectsField');

            function toggleTeachingFields() {
                if (departmentSelect.value === 'teaching') {
                    weeklyClassesField.style.display = 'block';
                    subjectsField.style.display = 'block';
                } else {
                    weeklyClassesField.style.display = 'none';
                    subjectsField.style.display = 'none';
                }
            }

            // التشغيل الأولي
            toggleTeachingFields();

            // عند تغيير القسم
            departmentSelect.addEventListener('change', toggleTeachingFields);
        });
    </script>
@endsection