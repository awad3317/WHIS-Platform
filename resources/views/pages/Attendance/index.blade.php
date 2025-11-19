@extends('layouts.app')
@section('title', trans('messages.Attendance'))
@section('content')

    <div class="p-6">
        {{-- رأس الصفحة --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between mb-6">

            {{-- العنوان والتاريخ --}}
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                    {{ trans('messages.Student Attendance') }}
                </h2>
                <p class="text-gray-500 dark:text-gray-400">23 Sep - 29 Sep 2024</p>
            </div>

            {{-- الفلاتر + التصدير --}}
            <div
                class="flex flex-1 flex-wrap items-center justify-start lg:justify-center gap-3 bg-gray-100 dark:bg-gray-700 px-4 py-3 rounded-2xl">

                {{-- اختيار الصف --}}
                <div class="flex items-center gap-2">
                    <label class="text-xs font-medium text-gray-600 dark:text-white">
                        {{ trans('messages.Class') ?? 'Class' }}
                    </label>
                    <select
                        class="text-xs rounded-xl border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-white focus:ring-0 focus:border-primary-500">
                        <option>Grade 1</option>
                        <option>Grade 2</option>
                        <option>Grade 3</option>
                    </select>
                </div>

                {{-- اختيار الشعبة / الفصل --}}
                <div class="flex items-center gap-2">
                    <label class="text-xs font-medium text-gray-600 dark:text-white">
                        {{ trans('messages.Section') ?? 'Section' }}
                    </label>
                    <select
                        class="text-xs rounded-xl border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-white focus:ring-0 focus:border-primary-500">
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                    </select>
                </div>

                {{-- نوع الفترة --}}
                <div class="flex items-center gap-2">
                    <label class="text-xs font-medium text-gray-600 dark:text-white">
                        {{ trans('messages.Period') ?? 'Period' }}
                    </label>
                    <select
                        class="text-xs rounded-xl border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-white focus:ring-0 focus:border-primary-500">
                        <option>{{ trans('Week') }} 1</option>
                        <option>{{ trans('Week') }} 2</option>
                        <option>{{ trans('Week') }} 3</option>
                        <option>{{ trans('Week') }} 4</option>
                    </select>
                </div>

                <div class="flex items-center gap-2" x-data="{ dateRange: '23 Sep - 29 Sep 2024' }" x-init="flatpickr($refs.rangePicker, {
                    mode: 'range',
                    dateFormat: 'd M Y',
                    defaultDate: ['2024-09-23', '2024-09-29'],
                    onChange: function(selectedDates, dateStr) {
                        dateRange = dateStr;
                    }
                });">

                    <span
                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
                        <svg xmlns='http://www.w3.org/2000/svg' class='w-4 h-4 text-gray-500 dark:text-gray-300'
                            fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'
                                d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z' />
                        </svg>
                    </span>

                    <input x-ref="rangePicker" x-model="dateRange"
                        class="text-xs rounded-xl border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-white px-3 py-1.5 focus:ring-0 focus:border-primary-500 cursor-pointer"
                        placeholder="Select Date Range" readonly />
                </div>


                {{-- أزرار التصدير --}}
                <div class="flex items-center gap-2 ml-auto">
                    <a href="#"
                        class="flex items-center gap-2 text-xs font-medium px-3 py-1.5 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-primary-600 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 16l3-3 3 3m-3-3v8M4 4h16v6H4z" />
                        </svg>
                        <span>Excel</span>
                    </a>

                    <a href="#"
                        class="flex items-center gap-2 text-xs font-medium px-3 py-1.5 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-error-600 dark:text-error-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 16v-8m0 0L9 11m3-3 3 3M6 20h12" />
                        </svg>
                        <span>PDF</span>
                    </a>
                </div>
            </div>

            {{-- البطاقات الإحصائية (تستخدم القيم المحسوبة من Alpine) --}}
            <div class="flex flex-wrap items-center gap-3 bg-gray-100 dark:bg-gray-700 px-4 py-3 rounded-full"
                x-data="{ dummy: false }">
                <span
                    class="flex items-center gap-2 bg-white dark:bg-gray-400 px-4 py-1.5 rounded-full shadow-sm border border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-50">
                        {{ trans('messages.Holiday') }}
                    </span>
                </span>

                <span
                    class="flex items-center gap-2 bg-white dark:bg-gray-800 px-4 py-1.5 rounded-full shadow-sm border border-gray-200  dark:border-gray-700">
                    <span class="text-sm font-medium text-success-500 dark:text-success-200"
                        x-text="'On time ' + (window.attendanceStats?.onTimePercent ?? 0) + '%'"></span>
                </span>

                <span
                    class="flex items-center gap-2 bg-white dark:bg-gray-800 px-4 py-1.5 rounded-full shadow-sm border border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-medium text-warning-500 dark:text-orange-300"
                        x-text="'Late ' + (window.attendanceStats?.latePercent ?? 0) + '%'"></span>
                </span>

                <span
                    class="flex items-center gap-2 bg-white dark:bg-gray-800 px-4 py-1.5 rounded-full shadow-sm border border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-medium text-error-500 dark:text-error-300"
                        x-text="'Absent ' + (window.attendanceStats?.absentPercent ?? 0) + '%'"></span>
                </span>
            </div>

        </div>

        {{-- المكوّن الرئيسي للحضور --}}
        <div x-data="{
            week: 1,
            selectAll: false,
            showModal: false,
            modalStudent: null,
        
            // الأيام التي تعتبر عطلة (مثال: اليوم 7، 14، 21، 28)
            holidays: [7, 14, 21, 28],
        
            // بيانات الطلاب (مثال فقط)
            students: [
                { id: 1, name: 'Marta Adams', selected: false, attendance: ['On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late'] },
                { id: 2, name: 'Mohammad', selected: false, attendance: ['Late', 'On time', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time'] },
                { id: 3, name: 'Sarah Johnson', selected: false, attendance: ['On time', 'Absent', 'On time', 'Late', 'On time', 'On time', 'Absent', 'Late', 'On time', 'On time', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late'] },
            ],
        
            onTimePercent: 0,
            latePercent: 0,
            absentPercent: 0,
        
            toggleAll() {
                this.students.forEach(s => s.selected = this.selectAll);
            },
        
            // تغيير حالة الحضور عند الضغط على الخلية
            changeStatus(student, index) {
                const order = ['On time', 'Late', 'Absent'];
                let current = student.attendance[index] ?? 'On time';
                let i = order.indexOf(current);
                if (i === -1) i = 0;
                const next = order[(i + 1) % order.length];
                student.attendance[index] = next;
                this.calculateStats();
            },
        
            openModal(student) {
                this.modalStudent = student;
                this.showModal = true;
            },
        
            closeModal() {
                this.showModal = false;
            },
        
            // حساب الإحصائيات العامة
            calculateStats() {
                let onTime = 0,
                    late = 0,
                    absent = 0,
                    total = 0;
        
                this.students.forEach(student => {
                    student.attendance.forEach((status, idx) => {
                        const day = idx + 1;
                        if (this.holidays.includes(day)) {
                            return; // لا نحسب الإجازات
                        }
                        if (!status) return;
        
                        total++;
                        if (status === 'On time') onTime++;
                        else if (status === 'Late') late++;
                        else if (status === 'Absent') absent++;
                    });
                });
        
                this.onTimePercent = total ? Math.round((onTime / total) * 100) : 0;
                this.latePercent = total ? Math.round((late / total) * 100) : 0;
                this.absentPercent = total ? Math.round((absent / total) * 100) : 0;
        
                // تخزينها في window لاستخدامها في البطاقات أعلاه
                window.attendanceStats = {
                    onTimePercent: this.onTimePercent,
                    latePercent: this.latePercent,
                    absentPercent: this.absentPercent,
                };
            }
        }" x-init="calculateStats()"
            class="overflow-x-auto bg-white dark:bg-white shadow-xl rounded-2xl border border-gray-200 dark:border-gray-700">

            {{-- شريط التحكم --}}
            <div
                class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <button @click="week = week > 1 ? week - 1 : 4; calculateStats()"
                        class="p-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                        :class="{ 'opacity-40 cursor-not-allowed': week === 1 }" :disabled="week === 1"
                        title="Previous Week">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5 dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <h2 class="text-sm font-semibold text-gray-700 dark:text-white">
                        {{ trans('messages.Attendance Overview') }}
                    </h2>

                    <button @click="week = week < 4 ? week + 1 : 4; calculateStats()"
                        class="p-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                        :class="{ 'opacity-40 cursor-not-allowed': week === 4 }" :disabled="week === 4" title="Next Week">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5 dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <span
                        class="ml-2 text-[12px] text-gray-500 dark:text-white font-medium border px-2 py-0.5 rounded-md bg-white dark:bg-gray-700">
                        {{ trans('messages.week') }} <span x-text="week"></span> •
                        <span x-text="'Days ' + ((week - 1) * 7 + 1) + '–' + (week * 7)"></span>
                    </span>
                </div>

                {{-- أسطورة الحالات --}}
                <div class="hidden md:flex items-center gap-4 text-xs text-gray-600 dark:text-gray-400">
                    <span class="flex items-center gap-1">
                        <span class="w-2.5 h-2.5 bg-success-500 rounded-full"></span> On time
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-2.5 h-2.5 bg-warning-400 rounded-full"></span> Late
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-2.5 h-2.5 bg-error-500 rounded-full"></span> Absent
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-2.5 h-2.5 bg-gray-400 rounded-full"></span> Holiday
                    </span>
                </div>
            </div>

            {{-- الجدول --}}
            <table class="min-w-[1800px] w-full text-sm text-center text-gray-800 dark:text-gray-200 border-collapse">
                <thead
                    class="sticky top-0 z-30 bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold uppercase text-gray-600 dark:text-gray-50">
                    <tr>
                        <th
                            class="sticky left-0 z-40 px-4 py-3 text-left bg-gray-100 dark:bg-gray-800 flex dark:text-white items-center gap-2">
                            <input type="checkbox" x-model="selectAll" @change="toggleAll()"
                                class="rounded text-indigo-600 focus:ring-indigo-500" />
                            {{ trans('Student Profile') }}
                        </th>
                        <template x-for="day in 30" :key="day">
                            <th x-show="Math.ceil(day / 7) === week"
                                class="px-3 py-3 border-l font-semibold text-gray-700 dark:text-white dark:bg-gray-600"
                                x-text="'Day ' + day"></th>
                        </template>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-100">
                    <template x-for="student in students" :key="student.id">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="flex items-center gap-3 px-4 py-3 sticky left-0 z-20 bg-white dark:bg-gray-700">
                                <input type="checkbox" x-model="student.selected"
                                    class="rounded text-indigo-600 focus:ring-indigo-500" />
                                <img :src="'{{ asset('tailadmin/src/images/user/user-0') }}' + student.id + '.jpg'"
                                    class="w-8 h-8 rounded-full object-cover" alt="">
                                <button type="button" @click="openModal(student)"
                                    class="font-medium text-gray-800 dark:text-white  hover:text-primary-600 dark:hover:text-primary-300 text-left">
                                    <span x-text="student.name"></span>
                                </button>
                            </td>

                            {{-- الأيام --}}
                            <template x-for="(status, index) in student.attendance" :key="index">
                                <td x-show="Math.ceil((index + 1) / 7) === week"
                                    class="px-3 py-2 border-l-4 rounded-md font-medium transition-all cursor-pointer select-none"
                                    :class="holidays.includes(index + 1) ?
                                        'bg-gray-100 border-gray-400 text-gray-600' :
                                        (status === 'On time' ?
                                            'bg-success-50 border-success-500 text-success-700 dark:bg-gray-700 dark:text-success-100' :
                                            (status === 'Late' ?
                                                'bg-warning-50 border-warning-500 text-warning-700 dark:bg-gray-700' :
                                                (status === 'Absent' ?
                                                    'bg-error-50 border-error-500 text-error-700 dark:bg-gray-700' :
                                                    'bg-white border-gray-200 text-gray-700')))"
                                    @click="!holidays.includes(index + 1) && changeStatus(student, index)"
                                    x-text="holidays.includes(index + 1) ? 'Holiday' : status">
                                </td>
                            </template>
                        </tr>
                    </template>
                </tbody>
            </table>

            {{-- النافذة المنبثقة لتفاصيل الطالب --}}
            <div x-show="showModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
                <div
                    class="w-full max-w-3xl bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-200 font-semibold">
                                <span x-text="modalStudent?.name?.charAt(0) ?? ''"></span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-50"
                                    x-text="modalStudent?.name"></h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Monthly Attendance Overview
                                </p>
                            </div>
                        </div>
                        <button @click="closeModal()"
                            class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 dark:text-gray-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="overflow-x-auto border border-gray-100 dark:border-gray-700 rounded-xl">
                        <table class="min-w-full text-xs text-center">
                            <thead class="bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-200">
                                <tr>
                                    <template x-for="day in 30" :key="'modal-' + day">
                                        <th class="px-2 py-2 border-l" x-text="'Day ' + day"></th>
                                    </template>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <template x-for="day in 30" :key="'modal-row-' + day">
                                        <td class="px-2 py-2 border-l font-medium"
                                            :class="holidays.includes(day) ?
                                                'bg-gray-100 text-gray-600' :
                                                (modalStudent?.attendance?.[day - 1] === 'On time' ?
                                                    'bg-success-50 text-success-700' :
                                                    (modalStudent?.attendance?.[day - 1] === 'Late' ?
                                                        'bg-warning-50 text-warning-700' :
                                                        (modalStudent?.attendance?.[day - 1] === 'Absent' ?
                                                            'bg-error-50 text-error-700' :
                                                            'bg-white text-gray-700')))"
                                            x-text="holidays.includes(day) ? 'Holiday' : (modalStudent?.attendance?.[day-1] || '-')">
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        {{-- Alpine.js في التخطيط العام لديك، فقط تأكد أنه مفعّل مرة واحدة في layout --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}

    </div>

@endsection
