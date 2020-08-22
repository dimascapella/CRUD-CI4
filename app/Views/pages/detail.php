<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md">
            <h1>Daftar CLass</h1>
            <a href="/Bdo/trigCreateButton" class="btn btn-dark">Add Class</a>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($dataClass as $k) : ?>
                        <tr>
                            <th><?= $i++; ?></th>
                            <td><?= $k['name']; ?></td>
                            <td><img src="/img/<?= $k['photo']; ?>" style="width: 100px"></td>
                            <td><a href="/bdo/<?= $k['slug']; ?>" class="btn btn-warning">Details</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>