<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/img/<?= $dataClass['photo']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $dataClass['name']; ?></h5>
                    <a href="/bdo/edit/<?= $dataClass['slug']; ?>" class="btn btn-primary">Edit</a>
                    <!-- agar tidak bisa menghapus dari url ketika memasukkan id dengan acak -->
                    <form method="post" action="/bdo/<?= $dataClass['id']; ?>" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                    <a href="/bdo" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>