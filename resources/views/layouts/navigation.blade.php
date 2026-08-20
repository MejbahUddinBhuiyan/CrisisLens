<nav x-data="{ open: false }" style="background:white; border-bottom:1px solid #e5e7eb;">
    <style>
        .cl-nav-link {
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 800;
            color: #172033;
            text-decoration: none;
            transition: all 0.22s ease;
        }

        .cl-nav-link:hover {
            background: #ccfbf1;
            color: #006A4E;
            transform: translateY(-1px);
        }

        .cl-nav-link.active {
            background: #f8fafc;
            color: #006A4E;
        }

        .cl-mobile-link {
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 800;
            color: #172033;
            text-decoration: none;
            transition: all 0.22s ease;
        }

        .cl-mobile-link:hover {
            background: #ccfbf1;
            color: #006A4E;
            padding-left: 18px;
        }

        .cl-account-button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            color: #172033;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.22s ease;
        }

        .cl-account-button:hover {
            border-color: #006A4E;
            color: #006A4E;
            background: #f0fdfa;
        }

        .cl-logo-hover {
            transition: all 0.22s ease;
            display: inline-block;
        }

        .cl-logo-hover:hover {
            transform: scale(1.03);
        }

        .cl-logout-button {
            width: 100%;
            text-align: left;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 800;
            color: #b91c1c;
            background: #fef2f2;
            border: none;
            cursor: pointer;
            transition: all 0.22s ease;
        }

        .cl-logout-button:hover {
            background: #fee2e2;
            padding-left: 18px;
        }

        .cl-profile-link {
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 800;
            color: #172033;
            text-decoration: none;
            background: #f8fafc;
            transition: all 0.22s ease;
        }

        .cl-profile-link:hover {
            background: #ccfbf1;
            color: #006A4E;
            padding-left: 18px;
        }
    </style>

    <div style="max-width:1280px; margin:0 auto; padding:0 16px;">
        <div style="display:flex; justify-content:space-between; align-items:center; min-height:76px; gap:16px;">
            <div style="display:flex; align-items:center; gap:24px; flex-wrap:wrap;">
                <div style="display:flex; align-items:center;">
                    <a href="{{ route('dashboard') }}" class="cl-logo-hover" style="text-decoration:none;">
                        <x-application-logo />
                    </a>
                </div>

                <div class="hidden sm:flex" style="align-items:center; gap:10px; flex-wrap:wrap;">
                    <a href="{{ route('dashboard') }}" class="cl-nav-link active">
                        Dashboard
                    </a>

                    @role('Citizen')
                        <a href="{{ route('citizen.reports.create') }}" class="cl-nav-link">
                            Submit Report
                        </a>

                        <a href="{{ route('citizen.reports.index') }}" class="cl-nav-link">
                            My Reports
                        </a>

                        <a href="{{ route('citizen.shelters.index') }}" class="cl-nav-link">
                            Shelters
                        </a>

                        <a href="{{ route('citizen.alerts.index') }}" class="cl-nav-link">
                            Alerts
                        </a>
                    @endrole

                    @role('Emergency Responder')
                        <a href="{{ route('responder.reports.index') }}" class="cl-nav-link">
                            Reports
                        </a>

                        <a href="{{ route('citizen.shelters.index') }}" class="cl-nav-link">
                            Shelters
                        </a>

                        <a href="{{ route('citizen.alerts.index') }}" class="cl-nav-link">
                            Alerts
                        </a>
                    @endrole

                    @role('Authority Administrator')
                        <a href="{{ route('authority.reports.index') }}" class="cl-nav-link">
                            Review Reports
                        </a>

                        <a href="{{ route('authority.shelters.index') }}" class="cl-nav-link">
                            Shelters
                        </a>

                        <a href="{{ route('authority.alerts.index') }}" class="cl-nav-link">
                            Alerts
                        </a>
                    @endrole

                    @role('Super Administrator')
                        <a href="{{ route('admin.users.index') }}" class="cl-nav-link">
                            Users
                        </a>

                        <a href="{{ route('authority.reports.index') }}" class="cl-nav-link">
                            Reports
                        </a>

                        <a href="{{ route('authority.shelters.index') }}" class="cl-nav-link">
                            Shelters
                        </a>

                        <a href="{{ route('authority.alerts.index') }}" class="cl-nav-link">
                            Alerts
                        </a>
                    @endrole
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center" style="gap:14px;">
                <div style="text-align:right;">
                    <div style="font-size:14px; font-weight:900; color:#172033;">
                        {{ Auth::user()->name }}
                    </div>

                    <div style="font-size:12px; color:#64748b; margin-top:2px;">
                        {{ Auth::user()->roles->first()?->name ?? 'No Role' }}
                    </div>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="cl-account-button">
                            Account
                            <svg style="height:16px; width:16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <x-dropdown-link :href="url('/')">
                            CrisisLens Home
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        style="display:inline-flex; align-items:center; justify-content:center; padding:8px; border-radius:8px; color:#475569; background:white; border:1px solid #cbd5e1;">
                    <svg style="height:24px; width:24px;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="border-top:1px solid #e5e7eb; background:white;">
        <div style="padding:12px 16px; display:grid; gap:8px;">
            <a href="{{ route('dashboard') }}" class="cl-mobile-link" style="background:#f8fafc;">
                Dashboard
            </a>

            @role('Citizen')
                <a href="{{ route('citizen.reports.create') }}" class="cl-mobile-link">
                    Submit Report
                </a>

                <a href="{{ route('citizen.reports.index') }}" class="cl-mobile-link">
                    My Reports
                </a>

                <a href="{{ route('citizen.shelters.index') }}" class="cl-mobile-link">
                    Shelters
                </a>

                <a href="{{ route('citizen.alerts.index') }}" class="cl-mobile-link">
                    Alerts
                </a>
            @endrole

            @role('Emergency Responder')
                <a href="{{ route('responder.reports.index') }}" class="cl-mobile-link">
                    Reports
                </a>

                <a href="{{ route('citizen.shelters.index') }}" class="cl-mobile-link">
                    Shelters
                </a>

                <a href="{{ route('citizen.alerts.index') }}" class="cl-mobile-link">
                    Alerts
                </a>
            @endrole

            @role('Authority Administrator')
                <a href="{{ route('authority.reports.index') }}" class="cl-mobile-link">
                    Review Reports
                </a>

                <a href="{{ route('authority.shelters.index') }}" class="cl-mobile-link">
                    Shelters
                </a>

                <a href="{{ route('authority.alerts.index') }}" class="cl-mobile-link">
                    Alerts
                </a>
            @endrole

            @role('Super Administrator')
                <a href="{{ route('admin.users.index') }}" class="cl-mobile-link">
                    Users
                </a>

                <a href="{{ route('authority.reports.index') }}" class="cl-mobile-link">
                    Reports
                </a>

                <a href="{{ route('authority.shelters.index') }}" class="cl-mobile-link">
                    Shelters
                </a>

                <a href="{{ route('authority.alerts.index') }}" class="cl-mobile-link">
                    Alerts
                </a>
            @endrole
        </div>

        <div style="border-top:1px solid #e5e7eb; padding:14px 16px;">
            <div style="font-size:14px; font-weight:900; color:#172033;">
                {{ Auth::user()->name }}
            </div>

            <div style="font-size:12px; color:#64748b; margin-top:2px;">
                {{ Auth::user()->email }}
            </div>

            <div style="font-size:12px; color:#0F766E; margin-top:4px; font-weight:800;">
                {{ Auth::user()->roles->first()?->name ?? 'No Role' }}
            </div>

            <div style="margin-top:12px; display:grid; gap:8px;">
                <a href="{{ route('profile.edit') }}" class="cl-profile-link">
                    Profile
                </a>

                <a href="{{ url('/') }}" class="cl-profile-link">
                    CrisisLens Home
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="cl-logout-button">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>