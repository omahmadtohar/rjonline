<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            DOKUMEN LAPORAN KASUS
            <small>DIT RESKRIMSUS POLDA RIAU</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">LaporanKasus</a></li>
            <li class="active">Daftar Dokumen Laporan Kasus</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Dokumen Laporan Kasus</h3>
                        <br />
                        <br />
                       <?php if ($this->session->flashdata('success')): ?>
						    <div class="alert alert-success alert-dismissible">
						        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        <h4><i class="icon fa fa-check"></i> Selamat!</h4>
						        <?php echo $this->session->flashdata('success'); ?>
						    </div>
						<?php endif; ?>

						<?php if ($this->session->flashdata('error')): ?>
						    <div class="alert alert-danger alert-dismissible">
						        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        <h4><i class="icon fa fa-ban"></i> WARNING!!</h4>
						        <?php echo $this->session->flashdata('error'); ?>
						    </div>
						<?php endif; ?>


                        <!-- Tombol Tambah Kasus -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                            Upload Dokumen
                        </button>
                    </div>
                   <div class="box-body">
					    <div class="table-responsive">
					        <table id="tablesiji" class="table table-bordered table-striped">
							    <thead>
							        <tr>
							            <th width="5%">No</th>
							            <th>Nomor Laporan</th>
							            <th>Nomor KK</th>
							            <th>Nama</th>
							            <th>File1</th>
							            <th>File2</th>
							            <th>File3</th>
							            <th>File4</th>
							            <th>File5</th>
							            <th>Aksi</th>
							        </tr>
							    </thead>
							    <tbody>
							        <?php
							        $no = 1;
							        foreach ($dokumenKasus as $lp): ?>
							            <tr>
							                <td><?php echo $no++;?></td>
							                <td><?php echo $lp->nomor_lp ;?></td>
							                <td><?php echo $lp->nomor_kk ;?></td>
							                <td><?php echo $lp->nama_pelapor ;?></td>
							                <td>
											    <?php if (!empty($lp->file1)): ?>
											        <a href="<?php echo base_url('./images/' . $lp->file1); ?>" target="_blank"><?php echo $lp->file1; ?></a>
											    <?php endif; ?>
											</td>

							                <td>
							                    <?php if (!empty($lp->file2)): ?>
							                        <a href="<?php echo base_url('./images/' . $lp->file2); ?>" target="_blank"><?php echo $lp->file2; ?></a>
							                    <?php endif; ?>
							                </td>
							                <td>
							                    <?php if (!empty($lp->file3)): ?>
							                        <a href="<?php echo base_url('./images/' . $lp->file3); ?>" target="_blank"><?php echo $lp->file3; ?></a>
							                    <?php endif; ?>
							                </td>
							                <td>
							                    <?php if (!empty($lp->file4)): ?>
							                        <a href="<?php echo base_url('./images/' . $lp->file4); ?>" target="_blank"><?php echo $lp->file4; ?></a>
							                    <?php endif; ?>
							                </td>
							                <td>
							                    <?php if (!empty($lp->file5)): ?>
							                        <a href="<?php echo base_url('./images/' . $lp->file5); ?>" target="_blank"><?php echo $lp->file5; ?></a>
							                    <?php endif; ?>
							                </td>
							                <td>
							                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $lp->id ?>">Edit</button>
							                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $lp->id ?>">Delete</button>
							                </td>
							            </tr>
							        <?php endforeach ;?>
							    </tbody>
							</table>
					    </div>
					</div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
 <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">FORM KASUS</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?php echo base_url('dokumen/add');?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
							    <label>Nomor LP</label>
							    <select class="form-control select2" name="nomor_lp" id="nomor_lp" style="width: 100%;" required>
							        <option value="">Pilih Nomor LP</option> <!-- Opsi default kosong -->
							        <?php foreach ($laporanKasus as $item): ?>
							            <option value="<?= $item->nomor_lp ?>"><?= $item->nomor_lp ?></option>
							        <?php endforeach; ?>
							    </select>
							</div>

							<div class="form-group">
							    <label for="nomor_kk">NOMOR KK</label>
							    <input type="text" class="form-control" id="nomor_kk" name="nomor_kk" placeholder="Masukkan Nomor KK..." readonly>
							</div>
							<div class="form-group">
							    <label for="nomor_kk">ID LAPORAN</label>
							    <input type="text" class="form-control" id="id_laporan" name="id_laporan" placeholder="Masukkan ID..." readonly>
							</div>
							<div class="form-group">
							    <label for="nama_pelapor">NAMA PELAPOR</label>
							    <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" placeholder="Masukkan Nama..." readonly>
							</div>

                           <div class="form-group">
							    <label for="file1">FILE 1</label>
							    <input type="file" class="form-control" id="file1" name="file1" required>
							</div>

							<div class="form-group">
							    <label for="file2">FILE 2</label>
							    <input type="file" class="form-control" id="file2" name="file2" >
							</div>

                            <div class="form-group">
						    <label for="file1">FILE 3</label>
						    <input type="file" class="form-control" id="file3" name="file3" >
							</div>

							<div class="form-group">
							    <label for="file2">FILE 4</label>
							    <input type="file" class="form-control" id="file4" name="file4" >
							</div>

							<div class="form-group">
							    <label for="file2">FILE 5</label>
							    <input type="file" class="form-control" id="file5" name="file5">
							</div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="<?php echo base_url('dokumen/dokumenKasus');?>" class="btn btn-danger">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <?php foreach ($dokumenKasus as $lp): ?>
		<div class="modal fade" id="editModal<?= $lp->id ?>">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		                <h4 class="modal-title">Edit Kasus</h4>
		            </div>
		            <div class="modal-body">
		                <form role="form" action="<?= site_url('dokumen/edit/'.$lp->id) ?>" method="post">
		                    <input type="hidden" name="edit_id" id="edit_id"> <!-- Input tersembunyi untuk menyimpan ID laporan kasus yang akan diedit -->
		                    <div class="box-body">
		                        <div class="form-group">
		                            <label for="edit_nomor_lp">NOMOR LAPORAN</label>
		                            <input type="text" class="form-control" id="edit_nomor_lp" name="nomor_lp" value="<?= $lp->nomor_lp ?>" placeholder="Masukkan Nomor LP..." required>
		                        </div>
		                        <div class="form-group">
		                            <label for="edit_nomor_kk">NOMOR KK</label>
		                            <input type="text" class="form-control" id="edit_nomor_kk" name="nomor_kk" value="<?= $lp->nomor_kk ?>" placeholder="Masukkan Nomor KK..." required>
		                        </div>
		                        <div class="form-group">
		                            <label for="edit_nama_pelapor">NAMA PELAPOR</label>
		                            <input type="text" class="form-control" id="edit_nama_pelapor" name="nama_pelapor" value="<?= $lp->nama_pelapor ?>" placeholder="Masukkan Nama..." required>
		                        </div>
		                        <div class="form-group">
		                            <label for="edit_tanggal_laporan">TANGGAL LAPORAN</label>
		                            <input type="date" class="form-control" id="edit_tanggal_laporan" value="<?= $lp->tanggal_laporan ?>" name="tanggal_laporan" required>
		                        </div>
		                        <div class="form-group">
		                            <label for="edit_deskripsi_kasus">DESKRIPSI KASUS</label>
		                            <textarea class="form-control" rows="5" id="edit_deskripsi_kasus" name="deskripsi_kasus" required><?= $lp->deskripsi_kasus ?>
		                            </textarea>
		                        </div>
		                    </div>
		                    <div class="box-footer">
		                        <button type="submit" class="btn btn-primary">Update</button>
		                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		                    </div>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
	<?php endforeach; ?>

	<!-- Modal Hapus Laporan Kasus -->
 <?php foreach ($dokumenKasus as $lp): ?>
		<div class="modal fade" id="deleteModal<?= $lp->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Dokumen Kasus</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus dokumen ini?</p>
            </div>
            <div class="modal-footer">
                <a href="<?= site_url('dokumen/delete/'.$lp->id) ?>" class="btn btn-danger">Ya</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

   
</div>
<!-- /.content-wrapper -->
