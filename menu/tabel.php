<?php
$users = $CRUD->getAll();
?>
<div class="row my-3">
    <div class="col">
        <h1>CRUD</h1>
    </div>
</div>
<div class="row my-3">
    <div class="col">
        <a href="?aksi=tambah" class="btn btn-primary">Tambah</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <table id="table_id" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users != false) : ?>
                    <?php $i = 0;
                        foreach ($users as $user) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $user['nama'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a href="?aksi=ubah&id=<?= $user['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                <a onclick="return confirm('Yakin ?')" href="?aksi=hapus&id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>