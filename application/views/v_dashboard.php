
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Dashboard template</h2>
                        <p>This is a responsive dashboard template with dropdown menu based on bootstrap 4 framework.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Themes</h5>
                                <p class="card-text">Here are more themes that you can use</p>
                                <div class="form-group">
                                    <a href="javascript:;" data-theme="chiller-theme" class="theme chiller-theme <?=ct_theme('nav_color', 'chiller-theme')?>"></a>
                                    <a href="javascript:;" data-theme="ice-theme" class="theme ice-theme <?=ct_theme('nav_color', 'ice-theme')?>"></a>
                                    <a href="javascript:;" data-theme="cool-theme" class="theme cool-theme <?=ct_theme('nav_color', 'cool-theme')?>"></a>
                                    <a href="javascript:;" data-theme="light-theme" class="theme light-theme <?=ct_theme('nav_color', 'light-theme')?>"></a>
                                </div>

                                <p class="card-text">You can also use background image</p>
                                <div class="form-group">
                                    <a href="javascript:;" data-bg="bg1" class="theme theme-bg <?=ct_theme('nav_bg', 'bg1')?>"></a>
                                    <a href="javascript:;" data-bg="bg2" class="theme theme-bg <?=ct_theme('nav_bg', 'bg2')?>"></a>
                                    <a href="javascript:;" data-bg="bg3" class="theme theme-bg <?=ct_theme('nav_bg', 'bg3')?>"></a>
                                    <a href="javascript:;" data-bg="bg4" class="theme theme-bg <?=ct_theme('nav_bg', 'bg4')?>"></a>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="" id="toggle-bg" <?=ct_theme('nav_status', 'sidebar-bg')?>>Background image
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- end page-content -->
    </div>
    <!-- page-wrapper -->
