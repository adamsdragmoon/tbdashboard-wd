<div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-logo">
                            
                        </div>
                        <div class="nav-item theme-text">
                            <a href="/" class="nav-link"> Withdrawal </a>
                        </div>
                    </div>
                    <div class="nav-item sidebar-toggle">
                        <div class="btn-toggle sidebarCollapse">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
                        </div>
                    </div>
                </div>
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu {{ Request::is('/') ? 'active' : '' }}">
                        <a href="/" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Transactions</span></div>
                    </li>

                    @can('all')
                    <li class="menu {{ Request::path() == 'cs/input-reqwd' ? 'active' : '' }}">
                        <a href="/cs/input-reqwd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="edit"></i>
                                <span>Input Request WD</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ Request::path() == 'fin/grab-reqwd' ? 'active' : '' }}">
                        <a href="/fin/grab-reqwd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="download"></i><span>Grab Request WD</span>
                            </div>
                        </a>
                    </li>

                    @elsecan('cs')
                    <li class="menu {{ Request::path() == 'cs/input-reqwd' ? 'active' : '' }}">
                        <a href="/cs/input-reqwd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="edit"></i>
                                <span>Input Request WD</span>
                            </div>
                        </a>
                    </li>
                    
                    @elsecan('fin')

                    <li class="menu {{ Request::path() == 'fin/grab-reqwd' ? 'active' : '' }}">
                        <a href="/fin/grab-reqwd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="download"></i><span>Grab Request WD</span>
                            </div>
                        </a>
                    </li>
                    
                    @endcan
                    
                    {{-- <li class="menu {{ Request::path() == 'cs/update-reqwd' ? 'active' : '' }}">
                        <a href="/cs/update-reqwd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="edit-3"></i>
                                <span>Update Request WD</span>
                            </div>
                        </a>
                    </li> --}}

                    {{-- <li class="menu {{ Request::path() == 'fin/show-reqwd' ? 'active' : '' }}">
                        <a href="/fin/show-reqwd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="columns"></i><span>Show Request WD</span>
                            </div>
                        </a>
                    </li> --}}

                    
                    


                    {{-- <li class="menu {{ Request::path() == 'led/reject-reqwd' ? 'active' : '' }}">
                        <a href="/led/reject-reqwd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="x-square"></i><span>Reject Request WD</span>
                            </div>
                        </a>
                    </li> --}}
                

                    

                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Reports</span></div>
                    </li>

                    @can('cs')
                    <li class="menu {{ Request::is('reports/statuswd') ? 'active' : '' }}">
                        <a href="/reports/statuswd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="server"></i><span>Status Request</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{ Request::is('reports/historycs') ? 'active' : '' }}">
                        <a href="/reports/historycs" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="server"></i><span>History Closing</span>
                            </div>
                        </a>
                    </li>

                    @elsecan('all')
                    <li class="menu {{ Request::is('reports/statuswd') ? 'active' : '' }}">
                        <a href="/reports/statuswd" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="server"></i><span>Status Request</span>
                            </div>
                        </a>
                    </li>
                   

                    @endcan
                    
                    {{-- <li class="menu {{ Request::is('reports/list*') ? 'active' : '' }}">
                        <a href="#listwd" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="list"></i><span>List WD</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="listwd" data-bs-parent="#accordionExample">
                            <li>
                                <a href="/reports/list-wd-open">List WD Open </a>
                            </li>
                            <li>
                                <a href="/reports/list-wd-process">List WD Process </a>
                            </li>
                            <li>
                                <a href="/reports/list-wd-pending">List WD Pending </a>
                            </li>
                            <li>
                                <a href="/reports/list-wd-success">List WD Success Personal</a>
                            </li>
                            <li>
                                <a href="/reports/list-wd-success-all">List WD Success All</a>
                            </li>
                            <li>
                                <a href="/reports/list-wd-reject">List WD Reject </a>
                            </li>
                        </ul>
                    </li> --}}


                        @can('admin')
                        <li class="menu {{ Request::is('reports/list-wd-open') ? 'active' : '' }}">
                            <a href="/reports/list-wd-open" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="grid"></i><span>List WD Open</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Request::is('reports/list-wd-process') ? 'active' : '' }}">
                            <a href="/reports/list-wd-process" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="download"></i><span>List WD Process</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Request::is('reports/list-wd-success-all') ? 'active' : '' }}">
                            <a href="/reports/list-wd-success-all" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="check-circle"></i><span>List WD Success</span>
                                </div>
                            </a>
                        </li>
                        
                        <li class="menu {{ Request::is('reports/list-wd-pending') ? 'active' : '' }}">
                            <a href="/reports/list-wd-pending" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="clock"></i><span>List WD Pending</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu {{ Request::is('reports/list-wd-reject') ? 'active' : '' }}">
                            <a href="/reports/list-wd-reject" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="x-circle"></i><span>List WD Reject</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu {{ Request::is('reports/list-wd-personal') ? 'active' : '' }}">
                            <a href="/reports/list-wd-personal" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="user"></i><span>List WD Personal</span>
                                </div>
                            </a>
                        </li>

                        @elsecan('superadmin')

                        <li class="menu {{ Request::is('reports/list-wd-open') ? 'active' : '' }}">
                            <a href="/reports/list-wd-open" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="grid"></i><span>List WD Open</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Request::is('reports/list-wd-process') ? 'active' : '' }}">
                            <a href="/reports/list-wd-process" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="download"></i><span>List WD Process</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Request::is('reports/list-wd-success-all') ? 'active' : '' }}">
                            <a href="/reports/list-wd-success-all" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="check-circle"></i><span>List WD Success</span>
                                </div>
                            </a>
                        </li>
                        
                        <li class="menu {{ Request::is('reports/list-wd-pending') ? 'active' : '' }}">
                            <a href="/reports/list-wd-pending" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="clock"></i><span>List WD Pending</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu {{ Request::is('reports/list-wd-reject') ? 'active' : '' }}">
                            <a href="/reports/list-wd-reject" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="x-circle"></i><span>List WD Reject</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu {{ Request::is('reports/list-wd-personal') ? 'active' : '' }}">
                            <a href="/reports/list-wd-personal" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="user"></i><span>List WD Personal</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu {{ Request::is('reports/list-wd-all') ? 'active' : '' }}">
                            <a href="/reports/list-wd-all" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="user"></i><span>List WD All</span>
                                </div>
                            </a>
                        </li>


                        @elsecan('fin')
                        

                        <li class="menu {{ Request::is('reports/list-wd-success-all') ? 'active' : '' }}">
                            <a href="/reports/list-wd-success-all" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="check-circle"></i><span>List WD Success</span>
                                </div>
                            </a>
                        </li>
                        
                        <li class="menu {{ Request::is('reports/list-wd-pending') ? 'active' : '' }}">
                            <a href="/reports/list-wd-pending" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="clock"></i><span>List WD Pending</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu {{ Request::is('reports/list-wd-reject') ? 'active' : '' }}">
                            <a href="/reports/list-wd-reject" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="x-circle"></i><span>List WD Reject</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu {{ Request::is('reports/list-wd-personal') ? 'active' : '' }}">
                            <a href="/reports/list-wd-personal" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <i data-feather="user"></i><span>List WD Personal</span>
                                </div>
                            </a>
                        </li>

                        @endcan

                    

                    
                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Settings</span></div>
                    </li>  

                    
                    @can('fin')
                    <li class="menu {{ Request::is('settings/closing*') ? 'active' : '' }}">
                        <a href="/settings/closing" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="repeat"></i><span>Closing</span>
                            </div>
                        </a>
                    </li>
                    @elsecan('all')
                    <li class="menu {{ Request::is('settings/closing*') ? 'active' : '' }}">
                        <a href="/settings/closing" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="repeat"></i><span>Closing</span>
                            </div>
                        </a>
                    </li>

                    @endcan


                    
                    @can('superadmin')

                    <li class="menu {{ Request::is('settings/users') ? 'active' : '' }}">
                        <a href="/settings/users" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="users"></i><span>Manage Users</span>
                            </div>
                        </a>
                    </li>

                    

                    <li class="menu {{ Request::is('settings/agents') ? 'active' : '' }}">
                        <a href="/settings/agents" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="monitor"></i><span>Manage Agent</span>
                            </div>
                        </a>
                    </li>
                    
                    <li class="menu {{ Request::is('settings/providers') ? 'active' : '' }}">
                        <a href="/settings/providers" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="table"></i><span>Manage Provider</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ Request::is('#') ? 'active' : '' }}">
                        <a href="#" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="lock"></i><span>Manage Roles</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ Request::is('#') ? 'active' : '' }}">
                        <a href="#" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="sidebar"></i><span>Manage Departments</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ Request::is('#') ? 'active' : '' }}">
                        <a href="#" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span></span>
                            </div>
                        </a>
                    </li>

                    @elsecan('admin')
                    <li class="menu {{ Request::is('settings/users') ? 'active' : '' }}">
                        <a href="/settings/users" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="users"></i><span>Manage Users</span>
                            </div>
                        </a>
                    </li>

                    @endcan
                    
                    
                </ul>
                
            </nav>

        </div>