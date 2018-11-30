
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <form id="form-data">
                        <div class="card-header clearfix">
                            <div class="float-left">
                                <ul class="list-custom">
                                    <li class="list-custom-item"><i class="fas fa-code-branch fa-sm"></i> Transaction</li>
                                    <li class="list-custom-item"><a href="<?=site_url('transaction/pr')?>"><i class="fas fa-chart-bar fa-sm"></i> Purchase Receipt</a></li>
                                    <li class="list-custom-item text-muted"><i class="fas fa-list fa-sm"></i> <?=ucfirst(gt_uri(4))?></li>
                                </ul>
                            </div>
                            
                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-info" id="edit-data"><i class="fas fa-edit"></i> Edit</button>
                                <button type="button" class="btn btn-sm btn-secondary queen" id="save-data"><i class="far fa-save"></i> Save</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="pr-id">Pr ID</label>
                                            <input type="text" name="pr-id" class="form-control form-control-sm" id="pr-id" value="<?=gt_uri('5')?>" placeholder="[Auto]" readonly>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="pr-date" class="required">Date</label>
                                            <input type="text" name="pr-date" data-type="date" class="form-control form-control-sm queen" id="pr-date" placeholder="Date">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="po-id" class="required">Po ID</label>
                                            <input type="text" name="po-id" class="form-control form-control-sm ui-po queen" id="po-id" placeholder="Po ID">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="supplier-id" class="required">Supplier</label>
                                            <input type="text" name="supplier-id" class="form-control form-control-sm" id="supplier-id" placeholder="Supplier" readonly>
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

                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="item-id">Item ID</label>
                                    <input list="item-list" name="item-id" class="form-control form-control-sm" id="item-id" disabled>
                                    <datalist id="item-list"></datalist>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="item-nm">Item</label>
                                    <input type="text" name="item-nm" class="form-control form-control-sm" id="item-nm" disabled>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="item-qty">Qty</label>
                                    <input type="text" name="item-qty" class="form-control form-control-sm queen numb" id="item-qty">
                                </div>

                                 <div class="form-group col-md-3">
                                    <label for="item-rate">Rate</label>
                                    <input type="text" name="item-rate" class="form-control form-control-sm numb" id="item-rate" disabled>
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="">&nbsp;</label>
                                    <button type="button" data-action="add" class="btn btn-sm btn-success btn-block queen"><i class="fas fa-plus"></i></button>
                                </div>

                                <input type="hidden" name="po-id-detail" id="po-id-detail">
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
