<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Edit Data</h2>
            <form method="POST" action="/Bdo/update/<?= $Classes['id']; ?>" enctype="multipart/form-data">
                <input type="hidden" name="slug" value="<?= $Classes['slug']; ?>">
                <input type="hidden" name="oldPhoto" value="<?= $Classes['photo']; ?>">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('name'))
                                                                    ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= (old('name')) ? old('name') : $Classes['name']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $Classes['photo']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input 
                            <?= ($validation->hasError('name'))
                                ? 'is-invalid' : ''; ?>" id="photo" name="photo" onchange="imgPreview()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('photo'); ?>
                            </div>
                            <label class="custom-file-label" for="photo"><?= $Classes['photo']; ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>