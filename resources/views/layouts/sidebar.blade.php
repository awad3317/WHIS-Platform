<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : 'translate-x-full'"
    class="sidebar fixed right-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-l border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7">
        <a href="index.html">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="dark:hidden" src="{{ asset('tailadmin/src/images/WHIS2.png') }}" alt="Logo" />
                <img class="hidden dark:block" src="{{ asset('tailadmin/src/images/logodark2.png') }}" alt="Logo" />
            </span>

            <img class="logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ asset('tailadmin/src/images/Logo.png') }}" alt="Logo" />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <!-- Sidebar Menu -->
        <nav x-data="{ selected: $persist('Dashboard') }">
            <!-- Menu Group -->
            <div>
                {{-- <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        MENU
                    </span>

                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3> --}}

                <ul class="mb-6 flex flex-col gap-4">
                    <!-- Menu Item Dashboard -->

                    <!-- Menu Item Dashboard -->


                    <!-- Menu Item Dashboard -->
                    <li>
                        <a href="{{ route('dashboard.index') }}" class="menu-item group" :class="window.location.href.includes('{{ route('dashboard.index') }}') ? 'menu-item-active' :
                                'menu-item-inactive'">

                            <svg :class="window.location.href.includes('{{ route('dashboard.index') }}') ? 'menu-item-icon-active' :
                                'menu-item-icon-inactive'" width="30" height="30" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rul="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                    fill="" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                {{ trans('sidebar.Dashboard') }}
                            </span>
                            <div class="flex justify-end items-center">
                                <svg class="menu-item-arrow" :class="[(selected === 'Dashboard') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive',
                                        sidebarToggle ? 'lg:hidden' : ''
                                    ]" width="20" height="20" viewBox="20 20 0 0" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </a>
                    </li>
                    <!-- Menu Item students -->
                    @if (Auth::user()->hasPermission('view_students'))
                        <li>
                            <a href="{{ route('students.index') }}" class="menu-item group" :class="window.location.href.includes('{{ route('students.index') }}') ? 'menu-item-active' :
                                    'menu-item-inactive'">
                                <svg :class="window.location.href.includes('{{ route('students.index') }}') ? 'menu-item-icon-active' :
                                    'menu-item-icon-inactive'" width="30" height="30" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 343.501 343.501" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M64.552,332.042c-4.418,0-8-3.582-8-8v-29.46H44.534c-4.418,0-8-3.582-8-8s3.582-8,8-8h19.842 c0.117-0.002,0.235-0.002,0.353,0h261.189c4.418,0,8,3.582,8,8s-3.582,8-8,8H72.552v29.46 C72.552,328.46,68.971,332.042,64.552,332.042z M7.999,294.587c-1.001,0-2.02-0.189-3.005-0.589 c-4.094-1.661-6.066-6.327-4.405-10.421l21.742-53.585c9.604-23.664,26.819-55.124,65.279-55.124h28.838 c20.719,0,37.778,9.221,50.701,27.406c0.344,0.465,3.79,4.936,6.83,8.881c2.19,2.843,4.543,5.895,6.5,8.44 c2.693,3.503,2.036,8.525-1.467,11.219c-3.503,2.694-8.525,2.036-11.218-1.467c-1.954-2.541-4.302-5.589-6.489-8.427 c-5.854-7.598-6.933-9.003-7.213-9.399c-6.237-8.777-13.234-14.635-21.414-17.804l-24.187,33.144 c-1.506,2.063-3.908,3.284-6.462,3.284s-4.956-1.221-6.462-3.284l-24.187-33.144c-14.029,5.446-24.739,18.92-34.224,42.291 l-21.741,53.584C14.154,292.702,11.16,294.587,7.999,294.587z M89.109,190.869l12.921,17.706l12.921-17.706H89.109z M225.597,263.385h-87.934c-4.418,0-8-3.582-8-8s3.582-8,8-8h87.934c4.418,0,8,3.582,8,8S230.016,263.385,225.597,263.385z M335.502,196.862c-3.161,0-6.155-1.885-7.416-4.994l-17.976-44.304c-7.448-18.352-15.785-29.147-26.546-33.775l-19.345,26.509 c-1.506,2.063-3.907,3.284-6.462,3.284c-2.555,0-4.956-1.221-6.462-3.284l-19.353-26.518c-6.102,2.61-11.376,7.17-16.115,13.838 c-0.486,0.683-13.385,17.904-17.485,23.241c-2.692,3.504-7.714,4.161-11.218,1.47c-3.503-2.692-4.161-7.715-1.469-11.218 c4.09-5.323,16.519-21.926,17.173-22.82c10.917-15.363,25.4-23.184,43.006-23.184h23.844c32.636,0,47.167,26.504,55.259,46.44 l17.976,44.305c1.661,4.094-0.311,8.76-4.405,10.421C337.522,196.672,336.503,196.862,335.502,196.862z M249.799,111.107 l7.958,10.903l7.957-10.903H249.799z M297.508,180.639H177.147c-4.418,0-8-3.582-8-8s3.582-8,8-8h120.361c4.418,0,8,3.582,8,8 S301.926,180.639,297.508,180.639z M102.03,160.667c-23.977,0-43.483-19.507-43.483-43.484c0-19.743,13.228-36.456,31.285-41.742 c0.093-0.03,0.188-0.059,0.283-0.086c2.178-0.619,4.402-1.066,6.651-1.338c1.402-0.17,2.827-0.273,4.267-0.306 c0.017-0.011,0.03-0.001,0.046-0.002c0.015-0.001,0.031,0,0.045-0.001c0.013,0,0.027,0,0.04,0c0.011-0.001,0.021-0.001,0.035-0.001 c0.256-0.005,0.518-0.012,0.769-0.008c0.016-0.001,0.034-0.001,0.054,0c0.004,0,0.009,0,0.009,0c0.011,0,0.019-0.001,0.031,0 c0.022,0,0.043,0,0.065,0h0c0.012,0,0.024,0.001,0.034,0c0.011,0,0.022,0,0.034,0c0.012,0,0.027,0,0.036,0 c0.012,0,0.026,0.001,0.038,0.001c0.013,0,0.027,0,0.04,0c0.001,0,0.004,0,0.005,0c22.137,0.14,40.463,16.636,42.925,38.576 c0.182,1.61,0.275,3.248,0.275,4.906C145.512,141.161,126.006,160.667,102.03,160.667z M86.71,94.375 c-7.333,4.941-12.164,13.32-12.164,22.808c0,15.155,12.329,27.484,27.483,27.484c13.166,0,24.198-9.305,26.867-21.685 c-0.429,0.013-0.859,0.019-1.289,0.019C108.849,123.001,92.781,111.254,86.71,94.375z M102.053,89.7 c4.037,10.228,13.96,17.281,25.504,17.302c-4.022-10.049-13.814-17.189-25.256-17.301c-0.013,0-0.027,0-0.04,0 c-0.012,0.001-0.025,0.001-0.039,0c-0.012-0.001-0.026-0.002-0.04-0.001c-0.013,0-0.026,0-0.039,0c-0.014,0-0.027,0-0.04,0 C102.087,89.699,102.071,89.699,102.053,89.7z M257.757,86.136c-20.588,0-37.338-16.75-37.338-37.338 c0-20.589,16.75-37.34,37.338-37.34c20.589,0,37.339,16.751,37.339,37.34C295.096,69.386,278.345,86.136,257.757,86.136z M257.757,27.458c-11.766,0-21.338,9.573-21.338,21.34c0,11.766,9.572,21.338,21.338,21.338c11.767,0,21.339-9.572,21.339-21.338 C279.096,37.032,269.523,27.458,257.757,27.458z">
                                        </path>
                                    </g>
                                </svg>

                                <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                    {{ trans('sidebar.Students') }}
                                </span>
                                <div class="flex justify-end items-center">
                                    <svg class="menu-item-arrow" :class="[(selected === 'Dashboard') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive',
                                            sidebarToggle ? 'lg:hidden' : ''
                                        ]" width="20" height="20" viewBox="20 20 0 0" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                        </li>
                    @endif




                    <li>
                        <a href="#"
                            @click.prevent="selected = (selected === 'RegisterEmployee' ? '':'RegisterEmployee')"
                            class="menu-item group" :class="(selected === 'RegisterEmployee') || (page === 'formElements' ||
                                page === 'formLayout' ||
                                page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' :
                            'menu-item-inactive'">
                            <svg :class="(selected === 'RegisterEmployee') || (page === 'formElements' ||
                                page === 'formLayout' ||
                                page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active' :
                            'menu-item-icon-inactive'" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5001C19.7427 20.75 20.7501 19.7426 20.7501 18.5V5.5C20.7501 4.25736 19.7427 3.25 18.5001 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5001C18.9143 4.75 19.2501 5.08579 19.2501 5.5V18.5C19.2501 18.9142 18.9143 19.25 18.5001 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V5.5ZM6.25005 9.7143C6.25005 9.30008 6.58583 8.9643 7.00005 8.9643L17 8.96429C17.4143 8.96429 17.75 9.30008 17.75 9.71429C17.75 10.1285 17.4143 10.4643 17 10.4643L7.00005 10.4643C6.58583 10.4643 6.25005 10.1285 6.25005 9.7143ZM6.25005 14.2857C6.25005 13.8715 6.58583 13.5357 7.00005 13.5357H17C17.4143 13.5357 17.75 13.8715 17.75 14.2857C17.75 14.6999 17.4143 15.0357 17 15.0357H7.00005C6.58583 15.0357 6.25005 14.6999 6.25005 14.2857Z"
                                    fill="" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                {{ trans('sidebar.Employee') }}
                            </span>
                            <div class="flex justify-end">

                                <div class="app()->getLocale() == 'ar' ? 'absolute right-0' : 'absolute left-0'">
                                    <svg class=" absolute  top-1/2 -translate-y-1/2 stroke-current" :class="[(selected === 'RegisterEmployee') ? 'menu-item-arrow-active' :
                                            'menu-item-arrow-inactive',
                                            sidebarToggle ? 'lg:hidden' : ''
                                        ]" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>

                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'RegisterEmployee') ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="{{ route('employees.index') }}" class="menu-dropdown-item group" :class="page === 'formElements' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        {{ trans('sidebar.List') }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'RegisterEmployee') ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="{{ route('employees.create') }}" class="menu-dropdown-item group" :class="page === 'formElements' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        {{ trans('sidebar.Register') }}
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <!-- Dropdown Menu End -->
                    </li>
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Attendance' ? '':'Attendance')"
                            class="menu-item group" :class="(selected === 'Attendance') || (page === 'formElements' ||
                                page === 'formLayout' ||
                                page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' :
                            'menu-item-inactive'">
                            <svg :class="(selected === 'Attendance') || (page === 'formElements' ||
                                page === 'formLayout' ||
                                page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active' :
                            'menu-item-icon-inactive'" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5001C19.7427 20.75 20.7501 19.7426 20.7501 18.5V5.5C20.7501 4.25736 19.7427 3.25 18.5001 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5001C18.9143 4.75 19.2501 5.08579 19.2501 5.5V18.5C19.2501 18.9142 18.9143 19.25 18.5001 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V5.5ZM6.25005 9.7143C6.25005 9.30008 6.58583 8.9643 7.00005 8.9643L17 8.96429C17.4143 8.96429 17.75 9.30008 17.75 9.71429C17.75 10.1285 17.4143 10.4643 17 10.4643L7.00005 10.4643C6.58583 10.4643 6.25005 10.1285 6.25005 9.7143ZM6.25005 14.2857C6.25005 13.8715 6.58583 13.5357 7.00005 13.5357H17C17.4143 13.5357 17.75 13.8715 17.75 14.2857C17.75 14.6999 17.4143 15.0357 17 15.0357H7.00005C6.58583 15.0357 6.25005 14.6999 6.25005 14.2857Z"
                                    fill="" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                {{ trans('sidebar.Attendance') }}
                            </span>
                            <div class="flex justify-end">
                                <div class="app()->getLocale() == 'ar' ? 'absolute right-0' : 'absolute left-5'">
                                    <svg class=" absolute  top-1/2 -translate-y-1/2 stroke-current" :class="[(selected === 'Attendance') ? 'menu-item-arrow-active' :
                                            'menu-item-arrow-inactive',
                                            sidebarToggle ? 'lg:hidden' : ''
                                        ]" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Attendance') ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="{{ route('Attendance.index') }}" class="menu-dropdown-item group" :class="page === 'formElements' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        {{ trans('sidebar.Students') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Attendance') ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="{{ route('Attendance.index') }}" class="menu-dropdown-item group" :class="page === 'formElements' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        {{ trans('sidebar.Employee') }}
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <!-- Dropdown Menu End -->
                    </li>


                </ul>
            </div>


        </nav>

    </div>
</aside>