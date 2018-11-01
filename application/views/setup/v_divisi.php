
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Divisi List</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum suscipit itaque hic laborum, quia maxime similique maiores dolorem error.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header text-right">
                                <button type="button" class="btn btn-sm btn-success" data-add="">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-info" id="reload-data">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>

                            <div class="card-body">
                                <table class="table table-sm table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 15px;">#</th>
                                            <th>Divisi ID</th>
                                            <th>Divisi</th>
                                            <th style="width: 50px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>

                                    <tfoot>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Divisi ID</th>
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

            <!-- Divisi -->
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
                                        <label for="divisi-id">Divisi ID</label>
                                        <input type="text" name="divisi-id" class="form-control form-control-sm" id="divisi-id" placeholder="[Auto]" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="divisi-nm" class="required">Divisi</label>
                                        <input type="text" name="divisi-nm" class="form-control form-control-sm" id="divisi-nm" placeholder="Divisi">
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