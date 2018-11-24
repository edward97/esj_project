
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Transaction</li>
                            <li class="breadcrumb-item"><a href="<?=site_url('transaction/po')?>">Purchase Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?=ucfirst(gt_uri(4))?></li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <form id="form-data">
                        <div class="card-header">
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-info" id="edit-data"><i class="fas fa-edit"></i> Edit</button>
                                <button type="button" class="btn btn-sm btn-secondary queen" id="save-data"><i class="far fa-save"></i> Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="po-id">Po ID</label>
                                            <input type="text" name="po-id" class="form-control form-control-sm" id="po-id" value="<?=gt_uri('5')?>" placeholder="[Auto]" readonly>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="po-date" class="required">Date</label>
                                            <input type="text" name="po-date" data-type="date" class="form-control form-control-sm queen" id="po-date" placeholder="Date">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="supplier-id" class="required">Supplier</label>
                                            <input type="text" name="supplier-id" class="form-control form-control-sm ui-supplier queen" id="supplier-id" placeholder="Supplier">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="warehouse-id" class="required">Warehouse</label>
                                            <input type="text" name="warehouse-id" class="form-control form-control-sm ui-warehouse queen" id="warehouse-id" placeholder="Warehouse">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-5">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control form-control-sm queen" id="description" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="table-detail" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item ID</th>
                                            <th>Itemname</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>
                            </div>
                            <button type="button" data-action="add" class="btn btn-custom btn-success queen"><i class="fas fa-plus"></i> Add Row</button>

                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table" style="margin-top: 1rem">
                                        <tbody>
                                            <tr>
                                                <td>Grand Total : Rp</td>
                                                <td id="grandtotal">0,00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <!-- end page-content -->
    </div>
    <!-- page-wrapper -->
