<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" title="Hak Akses">
        <i class="material-icons">people</i>
        <span class="label-count">{{ auth()->user()->roles->count() }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">HAK AKSES</li>
        <li class="body">
            <ul class="menu">
                <li>
                    @role('admin_sistem')
                    <a href="/sistem">
                        {{-- <div class="icon-circle bg-indigo">
                            <i class="material-icons">verified_user</i>
                        </div> --}}
                    @endrole
                    @role('admin_koperasi')
                    <a href="/koperasi">
                        {{-- <div class="icon-circle bg-red">
                            <i class="material-icons">store</i>
                        </div> --}}
                    @endrole
                    @role('admin_bank')
                    <a href="/bank">
                        {{-- <div class="icon-circle bg-green">
                            <i class="material-icons">delete_sweep</i>
                        </div> --}}
                    @endrole
                    @role('nasabah')
                    <a href="/nasabah">
                        {{-- <div class="icon-circle bg-blue-grey">
                            <i class="material-icons">face</i>
                        </div> --}}
                    @endrole
                        <div class="menu-info">
                            <h4>{{ auth()->user()->roles[0]->display_name }}</h4>
                            <p>
                                <i class="material-icons">info_outline</i> {{ ucfirst(auth()->user()->roles[0]->description) }}
                            </p>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
{{-- <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
        <i class="material-icons">notifications</i>
        <span class="label-count">7</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">PEMBERITAHUAN</li>
        <li class="body">
            <ul class="menu">
                <li>
                    <a href="#">
                        <div class="icon-circle bg-light-green">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="menu-info">
                            <h4>12 new members joined</h4>
                            <p>
                                <i class="material-icons">access_time</i> 14 mins ago
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-circle bg-cyan">
                            <i class="material-icons">add_shopping_cart</i>
                        </div>
                        <div class="menu-info">
                            <h4>4 sales made</h4>
                            <p>
                                <i class="material-icons">access_time</i> 22 mins ago
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-circle bg-red">
                            <i class="material-icons">delete_forever</i>
                        </div>
                        <div class="menu-info">
                            <h4><b>Nancy Doe</b> deleted account</h4>
                            <p>
                                <i class="material-icons">access_time</i> 3 hours ago
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-circle bg-orange">
                            <i class="material-icons">mode_edit</i>
                        </div>
                        <div class="menu-info">
                            <h4><b>Nancy</b> changed name</h4>
                            <p>
                                <i class="material-icons">access_time</i> 2 hours ago
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-circle bg-blue-grey">
                            <i class="material-icons">comment</i>
                        </div>
                        <div class="menu-info">
                            <h4><b>John</b> commented your post</h4>
                            <p>
                                <i class="material-icons">access_time</i> 4 hours ago
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-circle bg-light-green">
                            <i class="material-icons">cached</i>
                        </div>
                        <div class="menu-info">
                            <h4><b>John</b> updated status</h4>
                            <p>
                                <i class="material-icons">access_time</i> 3 hours ago
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon-circle bg-purple">
                            <i class="material-icons">settings</i>
                        </div>
                        <div class="menu-info">
                            <h4>Settings updated</h4>
                            <p>
                                <i class="material-icons">access_time</i> Yesterday
                            </p>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="footer">
            <a href="#">Lihat semua pemberitahuan</a>
        </li>
    </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
        <i class="material-icons">flag</i>
        <span class="label-count">9</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">TUGAS</li>
        <li class="body">
            <ul class="menu tasks">
                <li>
                    <a href="#">
                        <h4>
                            Footer display issue
                            <small>32%</small>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h4>
                            Make new buttons
                            <small>45%</small>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h4>
                            Create new dashboard
                            <small>54%</small>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h4>
                            Solve transition issue
                            <small>65%</small>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h4>
                            Answer GitHub questions
                            <small>92%</small>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="footer">
            <a href="#">Lihat semua tugas</a>
        </li>
    </ul>
</li> --}}