<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b> BERKAS MUTASI</b>
        </div>
        <div class="panel-body">
            <?php
            foreach ($berkas->result() as $item) : ?>
                <div class="form-group row">
                    <label class="col-form-label col-md-4 text-lg-right">
                        <span class="text-red">*</span> <?= $item->berkas_nama ?> <span>(Pdf/JPG Maks. 2MB) <br> 
                        <?php if($item->berkas_contoh != '' || $item->berkas_contoh != NULL) : ?>
                            <a href="<?= base_url('assets/files/' . $item->berkas_contoh) ?>" class="btn btn-sm btn-success" target="_blank"><small>Unduh Contoh Berkas</small></a>
                        <?php endif ?></span>
                    </label>
                    <div class="col-md-4">
                        <input type="file" style="padding: .175rem 0.75rem" class="form-control" accept="application/pdf" name="berkas_<?= $item->berkas_id ?>" value="" placeholder="" />
                    </div>
                    <?php if ($usulan_id != '') : ?>
                        <div class="col-md-4">
                            <?php foreach ($berkas_mutasi as $key) : ?>
                                <?php if ($key['berkas_id'] == $item->berkas_id) : ?>
                                    <a href="<?= base_url('assets/files/' . $key['url_file']) ?>" class="btn btn-sm btn-success" target="_blank"><small>Unduh <?= $item->berkas_nama ?></small></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>