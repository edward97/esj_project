
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Form Edit</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magni, eaque! Quas voluptatem est perferendis cum saepe.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Form Edit</li>
                        </ol>
                    </div>

                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header clearfix">
                                <div class="float-left">
                                    <i class="fas fa-angle-right"></i> Form Edit List
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
                                                <th>Date</th>
                                                <th>Formedit ID</th>
                                                <th>Username</th>
                                                <th>No. Transaksi</th>
                                                <th>Permintaan</th>
                                                <th style="width: 50px;">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody></tbody>

                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Formedit ID</th>
                                                <th>Username</th>
                                                <th>No. Transaksi</th>
                                                <th>Permintaan</th>
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
                                    <div class="form-group col-md-4">
                                        <label for="formedit-id">Formedit ID</label>
                                        <input type="text" name="formedit-id" class="form-control form-control-sm" id="formedit-id" placeholder="[Auto]" readonly>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="user-id" class="required">User ID</label>
                                        <input type="text" name="user-id" class="form-control form-control-sm ui-user" id="user-id" placeholder="User ID">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="formedit-date" class="required">Date</label>
                                        <input type="text" name="formedit-date" data-type="date" class="form-control form-control-sm queen" id="formedit-date" placeholder="Date">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="permintaan-id" class="required">Permintaan ID</label>
                                        <input type="text" name="permintaan-id" class="form-control form-control-sm ui-permintaan" id="permintaan-id" placeholder="Permintaan ID">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="no-transaksi" class="required">No. Transaksi</label>
                                        <input type="text" name="no-transaksi" class="form-control form-control-sm" id="no-transaksi" placeholder="No. Transaksi">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="description" class="required">Keterangan</label>
                                        <textarea name="description" class="form-control form-control-sm" id="description" rows="7"></textarea>
                                    </div>
                                </div>
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
