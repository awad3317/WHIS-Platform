@extends('layouts.app')

@section('title')
    {{ __('Register Employee') }}
@endsection

@section('content')
    <div class="space-y-5 sm:space-y-6">
        <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

            <!-- DataTable Three -->
            <div x-data="dataTableThree()"
                class="overflow-hidden rounded-xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

                <!-- TOP BAR -->
                <div class="mb-4 flex flex-col gap-2 px-4 sm:flex-row sm:items-center sm:justify-between">

                    <!-- Show entries -->
                    <div class="flex items-center gap-3">
                        <span class="text-gray-500 dark:text-gray-400">Show</span>

                        <div class="relative z-20 bg-transparent">
                            <select
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-9 w-full appearance-none rounded-lg border border-gray-300 bg-transparent py-2 pr-8 pl-3 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                @change="perPage = parseInt($event.target.value); currentPage = 1">
                                <option value="10">10</option>
                                <option value="8">8</option>
                                <option value="5">5</option>
                            </select>

                            <span class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M3.8335 5.9165L8.00016 10.0832L12.1668 5.9165" stroke=""
                                        stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>

                        <span class="text-gray-500 dark:text-gray-400">entries</span>
                    </div>

                    <!-- Search + Download -->
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                        <div class="relative">
                            <input type="text" placeholder="Search..." x-model="search"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-4 text-sm text-gray-800 focus:ring-3 focus:outline-hidden xl:w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        </div>

                        <button
                            class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 sm:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                            Download
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20">
                                <path d="M10 13L5 8h3V2h4v6h3L10 13z" />
                            </svg>
                        </button>

                    </div>

                </div>

                <!-- TABLE -->
                <div class="max-w-full overflow-x-auto">
                    <div class="min-w-\[1000px\]">

                        <!-- HEADER -->
                        <div class="grid grid-cols-12 border-t border-gray-200 dark:border-gray-800">

                            <div class="col-span-2  border-r px-4 py-3 cursor-pointer" @click="sortBy('name')">
                                <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">User</p>
                            </div>

                            <div class="col-span-2 border-r px-4 py-3 cursor-pointer" @click="sortBy('position')">
                                <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">Position</p>
                            </div>

                            <div class="col-span-2 border-r px-4 py-3 cursor-pointer" @click="sortBy('salary')">
                                <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">Salary</p>
                            </div>

                            <div class="col-span-2 border-r px-4 py-3 cursor-pointer" @click="sortBy('office')">
                                <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">Office</p>
                            </div>

                            <div class="col-span-4 border-r px-4 py-3 cursor-pointer" @click="sortBy('status')">
                                <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">Status</p>
                            </div>

                            <div class="col-span-4 px-4 py-3">
                                <p class="text-theme-xs font-medium text-gray-700 dark:text-gray-400">Action</p>
                            </div>

                        </div>

                        <!-- BODY -->
                        <template x-for="person in paginatedData" :key="person.id">
                            <div class="grid grid-cols-12 border-t border-gray-100 dark:border-gray-800">

                                <!-- User -->
                                <div class="col-span-2 flex items-center gap-3 border-r px-4 py-3">
                                    <div>
                                        <p class="text-theme-sm block font-medium text-gray-800 dark:text-white/90"
                                            x-text="person.name"></p>
                                        <span class="text-sm text-gray-500 dark:text-gray-400" x-text="person.email"></span>
                                    </div>
                                </div>

                                <!-- Position -->
                                <div class="col-span-2 flex items-center border-r px-4 py-3 text-gray-700 dark:text-gray-400"
                                    x-text="person.position"></div>

                                <!-- Salary -->
                                <div class="col-span-2 flex items-center border-r px-4 py-3 text-gray-700 dark:text-gray-400"
                                    x-text="person.salary"></div>

                                <!-- Office -->
                                <div class="col-span-2 flex items-center border-r px-4 py-3 text-gray-700 dark:text-gray-400"
                                    x-text="person.office"></div>

                                <!-- Status -->
                                <div class="col-span-4 flex items-center border-r px-4 py-3">
                                    <span class="text-theme-xs rounded-full px-2 py-0.5 font-medium"
                                        :class="{
                                            'bg-success-50 dark:bg-success-500/15 text-success-700 dark:text-success-500': person
                                                .status === 'Hired',
                                            'bg-warning-50 dark:bg-warning-500/15 text-warning-700 dark:text-orange-400': person
                                                .status === 'In Progress',
                                            'bg-error-50 dark:bg-error-500/15 text-error-700 dark:text-error-500': person
                                                .status === 'Pending'
                                        }"
                                        x-text="person.status"></span>
                                </div>

                                <!-- Action -->
                                <div class="col-span-4 flex items-center gap-2 px-4 py-3">
                                    <button class="text-gray-500 hover:text-error-500">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20">
                                            <path d="M5 6h10l-1 12H6L5 6zm2-3h6l1 2H6l1-2z" />
                                        </svg>
                                    </button>

                                    <button class="text-gray-500 hover:text-gray-800 dark:hover:text-white/90">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20">
                                            <path d="M15 2l3 3-9.5 9.5H5V11.5L15 2z" />
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </template>

                    </div>
                </div>

                <!-- PAGINATION -->
                <div class="border-t border-gray-100 py-4 pr-4 pl-4 dark:border-gray-800">
                    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between">
                        <p class="text-sm font-medium text-gray-500  dark:border-gray-800 dark:text-gray-400">
                            Showing <span x-text="startEntry">1</span> to
                            <span x-text="endEntry">10</span> of
                            <span x-text="totalEntries">30</span> entries
                        </p>
                        <div class="flex items-center justify-center gap-0.5 pt-3 xl:justify-end xl:pt-0">
                            <button @click="prevPage()"
                                class="shadow-theme-xs mr-3 flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-gray-400 hover:bg-gray-50 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]"
                                :disabled="currentPage === 1" disabled="disabled">
                                Previous
                            </button>

                            <button @click="goToPage(1)"
                                :class="currentPage === 1 ? 'bg-blue-500/[0.08] text-brand-500' :
                                    'text-gray-700 dark:text-gray-400'"
                                class="hover:text-brand-500 dark:hover:text-brand-500 flex h-10 mx-2 w-10 items-center justify-center rounded-lg text-sm font-medium hover:bg-blue-500/[0.08] bg-blue-500/[0.08] text-brand-500">
                                1
                            </button>

                            <template x-if="currentPage &gt; 3">
                                <span
                                    class="hover:text-brand-500 dark:hover:text-brand-500 flex h-10 w-10 items-center justify-center rounded-lg hover:bg-blue-500/[0.08]">...</span>
                            </template>

                            <template x-for="page in pagesAroundCurrent" :key="page">
                                <button @click="goToPage(page)"
                                    :class="currentPage === page ? 'bg-blue-500/[0.08] text-brand-500' :
                                        'text-gray-700 dark:text-gray-400'"
                                    class="hover:text-brand-500 dark:hover:text-brand-500 flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium hover:bg-blue-500/[0.08]">
                                    <span x-text="page"></span>
                                </button>
                            </template>
                            <button @click="goToPage(page)"
                                :class="currentPage === page ? 'bg-blue-500/[0.08] text-brand-500' :
                                    'text-gray-700 dark:text-gray-400'"
                                class="hover:text-brand-500 dark:hover:text-brand-500 flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium hover:bg-blue-500/[0.08] text-gray-700 dark:text-gray-400">
                                2 </button>

                            <template x-if="currentPage &lt; totalPages - 2">
                                <span
                                    class="hover:text-brand-500 dark:hover:text-brand-500 flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-500/[0.08] dark:text-gray-400">...</span>
                            </template>

                            <button @click="nextPage()"
                                class="shadow-theme-xs ml-2.5 flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-gray-700 hover:bg-gray-50 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]"
                                :disabled="currentPage === totalPages">
                                Next
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        function dataTableThree() {
            return {
                search: '',
                sortColumn: 'name',
                sortDirection: 'asc',
                currentPage: 1,
                perPage: 10,

                data: [{
                        id: 1,
                        name: "Abram Schleifer",
                        email: "demoemail@gmail.com",
                        position: "Software Engineer",
                        office: "Edinburgh",
                        status: "Hired",
                        salary: "$89,500"
                    },
                    {
                        id: 2,
                        name: "Carla George",
                        email: "demoemail@gmail.com",
                        position: "Integration Specialist",
                        office: "London",
                        status: "Pending",
                        salary: "$15,500"
                    },
                    {
                        id: 3,
                        name: "Ekstrom Bothman",
                        email: "demoemail@gmail.com",
                        position: "Sales Assistant",
                        office: "San Francisco",
                        status: "Hired",
                        salary: "$19,200"
                    },
                    {
                        id: 4,
                        name: "Emery Culhane",
                        email: "demoemail@gmail.com",
                        position: "Pre-Sales Support",
                        office: "New York",
                        status: "Hired",
                        salary: "$23,500"
                    }
                ],

                get filteredData() {
                    const s = this.search.toLowerCase()
                    return this.data
                        .filter(p =>
                            p.name.toLowerCase().includes(s) ||
                            p.position.toLowerCase().includes(s) ||
                            p.office.toLowerCase().includes(s)
                        )
                        .sort((a, b) => {
                            let m = this.sortDirection === 'asc' ? 1 : -1
                            return a[this.sortColumn] > b[this.sortColumn] ? 1 * m : -1 * m
                        })
                },

                get paginatedData() {
                    const start = (this.currentPage - 1) * this.perPage
                    return this.filteredData.slice(start, start + this.perPage)
                },

                get totalEntries() {
                    return this.filteredData.length
                },
                get totalPages() {
                    return Math.ceil(this.totalEntries / this.perPage)
                },
                get startEntry() {
                    return (this.currentPage - 1) * this.perPage + 1
                },
                get endEntry() {
                    return Math.min(this.currentPage * this.perPage, this.totalEntries)
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) this.currentPage++
                },
                prevPage() {
                    if (this.currentPage > 1) this.currentPage--
                },

                sortBy(col) {
                    if (this.sortColumn === col) {
                        this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc'
                    } else {
                        this.sortColumn = col
                        this.sortDirection = 'asc'
                    }
                }
            }
        }
    </script>
@endsection
