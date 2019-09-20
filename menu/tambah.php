<?php

if (isset($_POST['tambah'])) {
    $res = $CRUD->insert($_POST);
    if ($res === true) {
        echo "<script>
            window.location.href = 'index.php';
        </script>";
    }
}
?>
<div class="row my-3">
    <div class="col">
        <h1>Menu tambah</h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <?php if (isset($res['error'])) : ?>
            <?php $errors = $res['error']; ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $key => $error) : ?>
                        <li><?= $key . ' ' . $error['message'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="" method="post" class="needs-validation">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>