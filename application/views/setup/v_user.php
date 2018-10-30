
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>User List</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum suscipit itaque hic laborum, quia maxime similique maiores dolorem error.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header text-right">
                                <button type="button" class="btn btn-sm btn-primary" id="add-data">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-success" id="reload-data">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>

                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover" id="table-data">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>Divisi</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>

                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>Divisi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User -->
            <div class="modal fade" id="modal-data" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="modalLabel">Modal Title</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <span id="info"></span>

                            <form id="form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="userid">User ID</label>
                                        <input type="text" name="userid" class="form-control form-control-sm" id="userid" placeholder="[Auto]" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control form-control-sm" id="username" placeholder="Username">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="userpass">Password</label>
                                        <input type="password" name="userpass" class="form-control form-control-sm" id="userpass" placeholder="Password">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-sm btn-primary" id="save-data">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- end page-content -->
    </div>
    <!-- page-wrapper -->
