
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Purchase Order</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum suscipit itaque hic laborum, quia maxime similique maiores dolorem error.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Setup</li>
                            <li class="breadcrumb-item active" aria-current="page">Purchase Order</li>
                        </ol>
                    </div>

                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header clearfix">
                                <div class="float-left">
                                    <i class="fas fa-angle-right"></i> Purchase Order List
                                </div>
                                
                                <div class="float-right">
                                    <a href="javascript:;" class="badge badge-success" data-add=""><i class="fas fa-plus"></i></a>
                                    <a href="javascript:;" class="badge badge-info" id="reload-data"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-sm table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 15px;">#</th>
                                            <th>Po ID</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Warehouse</th>
                                            <th>Description</th>
                                            <th style="width: 50px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>

                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Po ID</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Warehouse</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-data" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
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
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="po-id">Po ID</label>
                                                <input type="text" name="po-id" class="form-control form-control-sm" id="po-id" placeholder="[Auto]" readonly>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="po-date" class="required">Date</label>
                                                <input type="text" name="po-date" class="form-control form-control-sm" id="po-date" placeholder="Date">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="supplier-id" class="required">Supplier</label>
                                                <input type="text" name="supplier-id" class="form-control form-control-sm ui-supplier" id="supplier-id" placeholder="Supplier">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="warehouse-id" class="required">Warehouse</label>
                                                <input type="text" name="warehouse-id" class="form-control form-control-sm ui-warehouse" id="warehouse-id" placeholder="Warehouse">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="description" class="required">Description</label>
                                        <textarea name="description" class="form-control form-control-sm" id="description" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="row"><div class="col-md-12"><div class="bg-light">&nbsp;</div></div></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="detail-item">
                                                <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Item ID</td>
                                                        <td>Itemname</td>
                                                        <td>Qty</td>
                                                        <td>Rate</td>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr id="row-1">
                                                        <td><a href="javascript:;" data-action="delete" class="form-control form-control-sm text-danger"><i class="far fa-trash-alt"></i></a></td>
                                                        <td><input type="text" name="detail-id[]" class="form-control form-control-sm ui-item" id="detail-id-1"></td>
                                                        <td><input type="text" name="detail-name[]" class="form-control form-control-sm" id="detail-name-1"></td>
                                                        <td><input type="number" name="detail-qty[]" class="form-control form-control-sm" id="detail-qty-1"></td>
                                                        <td><input type="text" name="detail-rate[]" class="form-control form-control-sm" id="detail-rate-1"></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <a href="javascript:;" data-action="add" class="badge badge-success"><i class="fas fa-plus"></i> Add Row</a>
                                        </div>
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