@extends('layouts.app')

@section('title', __('student.student_show'))
@section('Breadcrumb', __('student.student_show'))

@section('content')
{{-- ملاحظة: تم استبدال text-right بـ text-start ليدعم الاتجاهين --}}
<div class="space-y-6 max-w-[1200px] mx-auto text-start px-4 sm:px-0">
    
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-800 backdrop-blur-xl">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-5">
                <div class="relative h-28 w-28 flex-shrink-0 overflow-hidden rounded-2xl border-2 border-white dark:border-gray-700 shadow-xl">
                    <img src="{{ $student->photo_url ?? asset('tailadmin/src/images/user/user-01.jpg') }}" alt="student" class="h-full w-full object-cover">
                    @if($student->is_active)
                        <span class="absolute bottom-1 inset-inline-end-1 h-4 w-4 rounded-full border-2 border-white bg-success-500 dark:border-gray-700"></span>
                    @endif
                </div>
                
                <div class="space-y-1">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ app()->getLocale() == 'ar' ? $student->name_ar : $student->name_en }}
                    </h3>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 italic">
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
                   class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-700 shadow-sm transition-all hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                    <svg class="fill-current text-brand-500" width="18" height="18" viewBox="0 0 24 24">
                        <path d="M5 19h1.42l9.44-9.45-1.42-1.42L5 17.58V19zm16 2H3v-4.24L16.43 3.34a.996.996 0 0 1 1.41 0l2.82 2.82c.39.39.39 1.02 0 1.41L7.24 21H21v2z"/>
                    </svg>
                    <span class="dark:text-white">
                    {{ __('student.edit_data') }}
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div x-data="{ activeTab: 'personal' }" class="space-y-6">
        <div class="flex items-center p-1 bg-gray-100/50 dark:bg-gray-800 rounded-2xl w-fit backdrop-blur-sm shadow-inner overflow-x-auto">
            <button @click="activeTab = 'personal'" 
                :class="activeTab === 'personal' ? 'bg-white text-brand-500 shadow-md dark:bg-brand-500 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap">
                {{ __('student.personal_info') }}
            </button>
            <button @click="activeTab = 'parents'" 
                :class="activeTab === 'parents' ? 'bg-white text-brand-500 shadow-md dark:bg-brand-500 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap">
                {{ __('student.parents_info') }}
            </button>
            <button @click="activeTab = 'files'" 
                :class="activeTab === 'files' ? 'bg-white text-brand-500 shadow-md dark:bg-brand-500 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'"
                class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap">
                {{ __('student.student_files') }} <span class="ms-1 opacity-60">({{ $student->files->count() }})</span>
            </button>
        </div>

        <div x-show="activeTab === 'personal'" x-transition:enter="transition ease-out duration-300 translate-y-4" class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm dark:border-gray-800 dark:bg-gray-800">
                <h3 class="text-lg font-black text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <span class="h-5 border-s-4 border-brand-500 rounded-full"></span>
                    {{ __('student.basic_info') }}
                </h3>
                <div class="grid grid-cols-1 gap-y-5">
                    <div class="flex flex-col border-b border-gray-50 dark:border-gray-800 pb-2">
                        <span class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.full_name') }}</span> 
                        <span class="text-base font-semibold text-gray-800 dark:text-gray-400">
                            {{ app()->getLocale() == 'ar' ? $student->name_ar : $student->name_en }}
                        </span>
                    </div>
                    <div class="flex flex-col border-b border-gray-50 dark:border-gray-800 pb-2">
                        <span class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.date_of_birth') }}</span> 
                        <span class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->birth_date }}</span>            
                    </div>
                    <div class="flex flex-col border-b border-gray-50 dark:border-gray-800 pb-2">
                        <span class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.gender') }}</span> 
                        <span class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->gender }}</span>    
                    </div>
                </div>
            </div>
            
            <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm dark:border-gray-800 dark:bg-gray-800">
                <h3 class="text-lg font-black text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <span class="h-5 border-s-4 border-brand-500 rounded-full"></span>
                    {{ __('student.registration_info') }}
                </h3>
                <div class="grid grid-cols-1 gap-y-5">
                    <div class="flex flex-col border-b border-gray-50 dark:border-gray-800 pb-2">
                        <span class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.national_id') }}</span> 
                        <span class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->national_id }}</span>
                    </div>
                    <div class="flex flex-col border-b border-gray-50 dark:border-gray-800 pb-2">
                        <span class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.present_school') }}</span> 
                        <span class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->previous_school ?? '---' }}</span>  
                    </div>
                    <div class="flex flex-col border-b border-gray-50 dark:border-gray-800 pb-2">
                        <span class="text-[10px] font-black text-gray-400 dark:text-white uppercase tracking-widest">{{ __('student.enrollment_date') }}</span> 
                        <span class="text-base font-semibold text-gray-800 dark:text-gray-400">{{ $student->enrollment_date }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'parents'" x-transition class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            @forelse($student->parents as $parent)
                <div class="group rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-gray-800 dark:bg-gray-800 flex items-start gap-5">
                    <div class="h-14 w-14 rounded-2xl bg-brand-50 flex items-center justify-center text-2xl dark:bg-brand-500/10">
                        {{ $parent->pivot->relationship == 'father' ? '👨‍💼' : '👩‍💼' }}
                    </div>
                    <div class="flex-1 space-y-3">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-gray-900 dark:text-white">{{ app()->getLocale() == 'ar' ? $parent->name_ar : $parent->name_en }}</h4>
                            <span class="text-[10px] font-black uppercase bg-brand-50 text-brand-700 px-2.5 py-1 rounded-lg dark:bg-brand-500/20 dark:text-brand-400">
                                {{ __('student.'.$parent->pivot->relationship) }}
                            </span>
                        </div>
                        <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400 font-medium">
                            <p class="flex items-center gap-2 tracking-wide"><i class="far fa-phone"></i> {{ $parent->phone }}</p>
                            <p class="flex items-center gap-2 tracking-wide"><i class="far fa-envelope"></i> {{ $parent->email ?? '---' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full p-20 bg-gray-50/50 dark:bg-gray-800/20 rounded-[2.5rem] border-2 border-dashed border-gray-200 dark:border-gray-800 text-center text-gray-400 italic">
                    {{ __('student.no_data') }}
                </div>
            @endforelse
        </div>

        <div x-show="activeTab === 'files'" x-transition class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($student->files as $file)
                <div class="group rounded-3xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:border-brand-400 dark:border-gray-800 dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 flex-shrink-0 rounded-2xl bg-gray-50 flex items-center justify-center dark:bg-gray-700 group-hover:bg-brand-500 group-hover:text-white transition-all shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 dark:text-white truncate" title="{{ basename($file->file_path) }}">
                                {{ basename($file->file_path) }}
                            </p>
                            <div class="flex gap-4 mt-2">
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="text-[10px] font-black uppercase text-brand-500 dark:text-brand-400">{{ __('student.open') }}</a>
                                <a href="{{ asset('storage/' . $file->file_path) }}" download class="text-[10px] font-black uppercase text-success-500 dark:text-success-400">{{ __('student.download') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-gray-400 font-bold italic border-2 border-dashed border-gray-200 dark:border-gray-800 rounded-[2.5rem] uppercase tracking-widest">
                    {{ __('student.no_attachments') }}
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection