
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header clearfix">
                                <div class="float-left">
                                    <ul class="list-custom">
                                        <li class="list-custom-item"><i class="fas fa-code-branch fa-sm"></i> Transaction</li>
                                        <li class="list-custom-item text-muted"><i class="fas fa-chart-bar fa-sm"></i> Purchase Receipt</li>
                                    </ul>
                                </div>
                                
                                <div class="float-right">
                                    <a href="javascript:;" class="btn btn-custom btn-success" data-direct="new"><i class="fas fa-plus"></i></a>
                                    <a href="javascript:;" class="btn btn-custom btn-info" id="reload-data"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered table-hover" id="table-data" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px;">#</th>
                                                <th>Pr ID</th>
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
                                                <th>Pr ID</th>
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
            </div>
        </main>
        <!-- end page-content -->
