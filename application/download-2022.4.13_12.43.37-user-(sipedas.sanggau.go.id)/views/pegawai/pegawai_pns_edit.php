<div class="col-md-8" id="form-edit">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body table-responsive">
                        <form id="formidentitas" role="form" enctype="multipart/form-data" action="<?= site_url('pegawai/PegawaiPns/update') ?>" method="post" onsubmit="return validasiInput()">
                            <input name="nip" type="hidden" value="<?= $pegawai->pegawai_nip ?>" />

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <b> PENGANGKATAN SEBAGAI PNS</b>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>Pejabat Yang Menetapkan</label><br>
                                            <select class="form-control select2" name="pegawai_pns_pejabat" id="pegawai_pns_pejabat">
                                                <?php
                                                foreach ($pejabat->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pejabat_nama ?>" <?= selected($value->pejabat_nama, $pegawai->pegawai_pns_pejabat) ?>><?= $value->pejabat_nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No SK PNS</label>
                                            <div class="input-group-addon">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control col-lg-4" name="pegawai_pns_sk_no" value="<?= $pegawai->pegawai_pns_sk_no ?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <div class="btn btn-default">Tanggal</div>
                                                        </span>
                                                        <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawai_pns_sk_date" id="pegawai_pns_sk_date" value="<?= d_m_y($pegawai->pegawai_pns_sk_date) ?>" autocomplete="off" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar text-danger"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label>Pangkat Golongan</label>
                                            <select class="form-control" name="pegawai_pns_pangkat_id" id="pegawai_pns_pangkat_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($pangkat_golongan->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->pangkat_golongan_id ?>" <?= selected($value->pangkat_golongan_id, $pegawai->pegawai_pns_pangkat_id) ?>><?= $value->pangkat_golongan_text ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>TMT PNS</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dateEntry" placeholder="dd/mm/yyyy" name="pegawai_pns_tmt" id="pegawai_pns_tmt" value="<?= d_m_y($pegawai->pegawai_pns_tmt) ?>" autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar text-danger"></i>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Sumpah / Janji</label>
                                            <select class="form-control" name="pegawai_pns_sumpah_id" id="pegawai_pns_sumpah_id">
                                                <option value="">--Pilih--</option>
                                                <?php
                                                foreach ($kondisi_sumpah->result() as $value) {
                                                ?>
                                                    <option value="<?= $value->kondisisumpah_id ?>" <?= selected($value->kondisisumpah_id, $pegawai->pegawai_pns_sumpah_id) ?>><?= $value->kondisisumpah_nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="input-group-addon">
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </div>

                                    </div>
                                    <!-- /.panel-body -->
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="menu-edit">
                <div class="box">

                    <div class="box-body">
                        <?= $menu_pegawai ?>
                    </div>
                </div>
            </div>