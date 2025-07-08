<style>
    @media print {
        .heading {
            display: none;
        }
    }
</style>

<aside class="heading sticky z-50 bg-clr-midnight border-r border-brdr-secondary  transition-all duration-200"
    :class="isOpen
        ?
        'w-0 md:w-80' : 'w-0 md:w-20'">

    <div class="flex flex-col w-full h-full">
        {{-- todo ============================================================= LOGO --}}
        <div class="flex items-center w-full h-28 justify-center shadow-md">
            <img class="w-28" src="images/icons/urdaneta-logo.png" alt="">
        </div>

        <div class="py-5  flex flex-col justify-center items-center" :class="isOpen ? 'px-4' : ''">

            {{-- todo ========================================== DASHBOARD ================================================= --}}
            @can('dashboard')
            <x-admin.sidebar.sidebar-link href="/" :active="request()->is('/')" title="Dashboard">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="stroke-current">
                    <path
                        d="M6 14.6668V8.00016H10V14.6668M2 6.00016L8 1.3335L14 6.00016V13.3335C14 13.6871 13.8595 14.0263 13.6095 14.2763C13.3594 14.5264 13.0203 14.6668 12.6667 14.6668H3.33333C2.97971 14.6668 2.64057 14.5264 2.39052 14.2763C2.14048 14.0263 2 13.6871 2 13.3335V6.00016Z"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <x-admin.sidebar.link-name>Dashboard</x-admin.sidebar.link-name>
            </x-admin.sidebar.sidebar-link>
            @endcan
            {{-- todo ========================================== ARTIFACTS MANAGEMENT ================================================= --}}
            @can('artifacts-management')
            <x-admin.sidebar.sidebar-link href="/artifacts-managements" :active="request()->is([
                    'artifacts*',
                    'generate*',
                    'restoration-in-progress',
                    'restoration-restored'
                ])" title="Artifacts Managements">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="stroke-current"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_124_776)">
                            <path
                                d="M14.0001 5.33333V14H2.00008V5.33333M6.66675 8H9.33341M0.666748 2H15.3334V5.33333H0.666748V2Z"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_124_776">
                                <rect width="16" height="16" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>

                    <x-admin.sidebar.link-name>Artifacts Management</x-admin.sidebar.link-name>
                </x-admin.sidebar.sidebar-link>
            @endcan
            @if (request()->is([
                    'artifacts*',
                    'generate*',
                    'restoration-in-progress',
                    'restoration-restored'
                ]))
                <div class="ps-1 w-full">
                    @can('artifacts')
                        <x-admin.sidebar.visitor-monitoring-link href="/artifacts-managements" :active="request()->is('artifacts-managements', 'artifacts-view*', 'artifacts-edit*', 'artifacts-create')"
                            title="Artifacts Managements">

                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <x-admin.sidebar.link-name>Artifacts</x-admin.sidebar.link-name>
                        </x-admin.sidebar.visitor-monitoring-link>
                    @endcan
                    @can('restoration')
                        <x-admin.sidebar.visitor-monitoring-link href="/artifacts-restoration" :active="request()->is('artifacts-restoration*', 'restoration-in-progress', 'restoration-restored', 'generate*')"
                            title="Artifacts Restoration">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077 1.41-.513m14.095-5.13 1.41-.513M5.106 17.785l1.15-.964m11.49-9.642 1.149-.964M7.501 19.795l.75-1.3m7.5-12.99.75-1.3m-6.063 16.658.26-1.477m2.605-14.772.26-1.477m0 17.726-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205 12 12m6.894 5.785-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                            </svg>


                            <x-admin.sidebar.link-name>Restoration</x-admin.sidebar.link-name>
                        </x-admin.sidebar.visitor-monitoring-link>
                    @endcan

                    @can('artifacts-exhibit-monitoring')
                        <x-admin.sidebar.visitor-monitoring-link href="/artifacts-exhibit-monitoring" :active="request()->is('artifacts-exhibit*')"
                            title="Artifacts Exhibit Monitoring">

                            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                            </svg>

                            <x-admin.sidebar.link-name>Artifacts Exhibit Monitoring</x-admin.sidebar.link-name>
                        </x-admin.sidebar.visitor-monitoring-link>
                    @endcan
                </div>
            @endif

            {{-- todo ========================================== MAPPING HERITAGE ================================================= --}}
            @can('mapping-heritage')
                <x-admin.sidebar.sidebar-link href="/mapping-heritage" :active="request()->is(['mapping-heritage', 'mapping-heritage-create'])" title="Dashboard">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="stroke-current"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_124_778)">
                            <path
                                d="M5.33341 12.0002L0.666748 14.6668V4.00016L5.33341 1.3335M5.33341 12.0002L10.6667 14.6668M5.33341 12.0002V1.3335M10.6667 14.6668L15.3334 12.0002V1.3335L10.6667 4.00016M10.6667 14.6668V4.00016M10.6667 4.00016L5.33341 1.3335"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_124_778">
                                <rect width="16" height="16" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>


                    <x-admin.sidebar.link-name>Mapping Heritage</x-admin.sidebar.link-name>
                </x-admin.sidebar.sidebar-link>
            @endcan

            {{-- todo ========================================== VISITOR MONITORING ================================================= --}}
            @can('visitor-monitoring')
                <x-admin.sidebar.sidebar-link href="/visitor-registration" :active="request()->is('visitor-view*', 'visitor-registration', 'visitor-profiling', 'visitor-archived', 'visitor-profiling-view*', 'visitor-feedback', 'visitor-feedback-view*')" title="Visitor Monitoring">

                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="stroke-current"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.3334 14V12.6667C13.3334 11.9594 13.0525 11.2811 12.5524 10.781C12.0523 10.281 11.374 10 10.6667 10H5.33341C4.62617 10 3.94789 10.281 3.4478 10.781C2.9477 11.2811 2.66675 11.9594 2.66675 12.6667V14M10.6667 4.66667C10.6667 6.13943 9.47284 7.33333 8.00008 7.33333C6.52732 7.33333 5.33341 6.13943 5.33341 4.66667C5.33341 3.19391 6.52732 2 8.00008 2C9.47284 2 10.6667 3.19391 10.6667 4.66667Z"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <x-admin.sidebar.link-name>Visitor Monitoring</x-admin.sidebar.link-name>
                </x-admin.sidebar.sidebar-link>

                @if (request()->is(['visitor-view*', 'visitor-registration', 'visitor-profiling', 'visitor-archived', 'visitor-profiling-view*', 'visitor-feedback', 'visitor-feedback-view*']))
                    <div class="ps-1 w-full">
                        @can('visitor-registration')
                        <x-admin.sidebar.visitor-monitoring-link href="/visitor-registration" :active="request()->is('visitor-view*', 'visitor-registration')"
                            title="Visitor Monitoring">

                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="stroke-current"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 20V17.225C0 16.6583 0.141667 16.1333 0.425 15.65C0.708333 15.1667 1.1 14.8 1.6 14.55C1.83333 14.4333 2.05833 14.325 2.275 14.225C2.50833 14.125 2.75 14.0333 3 13.95V20H0ZM4 13C3.16667 13 2.45833 12.7083 1.875 12.125C1.29167 11.5417 1 10.8333 1 10C1 9.16667 1.29167 8.45833 1.875 7.875C2.45833 7.29167 3.16667 7 4 7C4.83333 7 5.54167 7.29167 6.125 7.875C6.70833 8.45833 7 9.16667 7 10C7 10.8333 6.70833 11.5417 6.125 12.125C5.54167 12.7083 4.83333 13 4 13ZM4 11C4.28333 11 4.51667 10.9083 4.7 10.725C4.9 10.525 5 10.2833 5 10C5 9.71667 4.9 9.48333 4.7 9.3C4.51667 9.1 4.28333 9 4 9C3.71667 9 3.475 9.1 3.275 9.3C3.09167 9.48333 3 9.71667 3 10C3 10.2833 3.09167 10.525 3.275 10.725C3.475 10.9083 3.71667 11 4 11ZM4 20V17.2C4 16.6333 4.14167 16.1167 4.425 15.65C4.725 15.1667 5.11667 14.8 5.6 14.55C6.63333 14.0333 7.68333 13.65 8.75 13.4C9.81667 13.1333 10.9 13 12 13C13.1 13 14.1833 13.1333 15.25 13.4C16.3167 13.65 17.3667 14.0333 18.4 14.55C18.8833 14.8 19.2667 15.1667 19.55 15.65C19.85 16.1167 20 16.6333 20 17.2V20H4ZM6 18H18V17.2C18 17.0167 17.95 16.85 17.85 16.7C17.7667 16.55 17.65 16.4333 17.5 16.35C16.6 15.9 15.6917 15.5667 14.775 15.35C13.8583 15.1167 12.9333 15 12 15C11.0667 15 10.1417 15.1167 9.225 15.35C8.30833 15.5667 7.4 15.9 6.5 16.35C6.35 16.4333 6.225 16.55 6.125 16.7C6.04167 16.85 6 17.0167 6 17.2V18ZM12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM12 10C12.55 10 13.0167 9.80833 13.4 9.425C13.8 9.025 14 8.55 14 8C14 7.45 13.8 6.98333 13.4 6.6C13.0167 6.2 12.55 6 12 6C11.45 6 10.975 6.2 10.575 6.6C10.1917 6.98333 10 7.45 10 8C10 8.55 10.1917 9.025 10.575 9.425C10.975 9.80833 11.45 10 12 10ZM20 13C19.1667 13 18.4583 12.7083 17.875 12.125C17.2917 11.5417 17 10.8333 17 10C17 9.16667 17.2917 8.45833 17.875 7.875C18.4583 7.29167 19.1667 7 20 7C20.8333 7 21.5417 7.29167 22.125 7.875C22.7083 8.45833 23 9.16667 23 10C23 10.8333 22.7083 11.5417 22.125 12.125C21.5417 12.7083 20.8333 13 20 13ZM20 11C20.2833 11 20.5167 10.9083 20.7 10.725C20.9 10.525 21 10.2833 21 10C21 9.71667 20.9 9.48333 20.7 9.3C20.5167 9.1 20.2833 9 20 9C19.7167 9 19.475 9.1 19.275 9.3C19.0917 9.48333 19 9.71667 19 10C19 10.2833 19.0917 10.525 19.275 10.725C19.475 10.9083 19.7167 11 20 11ZM21 20V13.95C21.25 14.0333 21.4833 14.125 21.7 14.225C21.9333 14.325 22.1667 14.4333 22.4 14.55C22.9 14.8 23.2917 15.1667 23.575 15.65C23.8583 16.1333 24 16.6583 24 17.225V20H21Z"
                                    fill="white" />
                            </svg>

                            <x-admin.sidebar.link-name>Visitor Registration</x-admin.sidebar.link-name>
                        </x-admin.sidebar.visitor-monitoring-link>
                        @endCan
                        <x-admin.sidebar.visitor-monitoring-link href="/visitor-profiling" :active="request()->is('visitor-profiling', 'visitor-profiling-view*', 'visitor-archived')"
                            title="Visitor Profiling">

                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                class="stroke-current" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.6668 8H12.0002L10.0002 14L6.00016 2L4.00016 8H1.3335" stroke-width="1.6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>


                            <x-admin.sidebar.link-name>Visitor Profiling</x-admin.sidebar.link-name>
                        </x-admin.sidebar.visitor-monitoring-link>

                        <x-admin.sidebar.visitor-monitoring-link href="/visitor-feedback" :active="request()->is('visitor-feedback', 'visitor-feedback-view*')"
                            title="Visitor Feedback">

                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.3" d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z" />
                            </svg>



                            <x-admin.sidebar.link-name>Visitor Feedback</x-admin.sidebar.link-name>
                        </x-admin.sidebar.visitor-monitoring-link>
                    </div>
                @endif
            @endcan

            {{-- todo ========================================== CONTRIBUTOR ================================================= --}}
            @can('contributor')
                <x-admin.sidebar.sidebar-link href="/contributor" :active="request()->is('contributor')" title="Contributor">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="stroke-current"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 6.26644L5 2.80644M2.18 4.63977L8 8.00644L13.82 4.63977M8 14.7198V7.99977M14 10.6664V5.33311C13.9998 5.09929 13.938 4.86965 13.821 4.66721C13.704 4.46478 13.5358 4.29668 13.3333 4.17977L8.66667 1.51311C8.46397 1.39608 8.23405 1.33447 8 1.33447C7.76595 1.33447 7.53603 1.39608 7.33333 1.51311L2.66667 4.17977C2.46417 4.29668 2.29599 4.46478 2.17897 4.66721C2.06196 4.86965 2.00024 5.09929 2 5.33311V10.6664C2.00024 10.9003 2.06196 11.1299 2.17897 11.3323C2.29599 11.5348 2.46417 11.7029 2.66667 11.8198L7.33333 14.4864C7.53603 14.6035 7.76595 14.6651 8 14.6651C8.23405 14.6651 8.46397 14.6035 8.66667 14.4864L13.3333 11.8198C13.5358 11.7029 13.704 11.5348 13.821 11.3323C13.938 11.1299 13.9998 10.9003 14 10.6664Z"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>



                    <x-admin.sidebar.link-name>Contributor</x-admin.sidebar.link-name>
                </x-admin.sidebar.sidebar-link>
            @endcan

            {{-- todo ========================================== REPORT GENERATION  ================================================= --}}
            @can('report-generation')
                <x-admin.sidebar.sidebar-link href="/visitor-report" :active="request()->is([
                    'visitor-report*',
                    'visitor-feedback-generation',
                    'contributor-report',
                    'statistics-overall-view',
                    'statistics-cc',
                    'statistics-sqd',
                    'contributor-letter*',
                    'contributor-view*'
                ])" title="Report Generation">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="stroke-current"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_124_780)">
                            <path
                                d="M3.99992 6.00016V1.3335H11.9999V6.00016M3.99992 12.0002H2.66659C2.31296 12.0002 1.97382 11.8597 1.72378 11.6096C1.47373 11.3596 1.33325 11.0205 1.33325 10.6668V7.3335C1.33325 6.97987 1.47373 6.64074 1.72378 6.39069C1.97382 6.14064 2.31296 6.00016 2.66659 6.00016H13.3333C13.6869 6.00016 14.026 6.14064 14.2761 6.39069C14.5261 6.64074 14.6666 6.97987 14.6666 7.3335V10.6668C14.6666 11.0205 14.5261 11.3596 14.2761 11.6096C14.026 11.8597 13.6869 12.0002 13.3333 12.0002H11.9999M3.99992 9.3335H11.9999V14.6668H3.99992V9.3335Z"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_124_780">
                                <rect width="16" height="16" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>

                    <x-admin.sidebar.link-name>Report Generation</x-admin.sidebar.link-name>
                </x-admin.sidebar.sidebar-link>
            @endcan

            @if (request()->is([
                    'visitor-report*',
                    'visitor-feedback-generation',
                    'contributor-report',
                    'statistics-overall-view',
                    'statistics-cc',
                    'statistics-sqd',
                    'contributor-letter*',
                    'contributor-view*'
                ]))
                <div class="ps-1 w-full">
                    @can('visitor-report')
                    <x-admin.sidebar.visitor-monitoring-link href="/visitor-report" :active="request()->is('visitor-report', 'visitor-report-view*')"
                        title="Visitor Report">

                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                clip-rule="evenodd" />
                        </svg>
                    

                        <x-admin.sidebar.link-name> Visitor Report </x-admin.sidebar.link-name>
                    </x-admin.sidebar.visitor-monitoring-link>
                    @endcan
                    @can('visitor-feedback')
                    <x-admin.sidebar.visitor-monitoring-link href="/visitor-feedback-generation" :active="request()->is([
                        'visitor-feedback-generation',
                        'statistics-overall-view',
                        'statistics-cc',
                        'statistics-sqd',
                        'visitor-report-feedback-view*'
                    ])"
                        title="Visitor Feedback">

                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z"
                                clip-rule="evenodd" />
                        </svg>



                        <x-admin.sidebar.link-name>Visitor Feedback</x-admin.sidebar.link-name>
                    </x-admin.sidebar.visitor-monitoring-link>
                    @endcan

                    @can('contributor-report')
                    <x-admin.sidebar.visitor-monitoring-link href="/contributor-report" :active="request()->is('contributor-report', 'contributor-letter*','contributor-view*')"
                        title="Contributor Report">

                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                clip-rule="evenodd" />
                        </svg>


                        <x-admin.sidebar.link-name>Contributor Report</x-admin.sidebar.link-name>
                    </x-admin.sidebar.visitor-monitoring-link>
                    @endcan
                </div>
            @endif

            {{-- todo ========================================== ACCOUNT MANAGEMENT ================================================= --}}
            @can('account-management')
                <x-admin.sidebar.sidebar-link href="/account-management" :active="request()->is('account-management*', 'account-archived')" title="Dashboard">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="stroke-current"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_124_777)">
                            <path
                                d="M8.00008 9.99984C9.10465 9.99984 10.0001 9.10441 10.0001 7.99984C10.0001 6.89527 9.10465 5.99984 8.00008 5.99984C6.89551 5.99984 6.00008 6.89527 6.00008 7.99984C6.00008 9.10441 6.89551 9.99984 8.00008 9.99984Z"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M12.9334 9.99984C12.8447 10.2009 12.8182 10.424 12.8574 10.6402C12.8966 10.8565 12.9997 11.056 13.1534 11.2132L13.1934 11.2532C13.3174 11.377 13.4157 11.5241 13.4828 11.6859C13.5499 11.8478 13.5845 12.0213 13.5845 12.1965C13.5845 12.3717 13.5499 12.5452 13.4828 12.7071C13.4157 12.869 13.3174 13.016 13.1934 13.1398C13.0696 13.2638 12.9225 13.3621 12.7607 13.4292C12.5988 13.4963 12.4253 13.5309 12.2501 13.5309C12.0749 13.5309 11.9014 13.4963 11.7395 13.4292C11.5776 13.3621 11.4306 13.2638 11.3067 13.1398L11.2667 13.0998C11.1096 12.9461 10.9101 12.843 10.6938 12.8038C10.4775 12.7646 10.2545 12.7911 10.0534 12.8798C9.85623 12.9643 9.68807 13.1047 9.56962 13.2835C9.45117 13.4624 9.3876 13.672 9.38675 13.8865V13.9998C9.38675 14.3535 9.24627 14.6926 8.99622 14.9426C8.74617 15.1927 8.40704 15.3332 8.05341 15.3332C7.69979 15.3332 7.36065 15.1927 7.11061 14.9426C6.86056 14.6926 6.72008 14.3535 6.72008 13.9998V13.9398C6.71492 13.7192 6.64349 13.5052 6.51509 13.3256C6.38668 13.1461 6.20724 13.0094 6.00008 12.9332C5.799 12.8444 5.57595 12.818 5.35969 12.8572C5.14343 12.8964 4.94387 12.9995 4.78675 13.1532L4.74675 13.1932C4.62292 13.3171 4.47587 13.4155 4.314 13.4826C4.15214 13.5497 3.97864 13.5842 3.80341 13.5842C3.62819 13.5842 3.45469 13.5497 3.29283 13.4826C3.13096 13.4155 2.98391 13.3171 2.86008 13.1932C2.73611 13.0693 2.63777 12.9223 2.57067 12.7604C2.50357 12.5986 2.46903 12.4251 2.46903 12.2498C2.46903 12.0746 2.50357 11.9011 2.57067 11.7392C2.63777 11.5774 2.73611 11.4303 2.86008 11.3065L2.90008 11.2665C3.05377 11.1094 3.15687 10.9098 3.19608 10.6936C3.2353 10.4773 3.20882 10.2542 3.12008 10.0532C3.03557 9.85599 2.89525 9.68783 2.71639 9.56937C2.53753 9.45092 2.32794 9.38736 2.11341 9.3865H2.00008C1.64646 9.3865 1.30732 9.24603 1.05727 8.99598C0.807224 8.74593 0.666748 8.40679 0.666748 8.05317C0.666748 7.69955 0.807224 7.36041 1.05727 7.11036C1.30732 6.86031 1.64646 6.71984 2.00008 6.71984H2.06008C2.28074 6.71467 2.49475 6.64325 2.67428 6.51484C2.85381 6.38644 2.99056 6.20699 3.06675 5.99984C3.15549 5.79876 3.18196 5.57571 3.14275 5.35944C3.10354 5.14318 3.00044 4.94362 2.84675 4.7865L2.80675 4.7465C2.68278 4.62267 2.58443 4.47562 2.51733 4.31376C2.45024 4.15189 2.4157 3.97839 2.4157 3.80317C2.4157 3.62795 2.45024 3.45445 2.51733 3.29258C2.58443 3.13072 2.68278 2.98367 2.80675 2.85984C2.93058 2.73587 3.07763 2.63752 3.23949 2.57042C3.40136 2.50333 3.57486 2.46879 3.75008 2.46879C3.9253 2.46879 4.0988 2.50333 4.26067 2.57042C4.42253 2.63752 4.56958 2.73587 4.69341 2.85984L4.73341 2.89984C4.89053 3.05353 5.09009 3.15663 5.30635 3.19584C5.52262 3.23505 5.74567 3.20858 5.94675 3.11984H6.00008C6.19726 3.03533 6.36543 2.89501 6.48388 2.71615C6.60233 2.53729 6.66589 2.32769 6.66675 2.11317V1.99984C6.66675 1.64622 6.80722 1.30708 7.05727 1.05703C7.30732 0.80698 7.64646 0.666504 8.00008 0.666504C8.3537 0.666504 8.69284 0.80698 8.94289 1.05703C9.19294 1.30708 9.33341 1.64622 9.33341 1.99984V2.05984C9.33427 2.27436 9.39784 2.48395 9.51629 2.66281C9.63474 2.84167 9.8029 2.98199 10.0001 3.0665C10.2012 3.15525 10.4242 3.18172 10.6405 3.14251C10.8567 3.10329 11.0563 3.00019 11.2134 2.8465L11.2534 2.8065C11.3772 2.68254 11.5243 2.58419 11.6862 2.51709C11.848 2.44999 12.0215 2.41545 12.1967 2.41545C12.372 2.41545 12.5455 2.44999 12.7073 2.51709C12.8692 2.58419 13.0162 2.68254 13.1401 2.8065C13.264 2.93033 13.3624 3.07739 13.4295 3.23925C13.4966 3.40111 13.5311 3.57462 13.5311 3.74984C13.5311 3.92506 13.4966 4.09856 13.4295 4.26042C13.3624 4.42229 13.264 4.56934 13.1401 4.69317L13.1001 4.73317C12.9464 4.89029 12.8433 5.08985 12.8041 5.30611C12.7649 5.52237 12.7913 5.74543 12.8801 5.9465V5.99984C12.9646 6.19702 13.1049 6.36518 13.2838 6.48363C13.4626 6.60208 13.6722 6.66565 13.8867 6.6665H14.0001C14.3537 6.6665 14.6928 6.80698 14.9429 7.05703C15.1929 7.30708 15.3334 7.64621 15.3334 7.99984C15.3334 8.35346 15.1929 8.6926 14.9429 8.94265C14.6928 9.19269 14.3537 9.33317 14.0001 9.33317H13.9401C13.7256 9.33403 13.516 9.39759 13.3371 9.51604C13.1582 9.63449 13.0179 9.80266 12.9334 9.99984Z"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </svg>

                    <x-admin.sidebar.link-name>Account Management</x-admin.sidebar.link-name>
                </x-admin.sidebar.sidebar-link>
            @endcan
            {{-- todo ========================================== AUDIT TRAILS ================================================= --}}
            <x-admin.sidebar.sidebar-link href="/audit-logs" :active="request()->is('audit-logs')" title="Dashboard">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="stroke-current"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 18L16 14L14.6 12.6L13 14.2V10H11V14.2L9.4 12.6L8 14L12 18ZM5 8V19H19V8H5ZM5 21C4.45 21 3.975 20.8083 3.575 20.425C3.19167 20.025 3 19.55 3 19V6.525C3 6.29167 3.03333 6.06667 3.1 5.85C3.18333 5.63333 3.3 5.43333 3.45 5.25L4.7 3.725C4.88333 3.49167 5.10833 3.31667 5.375 3.2C5.65833 3.06667 5.95 3 6.25 3H17.75C18.05 3 18.3333 3.06667 18.6 3.2C18.8833 3.31667 19.1167 3.49167 19.3 3.725L20.55 5.25C20.7 5.43333 20.8083 5.63333 20.875 5.85C20.9583 6.06667 21 6.29167 21 6.525V19C21 19.55 20.8 20.025 20.4 20.425C20.0167 20.8083 19.55 21 19 21H5ZM5.4 6H18.6L17.75 5H6.25L5.4 6Z" />
                </svg>

                <x-admin.sidebar.link-name>Audit Trails</x-admin.sidebar.link-name>
            </x-admin.sidebar.sidebar-link>

        </div>
    </div>

</aside>
