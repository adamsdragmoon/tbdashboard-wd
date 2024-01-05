<div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

            <a href="javascript:void(0);" class="sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </a>

            

            <ul class="navbar-item flex-row ms-lg-auto ms-0">

                <li class="nav-item theme-toggle-item">
                    New Request (Open) : <span id="notification"></span>
                    {{-- <audio id="notifSound" src="/sound/ticktac.mp3" preload="auto"></audio> --}}
                </li>

                <li class="nav-item theme-toggle-item">
                    On Process (Grab) : <span id="notificationGrab"></span>
                </li>

                <li class="nav-item theme-toggle-item">
                    <a href="javascript:void(0);" class="nav-link theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon dark-mode"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun light-mode"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                    </a>
                </li>

                

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="/img/person.png" class="rounded-circle">
                                
                            </div>
                        </div>
                    </a>

                    @auth

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    &#x1F44B;
                                </div>
                                <div class="media-body">
                                    <h5>{{ auth()->user()->name }}</h5>
                                </div>
                            </div>
                        <div class="dropdown-item">
                            <a href="/settings/user/{{ auth()->user()->uuid }}"> <i data-feather="eye"></i><span>Profile</span> </a>
                        </div>

                        <div class="dropdown-item">
                            <a href="/settings/user/{{ auth()->user()->uuid }}/edit"> <i data-feather="hash"></i><span>Change Password</span> </a>
                        </div>
                            
                        <div class="dropdown-item">
                            <form action="/logout" method="post">
                                @csrf
                            <button class="btn">
                                <i data-feather="log-out"></i><span>Logout</span>
                            </button>
                            </form>
                        </div>
                    </div>

                    @else

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                
                                <div class="media-body">
                                    <h5>Please Login !</h5>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="/login">
                                <i data-feather="log-in"></i><span>Login</span>
                            </a>
                        </div>
                    </div>

                    @endauth

                    
                    
                </li>
            </ul>
        </header>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        var previousCount = 0;
        setInterval(function(){
            $.ajax({
                url: "/fin/notif",
                type: "GET",
                success: function(data){
                    var currentCount = Number(data);
                    $('#notification').text(data);
                    if (currentCount > previousCount) {
                    // Trigger your notification here
                    // document.getElementById('notifSound').play();
                    }
                    previousCount = currentCount;
                }
            });
        }, 500);
    });

    $(document).ready(function(){
        setInterval(function(){
            $.ajax({
                url: "/fin/notif/grab",
                type: "GET",
                success: function(data){
                    $('#notificationGrab').text(data);
                }
            });
        }, 500);
    });

    </script>