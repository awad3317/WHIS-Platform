@extends('layouts.app')

@section('title', __('إدارة الموظفين'))

@section('content')
<style>
    [x-cloak]{ display:none !important; }
</style>

<div
    x-data="employeeManager(@js($employees), '{{ app()->getLocale() }}')"
    x-cloak
    class="p-4 md:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen font-outfit"
    dir="rtl"
>
    <div class="max-w-[1400px] mx-auto space-y-6">

        <!-- Header -->
        <div class="bg-white dark:bg-gray-dark border border-gray-200 dark:border-gray-800 rounded-xl p-6 shadow-theme-sm transition-all">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-title-sm font-bold text-gray-900 dark:text-white leading-tight tracking-tight">
                        إدارة شؤون الموظفين
                    </h2>
                    <p class="text-theme-sm text-gray-500 mt-1">
                        إدارة الكادر التعليمي والإداري، مراقبة الحالات، والرواتب.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <!-- Search (واحد فقط) -->
                    <div class="relative w-full sm:w-80 group">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-brand-500 transition-colors">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20">
                                <path d="M19.125 17.2969L14.5625 12.7344C15.5312 11.3906 16.0938 9.76562 16.0938 8.03125C16.0938 3.59375 12.4688 0 8.03125 0C3.59375 0 0 3.59375 0 8.03125C0 12.4688 3.59375 16.0938 8.03125 16.0938C9.76562 16.0938 11.3906 15.5312 12.7344 14.5625L17.2969 19.125C17.5312 19.3594 17.8438 19.5 18.2188 19.5C18.5312 19.5 18.8438 19.375 19.125 19.125C19.625 18.625 19.625 17.7969 19.125 17.2969ZM1.875 8.03125C1.875 4.625 4.625 1.875 8.03125 1.875C11.4375 1.875 14.2188 4.625 14.2188 8.03125C14.2188 11.4375 11.4375 14.2188 8.03125 14.2188C4.625 14.2188 1.875 11.4375 1.875 8.03125Z"/>
                            </svg>
                        </span>

                        <input
                            type="text"
                            x-model.debounce.300ms="search"
                            placeholder="ابحث عن موظف..."
                            class="w-full rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 py-2.5 pr-11 pl-5 text-theme-sm font-medium outline-none transition focus:border-brand-500 focus:shadow-focus-ring dark:text-white placeholder:text-gray-400"
                        />
                    </div>

                    <a href="{{ route('employees.create') }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 py-2.5 px-6 text-theme-sm font-bold text-white hover:bg-brand-600 shadow-theme-xs transition-all active:scale-95">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>موظف جديد</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-dark p-5 rounded-xl border border-gray-200 dark:border-gray-800 flex items-center justify-between shadow-theme-xs">
                <div>
                    <p class="text-theme-xs text-gray-500 font-bold uppercase tracking-widest mb-1">إجمالي الكادر</p>
                    <p class="text-theme-xl font-bold text-gray-900 dark:text-white" x-text="filteredData.length"></p>
                </div>
                <div class="size-12 flex items-center justify-center bg-brand-50 dark:bg-brand-500/10 rounded-lg text-brand-500 shadow-sm">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <template x-for="emp in paginatedData" :key="emp.id">

                <div class="group bg-white dark:bg-gray-dark rounded-xl border border-gray-200 dark:border-gray-800 shadow-theme-sm hover:shadow-theme-md transition-all duration-300 overflow-hidden"
                     :class="openId === emp.id ? 'ring-1 ring-brand-500/30 border-brand-500' : ''">

                    <!-- Collapsed Header -->
                    <button type="button"
                            @click="toggle(emp.id)"
                            class="w-full p-6 flex items-start justify-between text-right">
                        <div class="flex items-center gap-4">
                            <div class="size-14 rounded-full overflow-hidden border-2 border-gray-100 dark:border-gray-700 shadow-theme-xs bg-gray-50 dark:bg-gray-800">
                                <img :src="avatar(emp)" class="size-full object-cover" :alt="emp.display_name">
                            </div>

                            <div class="space-y-1">
                                <h4 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-brand-500 transition-colors"
                                    x-text="emp.display_name"></h4>
                                <p class="text-theme-xs text-gray-500 font-medium" x-text="emp.email"></p>
                                <p class="text-[11px] text-gray-400 font-semibold"
                                   x-text="emp.job_title + (emp.department ? ' • ' + emp.department : '')"></p>
                            </div>
                        </div>

                        <div class="flex flex-col items-end gap-3">
                            <span :class="statusClass(emp)"
                                  class="px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                <span x-text="statusText(emp)"></span>
                            </span>

                            <div class="text-gray-400 group-hover:text-brand-500 transition-colors">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                     :class="openId === emp.id ? 'rotate-180' : ''"
                                     class="transition-transform duration-300">
                                    <path d="M6 9l6 6 6-6"/>
                                </svg>
                            </div>
                        </div>
                    </button>

                    <!-- Expanded Content (Accordion) -->
                    <template x-if="openId === emp.id">
                        <div
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1"
                            class="border-t border-gray-100 dark:border-gray-800"
                        >
                            <div class="p-6">
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">القسم</p>
                                        <p class="text-theme-sm font-bold text-gray-800 dark:text-gray-200" x-text="emp.department ?? '-'"></p>
                                    </div>

                                    <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">الراتب</p>
                                        <p class="text-theme-sm font-bold text-success-600 dark:text-success-500" x-text="formatSalary(emp.salary)"></p>
                                    </div>

                                    <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">المؤهل</p>
                                        <p class="text-theme-sm font-bold text-gray-800 dark:text-gray-200" x-text="emp.qualification ?? '-'"></p>
                                    </div>

                                    <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">سنة التخرج</p>
                                        <p class="text-theme-sm font-bold text-gray-800 dark:text-gray-200" x-text="emp.graduation_year ?? '-'"></p>
                                    </div>

                                    <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">الهاتف</p>
                                        <p class="text-theme-sm font-bold text-gray-800 dark:text-gray-200" x-text="emp.phone ?? '-'"></p>
                                    </div>

                                    <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">الحصص الأسبوعية</p>
                                        <p class="text-theme-sm font-bold text-gray-800 dark:text-gray-200" x-text="emp.weekly_classes ?? '-'"></p>
                                    </div>

                                    <div class="col-span-2 p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-2">المواد</p>
                                        <p class="text-theme-sm font-bold text-gray-800 dark:text-gray-200" x-text="subjectsText(emp.subjects)"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="px-6 py-4 bg-gray-50/50 dark:bg-white/[0.03] border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                                <div class="flex items-center gap-2 text-theme-xs text-gray-500 font-medium">
                                    <svg class="stroke-current" width="14" height="14" fill="none" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span x-text="emp.department ?? '—'"></span>
                                </div>

                                <div class="flex gap-2">
                                    <a :href="`/employees/${emp.id}/edit`"
                                       class="p-2 text-gray-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 rounded-lg transition-all shadow-theme-xs border border-transparent hover:border-brand-500/20">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    <button type="button"
                                            @click.stop="confirmDelete(emp.id)"
                                            class="p-2 text-gray-400 hover:text-error-600 hover:bg-error-50 dark:hover:bg-error-500/10 rounded-lg transition-all shadow-theme-xs border border-transparent hover:border-error-500/20">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                </div>
            </template>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between bg-white dark:bg-gray-dark p-6 rounded-xl border border-gray-200 dark:border-gray-800 shadow-theme-sm transition-all">
            <p class="text-theme-sm font-medium text-gray-500">
                عرض <span x-text="startEntry" class="text-brand-500 font-bold"></span> إلى
                <span x-text="endEntry" class="text-brand-500 font-bold"></span> من
                <span x-text="filteredData.length" class="font-bold text-gray-900 dark:text-white"></span> موظف
            </p>

            <div class="flex items-center gap-2 mt-4 sm:mt-0">
                <button @click="prevPage()" :disabled="currentPage === 1"
                        class="px-4 py-2 text-theme-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg disabled:opacity-30 hover:bg-brand-500 hover:text-white transition-all shadow-theme-xs">
                    السابق
                </button>

                <div class="flex gap-1.5">
                    <template x-for="page in totalPages" :key="page">
                        <button @click="goToPage(page)"
                                :class="currentPage === page ? 'bg-brand-500 text-white shadow-theme-xs border-brand-500' : 'bg-gray-100 dark:bg-gray-800 text-gray-500 border-transparent hover:border-gray-300'"
                                class="size-9 rounded-lg text-theme-xs font-bold transition-all border"
                                x-text="page"></button>
                    </template>
                </div>

                <button @click="nextPage()" :disabled="currentPage === totalPages"
                        class="px-4 py-2 text-theme-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg disabled:opacity-30 hover:bg-brand-500 hover:text-white transition-all shadow-theme-xs">
                    التالي
                </button>
            </div>
        </div>

    </div>
</div>

<script>
function employeeManager(employees, locale) {
    return {
        search: '',
        openId: null,
        currentPage: 1,
        perPage: 6,

        data: (employees || []).map(e => ({
            ...e,
            display_name: (locale === 'ar' ? (e.name_ar || e.name_en) : (e.name_en || e.name_ar)) || '—',
        })),

        toggle(id) {
            this.openId = (this.openId === id) ? null : id;
        },

        get filteredData() {
            const s = (this.search || '').toLowerCase().trim();
            if (!s) return this.data;

            return this.data.filter(e => {
                const hay = [e.display_name, e.email, e.job_title, e.department, e.phone]
                    .filter(Boolean).join(' ').toLowerCase();
                return hay.includes(s);
            });
        },

        get paginatedData() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredData.slice(start, start + this.perPage);
        },

        get totalPages() {
            return Math.max(1, Math.ceil(this.filteredData.length / this.perPage));
        },

        get startEntry() {
            return this.filteredData.length === 0 ? 0 : (this.currentPage - 1) * this.perPage + 1;
        },

        get endEntry() {
            return Math.min(this.currentPage * this.perPage, this.filteredData.length);
        },

        nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; this.openId = null; },
        prevPage() { if (this.currentPage > 1) this.currentPage--; this.openId = null; },
        goToPage(page) { this.currentPage = page; this.openId = null; },

        avatar(emp) {
            if (emp.image) return emp.image; // إذا storage: return `/storage/${emp.image}`;
            return `https://ui-avatars.com/api/?name=${encodeURIComponent(emp.display_name)}&background=random&bold=true&color=fff`;
        },

        statusText(emp) { return emp.is_active ? 'ACTIVE' : 'INACTIVE'; },
        statusClass(emp) {
            return emp.is_active
                ? 'bg-success-50 text-success-700 dark:bg-success-500/10 dark:text-success-400'
                : 'bg-error-50 text-error-700 dark:bg-error-500/10 dark:text-error-400';
        },

        formatSalary(val) {
            if (val === null || val === undefined || val === '') return '-';
            const n = Number(String(val).replace(/[^\d.]/g,''));
            if (!isNaN(n)) return new Intl.NumberFormat('ar-SA').format(n) + ' ريال';
            return String(val);
        },

        subjectsText(subjects) {
            if (!subjects) return '-';
            try {
                const arr = typeof subjects === 'string' ? JSON.parse(subjects) : subjects;
                if (Array.isArray(arr)) return arr.join('، ');
            } catch (e) {}
            return String(subjects);
        },

        confirmDelete(id) {
            if (confirm('هل أنت متأكد من حذف الموظف؟')) {
                console.log('delete', id);
            }
        }
    }
}
</script>
@endsection
