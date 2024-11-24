<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('/') }}" class="brand-link">
        {{--        <img src="{{asset("logo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">@lang('dashboard.Ketabi')</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->image? asset(auth()->user()->image) :asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('settings.edit',auth()->id())}}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item  {{ in_array(request()->route()->getName(),['/'])? 'menu-open': '' }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.Home')
                        </p>
                    </a>
                </li>

                @if ($user_permissions->contains('education-read'))
                    <li
                        class="nav-item {{ in_array(request()->route()->getName(),['educational-stages.index','educational-stages.create','educational-stages.edit','subjects.index', 'subjects.create', 'subjects.edit','packages.index', 'packages.destroy', 'packages.show','subscriptions.index', 'subscriptions.destroy', 'subscriptions.edit'])? 'menu-open': '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.education')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($user_permissions->contains('educational_stages-read'))
                                <li class="nav-item">
                                    <a href="{{ route('educational-stages.index') }}"
                                       class="nav-link {{ in_array(request()->route()->getName(),['educational-stages.index', 'educational-stages.create', 'educational-stages.show', 'educational-stages.edit'])? 'active': '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('dashboard.educational_stages')
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($user_permissions->contains('subjects-read'))
                                <li
                                    class="nav-item ">
                                    <a href="{{ route('subjects.index') }}" class="nav-link  {{ in_array(request()->route()->getName(),['subjects.index', 'subjects.create', 'subjects.edit'])? 'active': '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('dashboard.subjects')
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($user_permissions->contains('packages-read'))
                                <li
                                    class="nav-item  ">
                                    <a href="{{ route('packages.index') }}" class="nav-link {{ in_array(request()->route()->getName(),['packages.index', 'packages.destroy', 'packages.show'])? 'active': '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('dashboard.packages')
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($user_permissions->contains('subscriptions-read'))
                                <li
                                    class="nav-item  ">
                                    <a href="{{ route('subscriptions.index') }}" class="nav-link {{ in_array(request()->route()->getName(),['subscriptions.index', 'subscriptions.destroy', 'subscriptions.edit'])? 'active': '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('dashboard.subscriptions')
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if ($user_permissions->contains('users-read'))
                    <li
                        class="nav-item {{in_array(request()->route()->getName(),['teachers.index', 'teachers.create', 'teachers.show', 'teachers.edit','students.index', 'students.create', 'students.show', 'students.edit'])?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.users')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($user_permissions->contains('teachers-read'))
                                <li class="nav-item">
                                    <a href="{{ route('teachers.index') }}"
                                       class="nav-link {{ in_array(request()->route()->getName(),['teachers.index', 'teachers.create', 'teachers.show', 'teachers.edit'])? 'active': '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('dashboard.teachers')
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($user_permissions->contains('students-read'))
                                <li class="nav-item">
                                    <a href="{{ route('students.index') }}"
                                       class="nav-link {{ in_array(request()->route()->getName(),['students.index', 'students.create', 'students.show', 'students.edit'])? 'active': '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('dashboard.students')
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if ($user_permissions->contains('structures-update'))
                    <li
                        class="nav-item {{in_array(request()->route()->getName(),['about-us-content.index','privacy-terms.index'])?'menu-open':''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.structure')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($user_permissions->contains('privacy_terms-update'))
                                <li class="nav-item">
                                    <a href="{{ route('privacy-terms.index') }}"
                                       class="nav-link {{ in_array(request()->route()->getName(),['privacy-terms.index','privacy-terms.store'])? 'active': '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('dashboard.privacy_and_policy')
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($user_permissions->contains('about-update'))
                                <li class="nav-item">
                                    <a href="{{ route('about-us-content.index') }}"
                                       class="nav-link {{ in_array(request()->route()->getName(),['about-us-content.index','about-us-content.store'])? 'active': '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('dashboard.About Us')
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if($user_permissions->contains('infos-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['infos.edit'])? 'menu-open': '' }}">
                        <a href="{{ route('infos.edit') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.info_control')
                            </p>
                        </a>
                    </li>
                @endif
                @if($user_permissions->contains('contacts-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['contacts.index','contacts.show'])? 'menu-open': '' }}">
                        <a href="{{ route('contacts.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.Contact Us')
                            </p>
                        </a>
                    </li>
                @endif
                @if($user_permissions->contains('payments-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['payments.index','payments.show'])? 'menu-open': '' }}">
                        <a href="{{ route('payments.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.Payments')
                            </p>
                        </a>
                    </li>
                @endif
                @if($user_permissions->contains('banks-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['banks.index','banks.create','banks.edit'])? 'menu-open': '' }}">
                        <a href="{{ route('banks.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.banks')
                            </p>
                        </a>
                    </li>
                @endif
                @if($user_permissions->contains('roles-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['roles.index','roles.create','roles.edit','roles.mangers','managers.create','managers.edit'])? 'menu-open': '' }}">
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.roles_and_permissions')
                            </p>
                        </a>
                    </li>
                @endif
                @if($user_permissions->contains('wallets-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['wallets.index','wallets.transactions','transactions.edit','transactions.update'])? 'menu-open': '' }}">
                        <a href="{{ route('wallets.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.wallets')
                            </p>
                        </a>
                    </li>
                @endif

                <li
                    class="nav-item  {{ in_array(request()->route()->getName(),['settings.edit'])? 'menu-open': '' }} {{ Route::currentRouteName()=='settings.edit'?'activeNav':'' }}">
                    <a href="{{ route('settings.edit', auth()->user()->id) }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            @lang('dashboard.Settings')
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
