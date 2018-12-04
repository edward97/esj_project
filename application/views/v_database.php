
        <!-- page-content -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow">
                            <h5 class="card-header"><i class="fas fa-database fa-xs"></i> Database</h5>

                            <div class="card-body">
                                <?=$this->session->flashdata('msg')?>

                                <h5 class="card-title"><i class="fas fa-angle-right"></i> Backup Database</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut praesentium necessitatibus cum qui architecto, ipsum iure voluptatum ducimus eum aliquid magni dicta modi? Cupiditate iste eum quam esse sit architecto!</p>

                                <div class="form-group">
                                    <a href="<?=site_url('database/backup')?>" class="btn btn-primary"><i class="fas fa-database"></i> Backup</a>
                                </div>

                                <h5 class="card-title"><i class="fas fa-angle-right"></i> List Table</h5>
                                <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia ipsam odit amet corrupti, reprehenderit harum minima cupiditate quasi libero illo, eaque ea quisquam veritatis dolore excepturi dolores ratione omnis hic!</p>

                                <div class="row">
                                    <div class="col-md-4">
                                        <table class="table table-sm table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Table Name</td>
                                                </tr>
                                            </thead>

                                            <tbody>
<?php $no = 1; ?>
<?php foreach ($list_table as $i): ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td><?=$i->t_name?></td>
                                                </tr>
<?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- end page-content -->
