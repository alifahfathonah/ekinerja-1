<form id="ganti_foto" class="form-horizontal" method="POST" action="<?=base_url();?>account/ganti_foto" role="form" enctype="multipart/form-data">
    <div class="form-body text-center">
        <div class="form-group">
            <label class="control-label">Recommended dimensions : 200 x 200 pixels </label>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"></div>
                <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" accept="image/png, image/jpeg, image/jpg, image/gif" name="userfile"></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
    </div><!-- /.form-footer -->
</form>