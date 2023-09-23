<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/92r3n749ctkx906afyu5f7825thupunu7wg8hu5x7z03ykob/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
              selector: 'textarea',
              plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
    </script>

    @yield('styles')
    <style>
        /*
        CSS for support pages.
        */
        .list-group-item-transparent {
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-light-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-light-border-subtle);
            --bs-list-group-active-color: var(--bs-light-bg-subtle);
            --bs-list-group-active-bg: var(--bs-light-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-light-text-emphasis);
        }


        #page-sidebar {
            --sp-sidebar-width: 250px;
        }


        .btn-invisible-bg {
            background-color: transparent;
        }


        .list-group-item a {
            color: inherit;
            text-decoration: none;
        }

        .list-group-item-transparent {
            background-color: transparent;
        }


        #page-content-wrapper {
            min-height: 100vh;
            width: 100%;
        }


        #page-sidebar {
            max-width: var(--sp-sidebar-width);
            min-height: 100vh;
            min-width: var(--sp-sidebar-width);
            transition: all .3s;
        }

        #page-sidebar {
            margin-left: calc(var(--sp-sidebar-width) * -1);
        }

        #page-sidebar.active {
            margin-left: 0;
        }

        @media (min-width: 992px) {

            #page-sidebar,
            #page-sidebar.active {
                margin-left: 0;
            }
        }


        #page-topbar,
        #sidebar-header {
            height: 50px;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script>
    /**
     * Support pages JS.
     *
     * @author Vee W.
     */


    class SupportScript {


    /**
     * Listen on click side bar toggler button.
     */
    #listenClickSidebarToggler() {
        const targetBtnId = 'btn-toggle-sidebar';

        document.addEventListener('click', (event) => {
            let thisTarget = event.target;
            if (thisTarget.closest('button')) {
                thisTarget = thisTarget.closest('button');
            }

            if (thisTarget.getAttribute('id') === targetBtnId) {
                event.preventDefault();
                thisTarget.classList.toggle('active');
                document.getElementById('page-sidebar')?.classList.toggle('active');
            }
        });
    }// #listenClickSidebarToggler


    /**
     * Initialize the script.
     */
    run() {
        this.#listenClickSidebarToggler();
    }// run


    }// SupportScript


    document.addEventListener('DOMContentLoaded', () => {
    const supportScriptObj = new SupportScript();
    supportScriptObj.run();
    });
</script>

</html>