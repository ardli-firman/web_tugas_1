<?php
require_once 'CRUD.php';
$CRUD = new CRUD();
?>
<?php require_once '_partials/head.php'; ?>

<body>
    <div class="container">
        <?php
        switch (@$_GET['aksi']) {
            case 'tambah':
                require_once 'menu/tambah.php';
                break;
            case 'ubah':
                require_once 'menu/ubah.php';
                break;
            case 'hapus':
                if (isset($_GET['id'])) {
                    $res = $CRUD->delete($_GET['id']);
                    if ($res) {
                        echo "<script>
                                window.location.href = 'index.php';
                            </script>";
                    } else {
                        echo "<script>
                                alert('gagal');
                                window.location.href = 'index.php';
                            </script>";
                    }
                }
                break;
            default:
                require_once 'menu/tabel.php';
                break;
        }
        ?>
    </div>
</body>
<?php require_once '_partials/foot.php'; ?>