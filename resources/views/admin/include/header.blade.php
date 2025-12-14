  <div id="kt_app_header" class="app-header">
      <!--begin::Header primary-->
      <div class="app-header-primary">
          <!--begin::Header primary container-->
          <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
              id="kt_app_header_primary_container">
              <!--begin::Header primary wrapper-->
              <div class="d-flex flex-stack flex-grow-1">
                  <div class="d-flex">
                      <!--begin::Logo-->
                      <div class="app-header-logo d-flex flex-center gap-2 me-lg-15">
                          <!--begin::Sidebar toggle-->
                          <button class="btn btn-icon btn-sm btn-custom d-flex d-lg-none ms-n2"
                              id="kt_app_header_menu_toggle">
                              <i class="ki-solid ki-abstract-14 fs-2"></i>
                          </button>
                          <!--end::Sidebar toggle-->
                          <!--begin::Logo image-->
                          <a href="{{ route('home') }}"
                              style="color: white !important;font-size: x-large;font-weight: 900;">
                              Enquiry Platform
                          </a>
                          <!--end::Logo image-->
                      </div>
                      <!--end::Logo-->
                      <!--begin::Menu wrapper-->
                      <div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
                          <!--begin::Menu holder-->
                          <div class="app-header-menu app-header-mobile-drawer align-items-stretch"
                              data-kt-drawer="true" data-kt-drawer-name="app-header-menu"
                              data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                              data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                              data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle"
                              data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                              data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}">
                              <!--begin::Menu-->
                              <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-gray-900 menu-icon-gray-500 menu-arrow-gray-500 menu-state-icon-primary menu-state-bullet-primary fw-semibold fs-6 align-items-stretch my-5 my-lg-0 px-2 px-lg-0"
                                  id="#kt_app_header_menu" data-kt-menu="true">
                                  <!--begin:Menu item-->
                                  <div
                                      class="menu-item {{ isActiveModule(['home']) }} menu-here-bg menu-lg-down-accordion me-0 me-lg-2 ">
                                      <!--begin:Menu link-->

                                      <span class="menu-link">
                                          <a href="{{ route('home') }}"><span class="menu-title">Dashboard</span></a>

                                      </span></a>
                                      <!--end:Menu link-->
                                      <!--begin:Menu sub-->

                                      <!--end:Menu sub-->
                                  </div>


                                  <!--begin:Menu item-->

                                  <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                      data-kt-menu-placement="right-start"
                                      class="menu-item menu-lg-down-accordion d-lg-none">
                                      <!--begin:Menu link-->
                                      <span class="menu-link">

                                          <span class="menu-title">Employee Master</span>
                                          <span class="menu-arrow"></span>
                                      </span>
                                      <!--end:Menu link-->
                                      <!--begin:Menu sub-->
                                      <div
                                          class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px ">
                                          <!--begin:Menu item-->

                                          @canany(['user edit', 'user delete', 'user add', 'user view'])
                                              <div class="menu-item">
                                                  <!--begin:Menu link-->
                                                  <a class="menu-link {{ isActiveRoute(['user.edit', 'user.create', 'user.show', 'user.index']) }}"
                                                      href="{{ route('user.index') }}">

                                                      <span class="menu-title">Employee</span>
                                                  </a>
                                                  <!--end:Menu link-->
                                              </div>
                                          @endcanany



                                          @canany(['role edit', 'role delete', 'role add', 'role view'])
                                              <div class="menu-item">
                                                  <!--begin:Menu link-->
                                                  <a class="menu-link {{ isActiveRoute(['role.edit', 'role.create', 'role.show', 'role.index']) }}"
                                                      href="{{ route('role.index') }}">

                                                      <span class="menu-title">Roles</span>
                                                  </a>
                                                  <!--end:Menu link-->
                                              </div>
                                          @endcanany
                                          @canany([
                                              'permission edit',
                                              'permission delete',
                                              'permission add',
                                              'permission
                                              view',
                                              ])
                                              <div class="menu-item">
                                                  <!--begin:Menu link-->
                                                  <a class="menu-link {{ isActiveRoute(['permission.edit', 'permission.create', 'permission.show', 'permission.index']) }}"
                                                      href="{{ route('permission.index') }}">

                                                      <span class="menu-title">Permissions</span>
                                                  </a>
                                                  <!--end:Menu link-->
                                              </div>
                                          @endcanany
                                      </div>

                                  </div>


                                  <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                      data-kt-menu-placement="right-start"
                                      class="menu-item menu-lg-down-accordion d-lg-none">
                                      <!--begin:Menu link-->
                                      <span class="menu-link">

                                          <span class="menu-title">Master</span>
                                          <span class="menu-arrow"></span>
                                      </span>
                                      <!--end:Menu link-->
                                      <!--begin:Menu sub-->
                                      <div
                                          class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px ">
                                          <!--begin:Menu item-->

                                          @canany(['state edit', 'state delete', 'state add', 'state view'])
                                              <div class="menu-item">
                                                  <!--begin:Menu link-->
                                                  <a class="menu-link {{ isActiveRoute(['state.edit', 'state.create', 'state.show', 'state.index']) }}"
                                                      href="{{ route('state.index') }}">

                                                      <span class="menu-title">State</span>
                                                  </a>
                                                  <!--end:Menu link-->
                                              </div>
                                          @endcanany



                                          @canany(['city edit', 'role delete', 'role add', 'role view'])
                                              <div class="menu-item">
                                                  <!--begin:Menu link-->
                                                  <a class="menu-link {{ isActiveRoute(['city.edit', 'city.create', 'city.show', 'city.index']) }}"
                                                      href="{{ route('city.index') }}">

                                                      <span class="menu-title">Cities</span>
                                                  </a>
                                                  <!--end:Menu link-->
                                              </div>
                                          @endcanany
                                          @canany([
                                              'location edit',
                                              'location delete',
                                              'location add',
                                              'location
                                              view',
                                              ])
                                              <div class="menu-item">
                                                  <!--begin:Menu link-->
                                                  <a class="menu-link {{ isActiveRoute(['location.edit', 'location.create', 'location.show', 'location.index']) }}"
                                                      href="{{ route('location.index') }}">

                                                      <span class="menu-title">Locations\Area</span>
                                                  </a>
                                                  <!--end:Menu link-->
                                              </div>
                                          @endcanany
                                      </div>

                                  </div>
                              </div>
                              <!--end::Menu-->
                          </div>
                          <!--end::Menu holder-->
                      </div>
                      <!--end::Menu wrapper-->
                  </div>
                  <!--begin::Navbar-->
                  <div class="app-navbar flex-shrink-0 gap-2">



                      <!--begin::User menu-->
                      <div class="app-navbar-item ms-1">
                          <!--begin::Menu wrapper-->
                          <div class="cursor-pointer symbol position-relative symbol-35px"
                              data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                              data-kt-menu-placement="bottom-end">
                              <img src="{{ auth()->user()->profile_pic
                                  ? asset('storage/uploads/user_images/' . auth()->user()->profile_pic)
                                  : asset('admin/assets1/media/avatars/blank.png') }}"
                                  alt="user" />
                              <span
                                  class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle mb-1 bottom-0 start-100 animation-blink"></span>
                          </div>
                          <!--begin::User account menu-->
                          <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                              data-kt-menu="true">
                              <!--begin::Menu item-->
                              <div class="menu-item px-3">
                                  <div class="menu-content d-flex align-items-center px-3">
                                      <!--begin::Avatar-->
                                      <div class="symbol symbol-50px me-5">
                                          <img alt="Logo"
                                              src="{{ auth()->user()->profile_pic
                                                  ? asset('storage/uploads/user_images/' . auth()->user()->profile_pic)
                                                  : asset('admin/assets1/media/avatars/blank.png') }}" />
                                      </div>
                                      <!--end::Avatar-->
                                      <!--begin::Username-->
                                      <div class="d-flex flex-column">
                                          <div class="fw-bold d-flex align-items-center fs-5">
                                              {{ auth()->user()->name }}
                                          </div>
                                          <a href="#"
                                              class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                      </div>
                                      <!--end::Username-->
                                  </div>
                              </div>
                              <div class="separator my-2"></div>
                              <div class="menu-item px-2">
                                  <a href="javascript:void(0)" class="menu-link px-5" id="modal_show">
                                      <span class="menu-icon" data-kt-element="icon">
                                          <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/metronic/docs/core/html/src/media/icons/duotune/general/gen055.svg-->
                                          <span class="svg-icon svg-icon-muted svg-icon-2"><svg width="24"
                                                  height="24" viewBox="0 0 24 24" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                                                  <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                                      fill="currentColor" />
                                                  <path
                                                      d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                                      fill="currentColor" />
                                                  <path
                                                      d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                                      fill="currentColor" />
                                              </svg>
                                          </span>
                                          <!--end::Svg Icon-->
                                      </span>
                                      <span class="menu-title">Change Password</span>
                                  </a>
                              </div>

                              <!--end::Menu item-->
                              <!--begin::Menu separator-->
                              <div class="separator my-2"></div>
                              <!--end::Menu separator-->
                              <!--begin::Menu item-->
                              <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                  data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                  <a href="#" class="menu-link px-5">
                                      <span class="menu-title position-relative">Mode <span
                                              class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                              <i class="ki-solid ki-night-day theme-light-show fs-2"></i>
                                              <i class="ki-solid ki-moon theme-dark-show fs-2"></i>
                                          </span>
                                      </span>
                                  </a>
                                  <!--begin::Menu-->
                                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                      data-kt-menu="true" data-kt-element="theme-mode-menu">
                                      <!--begin::Menu item-->
                                      <div class="menu-item px-3 my-0">
                                          <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                              data-kt-value="light">
                                              <span class="menu-icon" data-kt-element="icon">
                                                  <i class="ki-solid ki-night-day fs-2"></i>
                                              </span>
                                              <span class="menu-title">Light</span>
                                          </a>
                                      </div>
                                      <!--end::Menu item-->
                                      <!--begin::Menu item-->
                                      <div class="menu-item px-3 my-0">
                                          <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                              data-kt-value="dark">
                                              <span class="menu-icon" data-kt-element="icon">
                                                  <i class="ki-solid ki-moon fs-2"></i>
                                              </span>
                                              <span class="menu-title">Dark</span>
                                          </a>
                                      </div>
                                      <!--end::Menu item-->
                                      <!--begin::Menu item-->
                                      <div class="menu-item px-3 my-0">
                                          <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                              data-kt-value="system">
                                              <span class="menu-icon" data-kt-element="icon">
                                                  <i class="ki-solid ki-screen fs-2"></i>
                                              </span>
                                              <span class="menu-title">System</span>
                                          </a>
                                      </div>
                                      <!--end::Menu item-->
                                  </div>
                                  <!--end::Menu-->
                              </div>

                              <div class="menu-item px-5">
                                  <a href="{{ route('admin.logout') }}" class="menu-link px-5">Sign
                                      Out</a>
                              </div>
                              <!--end::Menu item-->
                          </div>
                          <!--end::User account menu-->
                          <!--end::Menu wrapper-->
                      </div>
                      <!--end::User menu-->
                      <!--begin::Header menu toggle-->

                      <!--end::Header menu toggle-->
                      <!--begin::Header menu toggle-->

                      <!--end::Header menu toggle-->
                  </div>
                  <!--end::Navbar-->
              </div>
              <!--end::Header primary wrapper-->
          </div>
          <!--end::Header primary container-->
      </div>
      <!--end::Header primary-->
      <!--begin::Header secondary-->
      <div class="app-header-secondary app-header-mobile-drawer" data-kt-drawer="true"
          data-kt-drawer-name="app-header-secondary" data-kt-drawer-activate="{default: true, lg: false}"
          data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
          data-kt-drawer-toggle="#kt_header_secondary_mobile_toggle" data-kt-swapper="true"
          data-kt-swapper-mode="{default: 'append', lg: 'append'}"
          data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header'}">
          <!--begin::Header secondary wrapper-->
          <div class="d-flex flex-column flex-grow-1 overflow-hidden">
              <div
                  class="app-header-secondary-menu-main d-flex flex-grow-lg-1 align-items-end pt-3 pt-lg-2 px-3 px-lg-0 w-auto overflow-auto flex-nowrap">
                  <div class="app-container container-fluid">
                      <!--begin::Main menu-->
                      <div class="menu menu-rounded menu-nowrap flex-shrink-0 menu-row menu-active-bg menu-title-gray-700 menu-state-gray-900 menu-icon-gray-500 menu-arrow-gray-500 menu-state-icon-primary menu-state-bullet-primary fw-semibold fs-base align-items-stretch"
                          id="#kt_app_header_secondary_menu" data-kt-menu="true">
                          <!--begin:Menu item-->

                          {{-- <div class="menu-item">
                              <!--begin:Menu link-->
                              <a class="menu-link {{ isActiveRoute(['home']) }}"
                                  href="{{ route('home') }}">
                                  <span class="menu-title">Dasboard</span>
                              </a>
                              <!--end:Menu link-->
                          </div> --}}
                          {{-- <div class="menu-item">
                              <!--begin:Menu content-->
                              <div class="menu-content">
                                  <div class="menu-separator"></div>
                              </div>
                              <!--end:Menu content-->
                          </div> --}}


                          <!--end:Menu item-->
                          <!--begin:Menu item-->




                          @canany([
                              'user edit',
                              'user delete',
                              'user add',
                              'user view',
                              'role edit',
                              'role delete',
                              'role add',
                              'role view',
                              'permission edit',
                              'permission delete',
                              'permission add',
                              'permission view',
                              ])
                              <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                  data-kt-menu-placement="bottom-start"
                                  class="menu-item {{ isActiveModule(['role.edit', 'role.create', 'role.show', 'role.index', 'permission.edit', 'permission.create', 'permission.show', 'permission.index', 'department.edit', 'department.create', 'department.show', 'department.index', 'user.edit', 'user.create', 'user.show', 'user.index', 'voucher.edit', 'voucher.create', 'voucher.show', 'voucher.index']) }}">
                                  <!--begin:Menu link-->
                                  <span class="menu-link">
                                      <span class="menu-title">Employees Master</span>
                                      <span class="menu-arrow"></span>
                                  </span>
                                  <!--end:Menu link-->
                                  <!--begin:Menu sub-->
                                  <div class="menu-sub menu-sub-dropdown px-lg-2 py-lg-4 w-150px w-lg-175px">
                                      <!--begin:Menu item-->

                                      @canany(['user edit', 'user delete', 'user add', 'user view'])
                                          <div class="menu-item">
                                              <!--begin:Menu link-->
                                              <a class="menu-link {{ isActiveRoute(['user.edit', 'user.create', 'user.show', 'user.index']) }}"
                                                  href="{{ route('user.index') }}">

                                                  <span class="menu-title">Employee</span>
                                              </a>
                                              <!--end:Menu link-->
                                          </div>
                                      @endcanany



                                      @canany(['role edit', 'role delete', 'role add', 'role view'])
                                          <div class="menu-item">
                                              <!--begin:Menu link-->
                                              <a class="menu-link {{ isActiveRoute(['role.edit', 'role.create', 'role.show', 'role.index']) }}"
                                                  href="{{ route('role.index') }}">

                                                  <span class="menu-title">Roles</span>
                                              </a>
                                              <!--end:Menu link-->
                                          </div>
                                      @endcanany
                                      @canany(['permission edit', 'permission delete', 'permission add', 'permission view'])
                                          <div class="menu-item">
                                              <!--begin:Menu link-->
                                              <a class="menu-link {{ isActiveRoute(['permission.edit', 'permission.create', 'permission.show', 'permission.index']) }}"
                                                  href="{{ route('permission.index') }}">

                                                  <span class="menu-title">Permissions</span>
                                              </a>
                                              <!--end:Menu link-->
                                          </div>
                                      @endcanany



                                      <!--end:Menu item-->
                                      <!--begin:Menu item-->

                                      <!--end:Menu item-->
                                  </div>
                                  <!--end:Menu sub-->
                              </div>
                          @endcanany


 <div class="menu-item">
                              <!--begin:Menu content-->
                              <div class="menu-content">
                                  <div class="menu-separator"></div>
                              </div>
                              <!--end:Menu content-->
                          </div>
                          @canany([
                              'state edit',
                              'state delete',
                              'state add',
                              'state view',

                              'city edit',
                              'city delete',
                              'city add',
                              'city view',
                              'location edit',
                              'location delete',
                              'location add',
                              'location view',

                              ])
                              <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                  data-kt-menu-placement="bottom-start"
                                  class="menu-item {{ isActiveModule(['state.edit', 'state.create', 'rstateole.show', 'state.index', 'city.edit', 'city.create', 'city.show', 'city.index', 'location.edit', 'location.create', 'location.show', 'location.index']) }}">
                                  <!--begin:Menu link-->
                                  <span class="menu-link">
                                      <span class="menu-title">Master</span>
                                      <span class="menu-arrow"></span>
                                  </span>
                                  <!--end:Menu link-->
                                  <!--begin:Menu sub-->
                                  <div class="menu-sub menu-sub-dropdown px-lg-2 py-lg-4 w-150px w-lg-175px">
                                      <!--begin:Menu item-->

                                      @canany(['state edit', 'state delete', 'state add', 'state view'])
                                          <div class="menu-item">
                                              <!--begin:Menu link-->
                                              <a class="menu-link {{ isActiveRoute(['state.edit', 'state.create', 'state.show', 'state.index']) }}"
                                                  href="{{ route('state.index') }}">

                                                  <span class="menu-title">States</span>
                                              </a>
                                              <!--end:Menu link-->
                                          </div>
                                      @endcanany



                                      @canany(['city edit', 'city delete', 'city add', 'city view'])
                                          <div class="menu-item">
                                              <!--begin:Menu link-->
                                              <a class="menu-link {{ isActiveRoute(['city.edit', 'city.create', 'city.show', 'city.index']) }}"
                                                  href="{{ route('city.index') }}">

                                                  <span class="menu-title">Cities</span>
                                              </a>
                                              <!--end:Menu link-->
                                          </div>
                                      @endcanany
                                      @canany(['location edit', 'location delete', 'location add', 'location view'])
                                          <div class="menu-item">
                                              <!--begin:Menu link-->
                                              <a class="menu-link {{ isActiveRoute(['location.edit', 'location.create', 'location.show', 'location.index']) }}"
                                                  href="{{ route('location.index') }}">

                                                  <span class="menu-title">Locations\Area</span>
                                              </a>
                                              <!--end:Menu link-->
                                          </div>
                                      @endcanany

                                      <!--end:Menu item-->
                                      <!--begin:Menu item-->

                                      <!--end:Menu item-->
                                  </div>
                                  <!--end:Menu sub-->
                              </div>
                          @endcanany

<div class="menu-item">
                                    <!--begin:Menu content-->
                                    <div class="menu-content">
                                        <div class="menu-separator"></div>
                                    </div>
                                    <!--end:Menu content-->
                                </div>

        @canany(['resort edit', 'resort delete', 'resort add', 'resort view'])
                                          <div class="menu-item">
                                              <!--begin:Menu link-->
                                              <a class="menu-link {{ isActiveRoute(['resort.edit', 'resort.create', 'resort.show', 'resort.index']) }}"
                                                  href="{{ route('resort.index') }}">

                                                  <span class="menu-title">Resort</span>
                                              </a>
                                              <!--end:Menu link-->
                                          </div>
                                      @endcanany



                          <!--end:Menu item-->
                          <!--begin:Menu item-->
                          {{-- <div class="menu-item">
                                    <!--begin:Menu content-->
                                    <div class="menu-content">
                                        <div class="menu-separator"></div>
                                    </div>
                                    <!--end:Menu content-->
                                </div> --}}
                          <!--end:Menu item-->
                          <!--begin:Menu item-->
                          {{-- <div class="menu-item">
                              <!--begin:Menu link-->
                              <a class="menu-link" href="#" data-bs-toggle="modal"
                                  data-bs-target="#kt_modal_create_campaign">
                                  <span class="menu-icon">
                                      <i class="ki-solid ki-plus fs-3"></i>
                                  </span>
                                  <span class="menu-title">Add New</span>
                              </a>
                              <!--end:Menu link-->
                          </div> --}}
                          <!--end:Menu item-->
                          <!--begin:Menu item-->
                          <div class="menu-item flex-grow-1"></div>

                          {{-- <div class="menu-item">
                              <!--begin:Menu content-->
                              <div class="menu-content">
                                  <div class="menu-separator"></div>
                              </div>
                              <!--end:Menu content-->
                          </div> --}}
                          <!--end:Menu item-->
                          <!--begin:Menu item-->

                          <!--end:Menu item-->
                      </div>
                      <!--end::Menu-->
                  </div>
              </div>
              <div class="app-header-secondary-menu-sub d-flex align-items-stretch flex-grow-1">

              </div>
          </div>
          <!--end::Header secondary wrapper-->
      </div>
      <!--end::Header secondary-->
  </div>

  <div class="modal fade" tabindex="-1" id="kt_modal_1"aria-modal="true" role="dialog">
      <div class="modal-dialog modal-dialog-centered mw-650px">
          <div class="modal-content blockui" id="kt_block_ui_4_target" style="">
              <div class="modal-header">
                  <h4 class="modal-title">Change Password</h4>
                  <!--begin::Close-->
                  <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                      aria-label="Close">
                      <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/metronic/docs/core/html/src/media/icons/duotune/arrows/arr011.svg-->
                      <span class="svg-icon svg-icon-muted svg-icon-2qx"><svg width="24" height="24"
                              viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.3"
                                  d="M6 19.7C5.7 19.7 5.5 19.6 5.3 19.4C4.9 19 4.9 18.4 5.3 18L18 5.3C18.4 4.9 19 4.9 19.4 5.3C19.8 5.7 19.8 6.29999 19.4 6.69999L6.7 19.4C6.5 19.6 6.3 19.7 6 19.7Z"
                                  fill="currentColor" />
                              <path
                                  d="M18.8 19.7C18.5 19.7 18.3 19.6 18.1 19.4L5.40001 6.69999C5.00001 6.29999 5.00001 5.7 5.40001 5.3C5.80001 4.9 6.40001 4.9 6.80001 5.3L19.5 18C19.9 18.4 19.9 19 19.5 19.4C19.3 19.6 19 19.7 18.8 19.7Z"
                                  fill="currentColor" />
                          </svg>
                      </span>
                      <!--end::Svg Icon-->
                  </div>
                  <!--end::Close-->
              </div>

              <div class="modal-body py-lg-10 px-lg-20">
                  <!--begin:Form-->
                  <form class="form" action="#" method="post">
                      @csrf
                      <!--begin::Input group-->
                      <div class="d-flex flex-column mb-8 fv-row ">
                          <!--begin::Label-->
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                              <span class="required">Current Password</span>
                          </label>
                          <!--end::Label-->
                          <div data-kt-password-meter="true" class="position-relative ">
                              <input type="password" class="form-control form-control-solid"
                                  placeholder="Enter Current Password" name="curr_pass" id="curr_pass">
                              <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                  data-kt-password-meter-control="visibility">
                                  <i class="bi bi-eye-slash fs-2"></i>

                                  <i class="bi bi-eye fs-2 d-none"></i>
                              </span>
                          </div>
                      </div>
                      <span class="text-danger" id="error_msg_curr_pass"></span>
                      <!--end::Input group-->
                      <!--begin::Input group-->
                      <div class="d-flex flex-column mb-8 fv-row">
                          <!--begin::Label-->
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                              <span class="required">New Password</span>
                          </label>
                          <!--end::Label-->
                          <div data-kt-password-meter="true" class="position-relative ">
                              <input type="password" class="form-control form-control-solid"
                                  placeholder="Enter New Password" name="new_pass" id="new_pass">
                              <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                  data-kt-password-meter-control="visibility">
                                  <i class="bi bi-eye-slash fs-2"></i>

                                  <i class="bi bi-eye fs-2 d-none"></i>
                              </span>
                          </div>
                      </div>
                      <span class="text-danger" id="error_msg_new_pass"></span>
                      <!--end::Input group-->
                      <!--begin::Input group-->
                      <div class="d-flex flex-column mb-8 fv-row">
                          <!--begin::Label-->
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                              <span class="required">Confirm Password</span>
                          </label>
                          <!--end::Label-->
                          <div data-kt-password-meter="true" class="position-relative ">
                              <input type="password" class="form-control form-control-solid"
                                  placeholder="Enter Confirm Password" name="confirm_pass" id="confirm_pass">
                              <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                  data-kt-password-meter-control="visibility">
                                  <i class="bi bi-eye-slash fs-2"></i>

                                  <i class="bi bi-eye fs-2 d-none"></i>
                              </span>
                          </div>
                      </div>
                      <span class="text-danger" id="error_msg_confirm_pass"></span>

                      <!--end::Input group-->
                      <div class="text-center">
                          <button class="btn btn-light me-3" data-bs-dismiss="modal">
                              Cancel
                          </button>

                          <button id="kt_block_ui_4_button" class="btn btn-primary">
                              Change Password
                          </button>
                      </div>
                  </form>
                  <!--begin::Actions-->

                  <!--end::Actions-->
                  <!--end:Form-->
              </div>
          </div>
      </div>
  </div>
