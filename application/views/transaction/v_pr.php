
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <form id="form-data">
                        <div class="card-header clearfix">
                            <div class="float-left">
                                <ul class="list-custom">
                                    <li class="list-custom-item"><i class="fas fa-code-branch fa-sm"></i> Transaction</li>
                                    <li class="list-custom-item text-muted"><i class="fas fa-list fa-sm"></i> Purchase Receipt</li>
                                </ul>
                            </div>
                            
                            <div class="float-right">
                                <div class="box-1">
                                    <button type="button" class="btn btn-sm btn-success" id="new-data"><i class="fas fa-plus"></i> New</button>
                                    <button type="button" class="btn btn-sm btn-info" id="edit-data" disabled><i class="fas fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger" id="delete-data" disabled><i class="far fa-trash-alt"></i> Delete</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="find-data"><i class="fas fa-search"></i> Find</button>
                                </div>

                                <div class="box-2" style="display: none;">
                                    <button type="button" class="btn btn-sm btn-warning" id="cancel-data"><i class="fas fa-times"></i> Cancel</button>
                                    <button type="button" class="btn btn-sm btn-secondary" id="save-data"><i class="far fa-save"></i> Save</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="po-id">Po ID</label>
                                            <input type="text" name="po-id" data-edit="0" class="form-control form-control-sm" id="po-id" placeholder="[Auto]">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="pr-id">Pr ID</label>
                                            <input type="text" name="pr-id" data-edit="0" class="form-control form-control-sm" id="pr-id" placeholder="[Auto]">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="pr-date" class="required">Date</label>
                                            <input type="text" name="pr-date" data-edit="0" data-type="date" class="form-control form-control-sm" id="pr-date" placeholder="Date">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="supplier-nm" class="required">Supplier</label>
                                            <input type="text" name="supplier-nm" data-edit="1" class="form-control form-control-sm ui-supplier" id="supplier-nm" placeholder="Supplier">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="warehouse-nm" class="required">Warehouse</label>
                                            <input type="text" name="warehouse-nm" data-edit="1" class="form-control form-control-sm ui-warehouse" id="warehouse-nm" placeholder="Warehouse">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-5">
                                    <label for="description">Description</label>
                                    <textarea name="description" data-edit="1" class="form-control form-control-sm" id="description" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="table-detail" style="width: 63rem">
                                    <thead>
                                        <tr>
                                            <th style="width: 2rem">#</th>
                                            <th style="width: 7rem">Item ID</th>
                                            <th style="width: 20rem">Itemname</th>
                                            <th style="width: 7rem">Qty</th>
                                            <th style="width: 5rem">Uom</th>
                                            <th style="width: 10rem">Rate</th>
                                            <th style="width: 12rem">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>
                            </div>
                            <button type="button" data-edit="1" class="btn btn-custom btn-success" id="add-row"><i class="fas fa-plus"></i> Add Row</button>

                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table" style="margin-top: 1rem">
                                        <tbody>
                                            <tr>
                                                <td>Grand Total : Rp</td>
                                                <td id="grand-total">0.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="supplier-id" value="">
                        <input type="hidden" name="warehouse-id" value="">
                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-data" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">List Purchase Receipt</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body" id="info">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 15px;">#</th>
                                            <th>Pr ID</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Warehouse</th>
                                            <th style="width: 25px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>

                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Pr ID</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Warehouse</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-info" id="reload-data"><i class="fas fa-sync-alt"></i> Reload</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- end page-content -->
