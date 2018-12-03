
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow">
                            <div class="card-header clearfix">
                                <div class="float-left">
                                    <ul class="list-custom">
                                        <li class="list-custom-item"><i class="fas fa-cogs fa-sm"></i> Setup</li>
                                        <li class="list-custom-item text-muted"><i class="fas fa-user fa-sm"></i> User</li>
                                    </ul>
                                </div>
                                
                                <div class="float-right">
                                    <a href="javascript:;" class="btn btn-custom btn-success" data-add=""><i class="fas fa-plus"></i></a>
                                    <a href="javascript:;" class="btn btn-custom btn-info" id="reload-data"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px;">#</th>
                                                <th>User ID</th>
                                                <th>Username</th>
                                                <th>Divisi</th>
                                                <th style="width: 50px;">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody></tbody>

                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>User ID</th>
                                                <th>Username</th>
                                                <th>Divisi</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-data" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="modalLabel">Modal Title</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body" id="info">
                            <form id="form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="user-id">User ID</label>
                                        <input type="text" name="user-id" class="form-control form-control-sm" id="user-id" placeholder="[Auto]" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="user-nm" class="required">Username</label>
                                        <input type="text" name="user-nm" class="form-control form-control-sm" id="user-nm" placeholder="Username">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="user-pass" class="required">Password</label>
                                        <input type="password" name="user-pass" class="form-control form-control-sm" id="user-pass" placeholder="Password">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="divisi-nm" class="required">Divisi</label>
                                        <input type="text" name="divisi-nm" class="form-control form-control-sm ui-divisi" id="divisi-nm" placeholder="Divisi">
                                    </div>
                                </div>
                                <input type="hidden" name="divisi-id" value="">
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-sm btn-primary" id="save-data">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- end page-content -->
    </div>
    <!-- page-wrapper -->
