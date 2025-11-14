@extends('layouts.app')
@section('title', __('messages.Attendance'))
@section('content')

    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ trans('messages.Student Attendance') }}
                </h2>
                <p class="text-gray-500 dark:text-gray-400">23 Sep - 29 Sep 2024</p>
            </div>

            <!-- Legend -->
            <div class="flex flex-wrap items-center gap-3 bg-gray-100 dark:bg-gray-700 px-4 py-3 rounded-full">
                <!-- Holiday -->
                <span
                    class="flex items-center gap-2 bg-white dark:bg-gray-400 px-4 py-1.5 rounded-full shadow-sm border border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-50">{{ trans('messages.Holiday') }}</span>
                </span>

                <!-- On time -->
                <span
                    class="flex items-center gap-2 bg-white dark:bg-gray-800 px-4 py-1.5 rounded-full shadow-sm border border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-medium text-success-500 dark:text-gray-100">On time 82%</span>
                </span>

                <!-- Late -->
                <span
                    class="flex items-center gap-2 bg-white dark:bg-gray-800 px-4 py-1.5 rounded-full shadow-sm border border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-medium text-warning-500 dark:text-gray-100">Late 10%</span>
                </span>

                <!-- Absent -->
                <span
                    class="flex items-center gap-2 bg-white dark:bg-gray-800 px-4 py-1.5 rounded-full shadow-sm border border-gray-200 dark:border-gray-700">
                    <span class="text-sm font-medium text-error-500 dark:text-gray-100">Absent 8%</span>
                </span>
            </div>

        </div>

        <div x-data="{
            week: 1,
            selectAll: false,
            // الأيام التي تعتبر عطلة
            holidays: [7, 14, 21, 28], // مثال: كل يوم جمعة
            students: [
                { id: 1, name: 'Marta Adams', selected: false, attendance: ['On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late'] },
                { id: 2, name: 'Mohammad', selected: false, attendance: ['Late', 'On time', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time'] },
                { id: 3, name: 'Sarah Johnson', selected: false, attendance: ['On time', 'Absent', 'On time', 'Late', 'On time', 'On time', 'Absent', 'Late', 'On time', 'On time', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'Late', 'On time', 'Absent', 'On time', 'On time', 'Late', 'Absent', 'On time', 'On time', 'Late'] },
            ],
            toggleAll() {
                this.students.forEach(s => s.selected = this.selectAll);
            }
        }"
            class="overflow-x-auto bg-white dark:bg-white shadow-xl rounded-2xl border border-gray-200 dark:border-gray-700">

            <!-- شريط التحكم -->
            <div
                class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <button @click="week = week > 1 ? week - 1 : 4"
                        class="p-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                        :class="{ 'opacity-40 cursor-not-allowed': week === 1 }" :disabled="week === 1"
                        title="Previous Week">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5 dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <h2 class="text-sm font-semibold text-gray-700 dark:text-white">
                        {{ trans('messages.Attendance Overview') }}</h2>

                    <button @click="week = week < 4 ? week + 1 : 4"
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

                <!-- الأسطورة -->
                <div class="hidden md:flex items-center gap-4 text-xs text-gray-600 dark:text-gray-400">
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-success-500 rounded-full"></span> On
                        time</span>
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-warning-400 rounded-full"></span>
                        Late</span>
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-error-500 rounded-full"></span>
                        Absent</span>
                    <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-gray-400 rounded-full"></span>
                        Holiday</span>
                </div>
            </div>

            <!-- الجدول -->
            <table class="min-w-[1800px] w-full text-sm text-center text-gray-800 dark:text-gray-200 border-collapse">
                <thead
                    class="sticky top-0 z-30 bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold uppercase text-gray-600 dark:text-gray-50">
                    <tr>
                        <th
                            class="sticky left-0 z-40 px-4 py-3 text-left bg-gray-100 dark:bg-gray-800 flex dark:text-white items-center gap-2">
                            <input type="checkbox" x-model="selectAll" @change="toggleAll()"
                                class="rounded text-indigo-600 focus:ring-indigo-500" />
                            Student Profile
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
                            <td class="flex items-center gap-3 px-4 py-3 sticky left-0 z-20 bg-white dark:bg-gray-100">
                                <input type="checkbox" x-model="student.selected"
                                    class="rounded text-indigo-600 focus:ring-indigo-500" />
                                <img :src="'{{ asset('tailadmin/src/images/user/user-0') }}' + student.id + '.jpg'"
                                    class="w-8 h-8 rounded-full" alt="">
                                <span class="font-medium text-gray-800 dark:text-gray-100" x-text="student.name"></span>
                            </td>

                            <!-- الأيام -->
                            <template x-for="(status, index) in student.attendance" :key="index">
                                <td x-show="Math.ceil((index + 1) / 7) === week"
                                    class="px-3 py-2 border-l-4 rounded-md font-medium transition-all"
                                    :class="holidays.includes(index + 1) ?
                                        'bg-gray-100 border-gray-400 text-gray-600' :
                                        (status === 'On time' ?
                                            'bg-success-50 border-success-500 text-success-700' :
                                            (status === 'Late' ?
                                                'bg-warning-50 border-warning-500 text-warning-700' :
                                                (status === 'Absent' ?
                                                    'bg-error-50 border-error-500 text-error-700' :
                                                    '')))"
                                    x-text="holidays.includes(index + 1) ? 'Holiday' : status">
                                </td>
                            </template>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>



        <!-- Alpine.js -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}


    </div>

@endsection
