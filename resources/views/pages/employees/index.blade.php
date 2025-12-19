@extends('layouts.app')

@section('title', __('إدارة الموظفين'))

@section('content')
<div x-data="employeeManager()" class="p-4 md:p-6 lg:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen font-outfit" dir="rtl">
    <div class="max-w-[1400px] mx-auto space-y-6">

        <div class="bg-white dark:bg-gray-dark border border-gray-200 dark:border-gray-800 rounded-xl p-6 shadow-theme-sm transition-all">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-title-sm font-bold text-gray-900 dark:text-white leading-tight tracking-tight">إدارة شؤون الموظفين</h2>
                    <p class="text-theme-sm text-gray-500 mt-1">إدارة الكادر التعليمي والإداري، مراقبة الحالات، والرواتب.</p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative w-full sm:w-80 group">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-brand-500 transition-colors">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20">
                                <path d="M19.125 17.2969L14.5625 12.7344C15.5312 11.3906 16.0938 9.76562 16.0938 8.03125C16.0938 3.59375 12.4688 0 8.03125 0C3.59375 0 0 3.59375 0 8.03125C0 12.4688 3.59375 16.0938 8.03125 16.0938C9.76562 16.0938 11.3906 15.5312 12.7344 14.5625L17.2969 19.125C17.5312 19.3594 17.8438 19.5 18.2188 19.5C18.5312 19.5 18.8438 19.375 19.125 19.125C19.625 18.625 19.625 17.7969 19.125 17.2969ZM1.875 8.03125C1.875 4.625 4.625 1.875 8.03125 1.875C11.4375 1.875 14.2188 4.625 14.2188 8.03125C14.2188 11.4375 11.4375 14.2188 8.03125 14.2188C4.625 14.2188 1.875 11.4375 1.875 8.03125Z" />
                            </svg>
                        </span>
                        <input type="text" x-model="search" placeholder="ابحث عن موظف..."
                            class="w-full rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 py-2.5 pr-11 pl-5 text-theme-sm font-medium outline-none transition focus:border-brand-500 focus:shadow-focus-ring dark:text-white placeholder:text-gray-400" />
                    </div>

                    <a href="{{ route('employees.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 py-2.5 px-6 text-theme-sm font-bold text-white hover:bg-brand-600 shadow-theme-xs transition-all active:scale-95">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>موظف جديد</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-dark p-5 rounded-xl border border-gray-200 dark:border-gray-800 flex items-center justify-between shadow-theme-xs">
                <div>
                    <p class="text-theme-xs text-gray-500 font-bold uppercase tracking-widest mb-1">إجمالي الكادر</p>
                    <p class="text-theme-xl font-bold text-gray-900 dark:text-white" x-text="totalEntries"></p>
                </div>
                <div class="size-12 flex items-center justify-center bg-brand-50 dark:bg-brand-500/10 rounded-lg text-brand-500 shadow-sm">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <template x-for="person in paginatedData" :key="person.id">
                <div class="group bg-white dark:bg-gray-dark rounded-xl border border-gray-200 dark:border-gray-800 p-0 shadow-theme-sm hover:shadow-theme-md hover:border-brand-500 transition-all duration-300 flex flex-col overflow-hidden">
                    
                    <div class="p-6 flex-1">
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="size-14 rounded-full overflow-hidden border-2 border-gray-100 dark:border-gray-700 shadow-theme-xs">
                                    <img :src="'https://ui-avatars.com/api/?name=' + person.name + '&background=random&bold=true&color=fff'" class="size-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-brand-500 transition-colors" x-text="person.name"></h4>
                                    <p class="text-theme-xs text-gray-500 font-medium" x-text="person.email"></p>
                                </div>
                            </div>
                            <span :class="{
                                'bg-success-50 text-success-700 dark:bg-success-500/10 dark:text-success-400': person.status === 'Hierror',
                                'bg-warning-50 text-warning-700 dark:bg-warning-500/10 dark:text-warning-400': person.status === 'Pending',
                                'bg-brand-50 text-brand-700 dark:bg-brand-500/10 dark:text-brand-400': person.status === 'In Progress'
                            }" class="px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider shadow-sm" x-text="person.status"></span>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">الوظيفة</p>
                                <p class="text-theme-sm font-bold text-gray-800 dark:text-gray-200" x-text="person.position"></p>
                            </div>
                            <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">الراتب المتوقع</p>
                                <p class="text-theme-sm font-bold text-success-600 dark:text-success-500" x-text="person.salary"></p>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50/50 dark:bg-white/[0.03] border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-theme-xs text-gray-500 font-medium">
                            <svg class="stroke-current" width="14" height="14" fill="none" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span x-text="person.office"></span>
                        </div>
                        <div class="flex gap-2">
                            <button class="p-2 text-gray-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 rounded-lg transition-all shadow-theme-xs border border-transparent hover:border-brand-500/20">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-error-600 hover:bg-error-50 dark:hover:bg-error-500/10 rounded-lg transition-all shadow-theme-xs border border-transparent hover:border-error-500/20">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between bg-white dark:bg-gray-dark p-6 rounded-xl border border-gray-200 dark:border-gray-800 shadow-theme-sm transition-all">
            <p class="text-theme-sm font-medium text-gray-500">
                عرض <span x-text="startEntry" class="text-brand-500 font-bold"></span> إلى <span x-text="endEntry" class="text-brand-500 font-bold"></span> من <span x-text="totalEntries" class="font-bold text-gray-900 dark:text-white"></span> موظف
            </p>
            <div class="flex items-center gap-2 mt-4 sm:mt-0">
                <button @click="prevPage()" :disabled="currentPage === 1" 
                    class="px-4 py-2 text-theme-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg disabled:opacity-30 hover:bg-brand-500 hover:text-white transition-all shadow-theme-xs">السابق</button>
                <div class="flex gap-1.5">
                    <template x-for="page in totalPages" :key="page">
                        <button @click="goToPage(page)" 
                            :class="currentPage === page ? 'bg-brand-500 text-white shadow-theme-xs border-brand-500' : 'bg-gray-100 dark:bg-gray-800 text-gray-500 border-transparent hover:border-gray-300'"
                            class="size-9 rounded-lg text-theme-xs font-bold transition-all border" x-text="page"></button>
                    </template>
                </div>
                <button @click="nextPage()" :disabled="currentPage === totalPages" 
                    class="px-4 py-2 text-theme-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg disabled:opacity-30 hover:bg-brand-500 hover:text-white transition-all shadow-theme-xs">التالي</button>
            </div>
        </div>
    </div>
</div>

<script>
    function employeeManager() {
        return {
            search: '',
            currentPage: 1,
            perPage: 6,
            data: [
                { id: 1, name: "أحمد العتيبي", email: "ahmed@school.com", position: "مدير قسم التقنية", office: "مبنى A", status: "Hierror", salary: "12,000 ريال" },
                { id: 2, name: "سارة القحطاني", email: "sara@school.com", position: "أخصائية اجتماعية", office: "مبنى C", status: "In Progress", salary: "9,500 ريال" },
                { id: 3, name: "محمد العمري", email: "mohammed@school.com", position: "معلم فيزياء", office: "مختبر 2", status: "Hierror", salary: "10,200 ريال" },
                { id: 4, name: "خالد الشهري", email: "khaled@school.com", position: "محاسب مالي", office: "الإدارة", status: "Pending", salary: "8,900 ريال" },
                { id: 5, name: "ليلى الحربي", email: "laila@school.com", position: "مدربة لغات", office: "مبنى B", status: "Hierror", salary: "11,000 ريال" },
                { id: 6, name: "فهد الدوسري", email: "fahad@school.com", position: "أمن وسلامة", office: "البوابة", status: "In Progress", salary: "7,500 ريال" },
            ],
            get filteredData() {
                const s = this.search.toLowerCase();
                return this.data.filter(p => 
                    p.name.toLowerCase().includes(s) || 
                    p.position.toLowerCase().includes(s) || 
                    p.email.toLowerCase().includes(s)
                );
            },
            get paginatedData() {
                const start = (this.currentPage - 1) * this.perPage;
                return this.filteredData.slice(start, start + this.perPage);
            },
            get totalEntries() { return this.filteredData.length; },
            get totalPages() { return Math.max(1, Math.ceil(this.totalEntries / this.perPage)); },
            get startEntry() { return this.totalEntries === 0 ? 0 : (this.currentPage - 1) * this.perPage + 1; },
            get endEntry() { return Math.min(this.currentPage * this.perPage, this.totalEntries); },
            nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
            prevPage() { if (this.currentPage > 1) this.currentPage--; },
            goToPage(page) { this.currentPage = page; }
        }
    }
</script>
@endsection