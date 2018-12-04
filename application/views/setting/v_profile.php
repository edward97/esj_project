
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="float-left">
                                    <ul class="list-custom">
                                        <li class="list-custom-item"><i class="fas fa-user fa-sm"></i> <?=$this->session->userdata('ses_nm')?></li>
                                    </ul>
                                </div>
                                
                                <div class="float-right">
                                    <button type="button" class="btn btn-custom btn-secondary" id="save-data" disabled><i class="far fa-save"></i> Save</button>
                                    <button type="button" class="btn btn-custom btn-info" id="edit-data"><i class="fas fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-custom btn-danger" id="cancel-data" disabled><i class="fas fa-times"></i> Cancel</button>
                                </div>
                            </div>

                            <div class="card-body">
                                <form id="form-data">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="user-id">User ID</label>
                                            <input type="text" name="user-id" class="form-control form-control-sm" id="user-id" placeholder="[Auto]" readonly>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="divisi-nm">Divisi</label>
                                            <input type="text" name="divisi-nm" class="form-control form-control-sm" id="divisi-nm" placeholder="Divisi" readonly>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="user-nm" class="required">Username</label>
                                            <input type="text" name="user-nm" data-en="1" class="form-control form-control-sm" id="user-nm" placeholder="Username">
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="user-pass" class="required">Password</label>
                                            <input type="password" name="user-pass" data-en="1" class="form-control form-control-sm" id="user-pass" placeholder="Password">
                                        </div>
                                    </div>
                                    <input type="hidden" name="divisi-id" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <i class="fas fa-air-freshener"></i> Themes
                            </div>
                            
                            <div class="card-body">
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
