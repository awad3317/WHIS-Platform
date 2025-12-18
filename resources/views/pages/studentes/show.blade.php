@extends('layouts.app')

@section('title', __('student.student_show'))
@section('Breadcrumb', __('student.student_show'))

@section('content')
<div class="space-y-6 max-w-[1200px] mx-auto text-right px-4 sm:px-0" dir="rtl">
    
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900/50 backdrop-blur-xl">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-5">
                <div class="relative h-28 w-28 flex-shrink-0 overflow-hidden rounded-2xl border-2 border-white dark:border-gray-800 shadow-xl">
                    <img src="{{ $student->photo_url ?? asset('tailadmin/src/images/user/user-01.jpg') }}" alt="student" class="h-full w-full object-cover">
                    @if($student->is_active)
                        <span class="absolute bottom-1 right-1 h-4 w-4 rounded-full border-2 border-white bg-success-500 dark:border-gray-800"></span>
                    @endif
                </div>
                
                <div class="space-y-1">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $student->name_ar }}
                    </h3>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('student.academic_no') }}: <span class="text-brand-500 dark:text-brand-400 font-bold">#{{ $student->academic_no }}</span>
                    </p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span @class([
                            'inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold tracking-wide transition-colors',
                            'bg-success-100 text-success-700 dark:bg-success-500/10 dark:text-success-400' => $student->is_active,
                            'bg-red-100 text-red-700 dark:bg-red-500/10 dark:text-red-400' => !$student->is_active,
                        ])>
                            {{ $student->is_active ? __('student.active') : __('student.inactive') }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-brand-50 text-brand-700 dark:bg-brand-500/10 dark:text-brand-400">
                             {{ $student->nationality }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('students.edit', $student->id) }}" 
                   class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-700 shadow-sm transition-all hover:bg-gray-50 hover:shadow-md dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-white/[0.05]">
                    <svg class="fill-current text-brand-500" width="18" height="18" viewBox="0 0 24 24">
                        <path d="M5 19h1.42l9.44-9.45-1.42-1.42L5 17.58V19zm16 2H3v-4.24L16.43 3.34a.996.996 0 0 1 1.41 0l2.82 2.82c.39.39.39 1.02 0 1.41L7.24 21H21v2z"/>
                    </svg>
                    {{ __('student.edit_data') }}
                </a>
            </div>
        </div>
    </div>

    <div x-data="{ activeTab: 'personal' }" class="space-y-6">
        
        <div class="flex items-center p-1.5 bg-gray-100/50 dark:bg-gray-800/50 rounded-2xl w-fit backdrop-blur-sm shadow-inner">
            <button @click="activeTab = 'personal'" 
                :class="activeTab === 'personal' ? 'bg-brand-500  text-white shadow-md dark:bg-gray-700 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
                {{ __('student.personal_info') }}
            </button>
            <button @click="activeTab = 'parents'" 
                :class="activeTab === 'parents' ? 'bg-brand-500 text-white shadow-md dark:bg-gray-700 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
                {{ __('student.parents_info') }}
            </button>
            <button @click="activeTab = 'files'" 
                :class="activeTab === 'files' ? 'bg-brand-500 text-white shadow-md dark:bg-gray-700 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300">
                {{ __('student.student_files') }} <span class="ml-1 opacity-60">({{ $student->files->count() }})</span>
            </button>
        </div>

        <div x-show="activeTab === 'personal'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm dark:border-gray-800 dark:bg-gray-900/40">
                <h3 class="text-lg font-black text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <span class="h-4 w-1 bg-brand-500 rounded-full"></span>
                    {{ __('student.basic_info') }}
                </h3>
                <div class="grid grid-cols-1 gap-y-5">
                    <div class="flex flex-col"><span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ __('student.full_name') }}</span> <span class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $student->name_en }}</span></div>
                    <div class="flex flex-col"><span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ __('student.date_of_birth') }}</span> <span class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $student->birth_date }}</span></div>
                    <div class="flex flex-col"><span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ __('student.gender') }}</span> <span class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $student->gender }}</span></div>
                    <div class="flex flex-col"><span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ __('student.nationality') }}</span> <span class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $student->nationality }}</span></div>
                </div>
            </div>
            
            <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm dark:border-gray-800 dark:bg-gray-900/40">
                <h3 class="text-lg font-black text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <span class="h-4 w-1 bg-brand-500 rounded-full"></span>
                    {{ __('student.registration_info') }}
                </h3>
                <div class="grid grid-cols-1 gap-y-5">
                    <div class="flex flex-col"><span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ __('student.national_id') }}</span> <span class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $student->national_id }}</span></div>
                    <div class="flex flex-col"><span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ __('student.present_school') }}</span> <span class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $student->previous_school ?? '---' }}</span></div>
                    <div class="flex flex-col"><span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ __('student.enrollment_date') }}</span> <span class="text-base font-semibold text-gray-800 dark:text-gray-200">{{ $student->enrollment_date }}</span></div>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'parents'" x-transition class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            @forelse($student->parents as $parent)
                <div class="group rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-gray-800 dark:bg-gray-900/40 flex items-start gap-5">
                    <div class="h-14 w-14 rounded-2xl bg-brand-50 flex items-center justify-center text-2xl dark:bg-brand-500/10 transition-transform group-hover:scale-110">
                        {{ $parent->pivot->relationship == 'father' ? '👨‍💼' : '👩‍💼' }}
                    </div>
                    <div class="flex-1 space-y-3">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-gray-900 dark:text-white">{{ $parent->name_ar }}</h4>
                            <span class="text-[10px] font-black uppercase tracking-tighter bg-brand-100 text-brand-700 px-2.5 py-1 rounded-lg dark:bg-brand-500/20 dark:text-brand-400">
                                {{ trans('student.'.$parent->pivot->relationship) }}
                            </span>
                        </div>
                        <div class="grid grid-cols-1 gap-1 text-sm text-gray-500 dark:text-gray-400 font-medium font-mono">
                            <p class="flex items-center gap-2"><svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg> {{ $parent->phone }}</p>
                            <p class="flex items-center gap-2"><svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> {{ $parent->email ?? '---' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full p-20 bg-gray-50/50 dark:bg-gray-800/20 rounded-[2.5rem] border-2 border-dashed border-gray-200 dark:border-gray-800 text-center">
                    <p class="text-gray-400 font-bold italic tracking-wide uppercase">{{ __('student.no_data') }}</p>
                </div>
            @endforelse
        </div>

        <div x-show="activeTab === 'files'" x-transition class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($student->files as $file)
                <div class="group rounded-3xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:border-brand-400 dark:border-gray-800 dark:bg-gray-900/40">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 flex-shrink-0 rounded-2xl bg-gray-50 flex items-center justify-center dark:bg-gray-800 group-hover:bg-brand-500 group-hover:text-white transition-all shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 dark:text-white truncate" title="{{ basename($file->file_path) }}">
                                {{ basename($file->file_path) }}
                            </p>
                            <div class="flex gap-4 mt-2">
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="text-[10px] font-black uppercase text-brand-500 hover:text-brand-500 dark:text-brand-400">{{ __('student.open') }}</a>
                                <a href="{{ asset('storage/' . $file->file_path) }}" download class="text-[10px] font-black uppercase text-success-500 hover:text-success-500 dark:text-success-400">{{ __('student.download') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-gray-400 font-bold italic border-2 border-dashed border-gray-100 dark:border-gray-800 rounded-[2.5rem] uppercase tracking-widest">
                    {{ __('student.no_attachments') }}
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection