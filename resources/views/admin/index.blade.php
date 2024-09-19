<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Title -->
    <title>WILDBERRIES</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.ico" />

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo asset('assets/vendor/bootstrap-icons/font/bootstrap-icons.css') ?>" />

    <link rel="stylesheet" href="<?php echo asset('assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css') ?>" />

    <!-- CSS Front Template -->

    <link rel="preload" href="<?php echo asset('assets/css/theme.min.css') ?>" data-hs-appearance="default"
        as="style" />
    <link rel="preload" href="<?php echo asset('assets/css/theme-dark.min.css') ?>" data-hs-appearance="dark"
        as="style" />

    <style data-hs-appearance-onload-styles>
        * {
            transition: unset !important;
        }

        body {
            opacity: 0;
        }
    </style>

    <script>
        window.hs_config = {
            autopath: "@@autopath",
            deleteLine: "hs-builder:delete",
            "deleteLine:build": "hs-builder:build-delete",
            "deleteLine:dist": "hs-builder:dist-delete",
            previewMode: false,
            startPath: "/index.html",
            vars: {
                themeFont:
                    "https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap",
                version: "?v=1.0",
            },
            layoutBuilder: {
                extend: { switcherSupport: true },
                header: {
                    layoutMode: "default",
                    containerMode: "container-fluid",
                },
                sidebarLayout: "default",
            },
            themeAppearance: {
                layoutSkin: "default",
                sidebarSkin: "default",
                styles: {
                    colors: {
                        primary: "#377dff",
                        transparent: "transparent",
                        white: "#fff",
                        dark: "132144",
                        gray: { 100: "#f9fafc", 900: "#1e2022" },
                    },
                    font: "Inter",
                },
            },
            languageDirection: { lang: "en" },
            skipFilesFromBundle: {
                dist: [
                    "<?php echo asset('assets/js/hs.theme-appearance.js') ?>",
                    "<?php echo asset('assets/js/hs.theme-appearance-charts.js') ?>",
                    "<?php echo asset('assets/js/demo.js') ?>",
                ],
                build: [
                    "<?php echo asset('assets/css/theme.css') ?>",
                    "<?php echo asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') ?>",
                    "<?php echo asset('assets/js/demo.js') ?>",
                    "<?php echo asset('assets/css/theme-dark.css') ?>",
                    "<?php echo asset('assets/css/docs.css') ?>",
                    "<?php echo asset('assets/vendor/icon-set/style.css') ?>",
                    "<?php echo asset('assets/js/hs.theme-appearance.js') ?>",
                    "<?php echo asset('assets/js/hs.theme-appearance-charts.js') ?>",
                    "node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js",
                    "<?php echo asset('assets/js/demo.js') ?>",
                ],
            },
            minifyCSSFiles: [
                "<?php echo asset('assets/css/theme.css') ?>",
                "<?php echo asset('assets/css/theme-dark.css') ?>",
            ],
            copyDependencies: {
                dist: { "*assets/js/theme-custom.js": "" },
                build: {
                    "*assets/js/theme-custom.js": "",
                    "node_modules/bootstrap-icons/font/*fonts/**":
                        "assets/css",
                },
            },
            buildFolder: "",
            replacePathsToCDN: {},
            directoryNames: {
                src: "./src",
                dist: "./dist",
                build: "./build",
            },
            fileNames: {
                dist: { js: "theme.min.js", css: "theme.min.css" },
                build: {
                    css: "theme.min.css",
                    js: "theme.min.js",
                    vendorCSS: "vendor.min.css",
                    vendorJS: "vendor.min.js",
                },
            },
            fileTypes: "jpg|png|svg|mp4|webm|ogv|json",
        };
        window.hs_config.gulpRGBA = (p1) => {
            const options = p1.split(",");
            const hex = options[0].toString();
            const transparent = options[1].toString();

            var c;
            if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
                c = hex.substring(1).split("");
                if (c.length == 3) {
                    c = [c[0], c[0], c[1], c[1], c[2], c[2]];
                }
                c = "0x" + c.join("");
                return (
                    "rgba(" +
                    [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(",") +
                    "," +
                    transparent +
                    ")"
                );
            }
            throw new Error("Bad Hex");
        };
        window.hs_config.gulpDarken = (p1) => {
            const options = p1.split(",");

            let col = options[0].toString();
            let amt = -parseInt(options[1]);
            var usePound = false;

            if (col[0] == "#") {
                col = col.slice(1);
                usePound = true;
            }
            var num = parseInt(col, 16);
            var r = (num >> 16) + amt;
            if (r > 255) {
                r = 255;
            } else if (r < 0) {
                r = 0;
            }
            var b = ((num >> 8) & 0x00ff) + amt;
            if (b > 255) {
                b = 255;
            } else if (b < 0) {
                b = 0;
            }
            var g = (num & 0x0000ff) + amt;
            if (g > 255) {
                g = 255;
            } else if (g < 0) {
                g = 0;
            }
            return (
                (usePound ? "#" : "") +
                (g | (b << 8) | (r << 16)).toString(16)
            );
        };
        window.hs_config.gulpLighten = (p1) => {
            const options = p1.split(",");

            let col = options[0].toString();
            let amt = parseInt(options[1]);
            var usePound = false;

            if (col[0] == "#") {
                col = col.slice(1);
                usePound = true;
            }
            var num = parseInt(col, 16);
            var r = (num >> 16) + amt;
            if (r > 255) {
                r = 255;
            } else if (r < 0) {
                r = 0;
            }
            var b = ((num >> 8) & 0x00ff) + amt;
            if (b > 255) {
                b = 255;
            } else if (b < 0) {
                b = 0;
            }
            var g = (num & 0x0000ff) + amt;
            if (g > 255) {
                g = 255;
            } else if (g < 0) {
                g = 0;
            }
            return (
                (usePound ? "#" : "") +
                (g | (b << 8) | (r << 16)).toString(16)
            );
        };
    </script>
</head>

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">
    <script src="<?php echo asset('assets/js/hs.theme-appearance.js') ?>"></script>

    <script
        src="<?php echo asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') ?>"></script>

    <!-- ========== HEADER ========== -->

    <header id="header"
        class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
        <div class="navbar-nav-wrap">
            <!-- Logo -->
            <a class="navbar-brand" href="./index.html" aria-label="Front">
                <img class="navbar-brand-logo" src="<?php echo asset('assets/svg/logos/logo.svg') ?>" alt="Logo"
                    data-hs-theme-appearance="default" />
                <img class="navbar-brand-logo" src="<?php echo asset('assets/svg/logos-light/logo.svg') ?>" alt="Logo"
                    data-hs-theme-appearance="dark" />
                <img class="navbar-brand-logo-mini" src="<?php echo asset('assets/svg/logos/logo-short.svg') ?>"
                    alt="Logo" data-hs-theme-appearance="default" />
                <img class="navbar-brand-logo-mini" src="<?php echo asset('assets/svg/logos-light/logo-short.svg') ?>"
                    alt="Logo" data-hs-theme-appearance="dark" />
            </a>
            <!-- End Logo -->

            <div class="navbar-nav-wrap-content-end">
                <!-- Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <!-- Account -->
                        <div class="dropdown">
                            <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                                data-bs-dropdown-animation style="padding: 10px">
                                <h5 class="mb-0">Admin</h5>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                                aria-labelledby="accountNavbarDropdown" style="width: 16rem">
                                <div class="dropdown-item-text">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mb-0">
                                                Admin
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="<?php echo route("admin.logout") ?>">Sign out</a>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
        </div>
    </header>

    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <!-- Navbar Vertical -->

    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset">
                <!-- Logo -->

                <a class="navbar-brand" href="./index.html" aria-label="Front">
                    <img class="navbar-brand-logo" src="<?php echo asset('assets/svg/logos/logo.svg') ?>" alt="Logo"
                        data-hs-theme-appearance="default" />
                    <img class="navbar-brand-logo" src="<?php echo asset('assets/svg/logos-light/logo.svg') ?>"
                        alt="Logo" data-hs-theme-appearance="dark" />
                    <img class="navbar-brand-logo-mini" src="<?php echo asset('assets/svg/logos/logo-short.svg') ?>"
                        alt="Logo" data-hs-theme-appearance="default" />
                    <img class="navbar-brand-logo-mini"
                        src="<?php echo asset('assets/svg/logos-light/logo-short.svg') ?>" alt="Logo"
                        data-hs-theme-appearance="dark" />
                </a>

                <!-- End Logo -->

                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                    <i class="bi-arrow-bar-left navbar-toggler-short-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                    <i class="bi-arrow-bar-right navbar-toggler-full-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
                </button>

                <!-- End Navbar Vertical Toggle -->

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                        <span class="dropdown-header mt-4">Страницы</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>

                        <!-- Collapse -->
                        <div class="navbar-nav nav-compact"></div>
                        <div id="navbarVerticalMenuPagesMenu">
                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link active" href="{{ route("admin.products") }}" role="button"
                                    
                                    aria-expanded="true" aria-controls="navbarVerticalMenuPagesUsersMenu">
                                    <i class="bi-people nav-icon"></i>
                                    <span class="nav-link-title">Товары</span>
                                </a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route("admin.categories") }}" role="button"
                                    
                                    aria-expanded="true" aria-controls="navbarVerticalMenuPagesUsersMenu">
                                    <i class="bi-people nav-icon"></i>
                                    <span class="nav-link-title">Категории</span>
                                </a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route("admin.settings") }}" role="button"
                                    
                                    aria-expanded="true" aria-controls="navbarVerticalMenuPagesUsersMenu">
                                    <i class="bi-gear nav-icon"></i>
                                    <span class="nav-link-title">Настройки</span>
                                </a>
                            </div>
                            <!-- End Collapse -->
                        </div>
                        <!-- End Collapse -->
                    </div>
                </div>
                <!-- End Content -->

                <!-- Footer -->
                <div class="navbar-vertical-footer">
                    <ul class="navbar-vertical-footer-list">
                        <li class="navbar-vertical-footer-list-item">
                            <!-- Style Switcher -->
                            <div class="dropdown dropup">
                                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                                    id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                    data-bs-dropdown-animation></button>

                                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless"
                                    aria-labelledby="selectThemeDropdown">
                                    <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                                        <i class="bi-moon-stars me-2"></i>
                                        <span class="text-truncate" title="Auto (system default)">Auto (system
                                            default)</span>
                                    </a>
                                    <a class="dropdown-item" href="#" data-icon="bi-brightness-high"
                                        data-value="default">
                                        <i class="bi-brightness-high me-2"></i>
                                        <span class="text-truncate" title="Default (light mode)">Default (light
                                            mode)</span>
                                    </a>
                                    <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                                        <i class="bi-moon me-2"></i>
                                        <span class="text-truncate" title="Dark">Dark</span>
                                    </a>
                                </div>
                            </div>

                            <!-- End Style Switcher -->
                        </li>
                    </ul>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    </aside>

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Главная</h1>
                    </div>
                    <!-- End Col -->


                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="<?php echo route("admin.products")?>">
                        <div class="card-body">
                            <h2 class="card-title text-inherit">Товары</h2>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="<?php echo route("admin.categories")?>">
                        <div class="card-body">
                            <h2 class="card-title text-inherit">Категории</h2>


                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="<?php echo route("admin.settings")?></a>">
                        <div class="card-body">
                            <h2 class="card-title text-inherit">Настройки</h2>


                        </div>
                    </a>
                    <!-- End Card -->
                </div>


            </div>


        </div>
        <!-- End Content -->

        <!-- Footer -->

        <!-- End Footer -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== SECONDARY CONTENTS ========== -->





    <!-- End Welcome Message Modal -->

    <!-- Edit user -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">
                        Редактировать валюту
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="tab-content" id="editUserModalTabContent">
                        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="profile-tab">
                            <form enctype="multipart/form-data" id="editCurrencyForm" method="POST">

                                @csrf

                                @method('PUT') <!-- Используйте PUT метод для обновления -->


                                <input type="hidden" name="id" id="currencyId" />
                                <div class="row mb-4">
                                    <label for="addNameCurrency" class="col-sm-3 col-form-label form-label">Имя товара
                                        <i class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Displayed on public forums, such as Front."></i></label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <input type="text" class="form-control" name="name" id="addNameCurrency"
                                                placeholder="Имя валюты" aria-label="Имя валюты" value="" />
                                            <input type="text" class="form-control" name="min_name"
                                                id="addShortNameCurrency" placeholder="Короткое имя валюты"
                                                aria-label="Короткое имя валюты" value="" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="addCurrencyRate" class="col-sm-3 col-form-label form-label">Курс в
                                        $</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="currency_to_dollar"
                                            id="addCurrencyRate" placeholder="Курс в $" aria-label="Курс в $"
                                            value="" />
                                    </div>
                                </div>
                                <!-- End Form -->
                                <div class="row mb-4">
                                    <label for="addPhotoCurrency" class="col-sm-3 col-form-label form-label">Лого
                                        валюты</label>

                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="photo" id="addPhotoCurrency"
                                            placeholder="Лого валюты" aria-label="Лого валюты" value="" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addAvailability"
                                        class="col-sm-3 col-form-label form-label">Наличие</label>

                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="availability"
                                            id="addAvailability" placeholder="Наличие" aria-label="Наличие" value="" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addMaxCurrency" class="col-sm-3 col-form-label form-label">Макс/Мин
                                        <i class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Displayed on public forums, such as Front."></i></label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <input type="text" class="form-control" name="min" id="addMinCurrency"
                                                placeholder="Минимально" aria-label="Минимально" value="" />
                                            <input type="text" class="form-control" name="max" id="addMaxCurrency"
                                                placeholder="Максимально" aria-label="Максимально" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addAddress" class="col-sm-3 col-form-label form-label">Адрес</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address" id="addAddress"
                                            placeholder="Адрес" aria-label="Адрес" value="" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addQrCode" class="col-sm-3 col-form-label form-label">QR-Code</label>

                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="qr_code" id="addQrCode"
                                            placeholder="QR-Code" aria-label="QR-Code" value="" />

                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addAddress" class="col-sm-3 col-form-label form-label">Тип
                                        валюты</label>

                                    <div class="col-sm-9">
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select" autocomplete="off" name="type"
                                                data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                                                <option value="Криптовалюта" selected>Криптовалюта</option>
                                                <option value="Банк">Банк</option>
                                                <option value="Наличные">Наличные</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex gap-3">
                                        <button type="button" class="btn btn-white" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            Закрыть
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Добавить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Body -->
            </div>
        </div>
    </div>
    <!-- End Edit user -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">
                        Добавить валюту
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="tab-content" id="addUserModalTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <form enctype="multipart/form-data" action="" method="POST">
                                <!-- Form -->
                                @csrf
                                <div class="row mb-4">
                                    <label for="addNameCurrency" class="col-sm-3 col-form-label form-label">Имя валюты
                                        <i class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Displayed on public forums, such as Front."></i></label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <input type="text" required class="form-control" name="name"
                                                id="addNameCurrency" placeholder="Имя валюты" aria-label="Имя валюты"
                                                value="" />
                                            <input type="text" required class="form-control" name="min_name"
                                                id="addShortNameCurrency" placeholder="Короткое имя валюты"
                                                aria-label="Короткое имя валюты" value="" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="addCurrencyRate" class="col-sm-3 col-form-label form-label">Курс в
                                        $</label>

                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" name="currency_to_dollar"
                                            id="addCurrencyRate" placeholder="Курс в $" aria-label="Курс в $"
                                            value="" />
                                    </div>
                                </div>
                                <!-- End Form -->
                                <div class="row mb-4">
                                    <label for="addPhotoCurrency" class="col-sm-3 col-form-label form-label">Лого
                                        валюты</label>

                                    <div class="col-sm-9">
                                        <input type="file" required class="form-control" name="photo"
                                            id="addPhotoCurrency" placeholder="Лого валюты" aria-label="Лого валюты"
                                            value="" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addAvailability"
                                        class="col-sm-3 col-form-label form-label">Наличие</label>

                                    <div class="col-sm-9">
                                        <input type="number" required class="form-control" name="availability"
                                            id="addAvailability" placeholder="Наличие" aria-label="Наличие" value="" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addMaxCurrency" class="col-sm-3 col-form-label form-label">Макс/Мин
                                        <i class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Displayed on public forums, such as Front."></i></label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <input type="text" required class="form-control" name="min"
                                                id="addMinCurrency" placeholder="Минимально" aria-label="Минимально"
                                                value="" />
                                            <input type="text" required class="form-control" name="max"
                                                id="addMaxCurrency" placeholder="Максимально" aria-label="Максимально"
                                                value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addAddress" class="col-sm-3 col-form-label form-label">Адрес</label>

                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" name="address" id="addAddress"
                                            placeholder="Адрес" aria-label="Адрес" value="" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addQrCode" class="col-sm-3 col-form-label form-label">QR-Code</label>

                                    <div class="col-sm-9">
                                        <input type="file" required class="form-control" name="qr_code" id="addQrCode"
                                            placeholder="QR-Code" aria-label="QR-Code" value="" />

                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="addAddress" class="col-sm-3 col-form-label form-label">Тип
                                        валюты</label>

                                    <div class="col-sm-9">
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select" required autocomplete="off"
                                                name="type" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true
                                }'>
                                                <option value="Криптовалюта" selected>Криптовалюта</option>
                                                <option value="Банк">Банк</option>
                                                <option value="Наличные">Наличные</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex gap-3">
                                        <button type="button" class="btn btn-white" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            Закрыть
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Добавить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Body -->
            </div>
        </div>
    </div>
    <!-- ========== END SECONDARY CONTENTS ========== -->

    <!-- JS Global Compulsory  -->
    <script src="<?php echo asset('assets/vendor/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- JS Implementing Plugins -->
    <script
        src="<?php echo asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/hs-form-search/dist/hs-form-search.min.js') ?>"></script>

    <script src="<?php echo asset('assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/hs-file-attach/dist/hs-file-attach.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/hs-nav-scroller/dist/hs-nav-scroller.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/hs-step-form/dist/hs-step-form.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/hs-counter/dist/hs-counter.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/appear/dist/appear.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/imask/dist/imask.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/tom-select/dist/js/tom-select.complete.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/datatables.net.extensions/select/select.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/jszip/dist/jszip.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/pdfmake/build/pdfmake.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/pdfmake/build/vfs_fonts.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?php echo asset('assets/vendor/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>

    <!-- JS Front -->
    <script src="<?php echo asset('assets/js/theme.min.js') ?>"></script>

    <!-- JS Plugins Init. -->
    <script>
        $(document).on("ready", function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            HSCore.components.HSDatatables.init($("#datatable"), {
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "copy",
                        className: "d-none",
                    },
                    {
                        extend: "excel",
                        className: "d-none",
                    },
                    {
                        extend: "csv",
                        className: "d-none",
                    },
                    {
                        extend: "pdf",
                        className: "d-none",
                    },
                    {
                        extend: "print",
                        className: "d-none",
                    },
                ],
                select: {
                    style: "multi",
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: "#datatableCheckAll",
                        counter: "#datatableCounter",
                        counterInfo: "#datatableCounterInfo",
                    },
                },
                language: {
                    zeroRecords: `<div class="text-center p-4">
              <img class="mb-3" src="<?php echo asset('assets/svg/illustrations/oc-error.svg') ?>" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
              <img class="mb-3" src="<?php echo asset('assets/svg/illustrations-light/oc-error.svg') ?>" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
            <p class="mb-0">Нет данных</p>
            </div>`,
                },
            });

            const datatable = HSCore.components.HSDatatables.getItem(0);

            $("#export-copy").click(function () {
                datatable.button(".buttons-copy").trigger();
            });

            $("#export-excel").click(function () {
                datatable.button(".buttons-excel").trigger();
            });

            $("#export-csv").click(function () {
                datatable.button(".buttons-csv").trigger();
            });

            $("#export-pdf").click(function () {
                datatable.button(".buttons-pdf").trigger();
            });

            $("#export-print").click(function () {
                datatable.button(".buttons-print").trigger();
            });

            $(".js-datatable-filter").on("change", function () {
                var $this = $(this),
                    elVal = $this.val(),
                    targetColumnIndex = $this.data("target-column-index");

                if (elVal === "null") elVal = "";

                datatable.column(targetColumnIndex).search(elVal).draw();
            });
        });
    </script>

    <!-- JS Plugins Init. -->
    <script>
        (function () {
            window.onload = function () {
                // INITIALIZATION OF NAVBAR VERTICAL ASIDE
                // =======================================================
                new HSSideNav(".js-navbar-vertical-aside").init();

                // INITIALIZATION OF FORM SEARCH
                // =======================================================
                new HSFormSearch(".js-form-search");

                // INITIALIZATION OF BOOTSTRAP DROPDOWN
                // =======================================================
                HSBsDropdown.init();

                // INITIALIZATION OF SELECT
                // =======================================================
                HSCore.components.HSTomSelect.init(".js-select");

                // INITIALIZATION OF INPUT MASK
                // =======================================================
                HSCore.components.HSMask.init(".js-input-mask");

                // INITIALIZATION OF NAV SCROLLER
                // =======================================================
                new HsNavScroller(".js-nav-scroller");

                // INITIALIZATION OF COUNTER
                // =======================================================
                new HSCounter(".js-counter");

                // INITIALIZATION OF TOGGLE PASSWORD
                // =======================================================
                new HSTogglePassword(".js-toggle-password");

                // INITIALIZATION OF FILE ATTACHMENT
                // =======================================================
                new HSFileAttach(".js-file-attach");
            };
        })();
    </script>

    <!-- Style Switcher JS -->

    <script>
        (function () {
            // STYLE SWITCHER
            // =======================================================
            const $dropdownBtn = document.getElementById(
                "selectThemeDropdown"
            ); // Dropdowon trigger
            const $variants = document.querySelectorAll(
                `[aria-labelledby="selectThemeDropdown"] [data-icon]`
            ); // All items of the dropdown

            // Function to set active style in the dorpdown menu and set icon for dropdown trigger
            const setActiveStyle = function () {
                $variants.forEach(($item) => {
                    if (
                        $item.getAttribute("data-value") ===
                        HSThemeAppearance.getOriginalAppearance()
                    ) {
                        $dropdownBtn.innerHTML = `<i class="${$item.getAttribute(
                            "data-icon"
                        )}" />`;
                        return $item.classList.add("active");
                    }

                    $item.classList.remove("active");
                });
            };

            // Add a click event to all items of the dropdown to set the style
            $variants.forEach(function ($item) {
                $item.addEventListener("click", function () {
                    HSThemeAppearance.setAppearance(
                        $item.getAttribute("data-value")
                    );
                });
            });

            // Call the setActiveStyle on load page
            setActiveStyle();

            // Add event listener on change style to call the setActiveStyle function
            window.addEventListener("on-hs-appearance-change", function () {
                setActiveStyle();
            });
        })();
    </script>

    <!-- End Style Switcher JS -->
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editButtons = document.querySelectorAll('.edit-currency-btn');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var modalForm = document.getElementById('editCurrencyForm');
                var baseUrl = "";
                var currencyId = button.getAttribute('data-id');

                // Заполнение формы
                document.getElementById('currencyId').value = currencyId;
                document.getElementById('addNameCurrency').value = button.getAttribute('data-name');
                document.getElementById('addShortNameCurrency').value = button.getAttribute('data-min_name');
                document.getElementById('addCurrencyRate').value = button.getAttribute('data-currency_to_dollar');
                document.getElementById('addAvailability').value = button.getAttribute('data-availability');
                document.getElementById('addMinCurrency').value = button.getAttribute('data-min');
                document.getElementById('addMaxCurrency').value = button.getAttribute('data-max');
                document.getElementById('addAddress').value = button.getAttribute('data-address');

                // Обновление формы изображения (показываем путь к текущему изображению)
                document.getElementById('addPhotoCurrency').src = button.getAttribute('data-photo');
                document.getElementById('addQrCode').src = button.getAttribute('data-qr_code');

                // Установить выбранный тип валюты
                document.querySelector(`select[name="type"]`).value = button.getAttribute('data-type');

                // Установить правильный action URL для отправки формы
                modalForm.action = baseUrl.replace(':id', currencyId);
            });
        });
    });
</script>