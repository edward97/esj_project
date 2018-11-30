
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
                                        <li class="list-custom-item text-muted"><i class="fas fa-shapes fa-sm"></i> Permintaan</li>
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
                                                <th>Permintaan ID</th>
                                                <th>Permintaan</th>
                                                <th style="width: 50px;">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody></tbody>

                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Permintaan ID</th>
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
                                    <div class="form-group col-md-6">
                                        <label for="permintaan-id">Permintaan ID</label>
                                        <input type="text" name="permintaan-id" class="form-control form-control-sm" id="permintaan-id" placeholder="[Auto]" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="permintaan-nm" class="required">Permintaan</label>
                                        <input type="text" name="permintaan-nm" class="form-control form-control-sm" id="permintaan-nm" placeholder="Permintaan">
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
