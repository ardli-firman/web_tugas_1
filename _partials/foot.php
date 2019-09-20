<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
        $('#table_id').DataTable();

        $('#modal-edit').on('show.bs.modal', (e) => {
            let user = $(e.relatedTarget).data('user');
            $.ajax({
                url: 'user.php?id=' + user,
                method: 'get',
                dataType: 'json',
                success: (res) => {
                    $("#modal-edit [name='user_id']").val(res.id)
                    $("#modal-edit [name='nama']").val(res.nama)
                    $("#modal-edit [name='username']").val(res.username)
                    $("#modal-edit [name='password']").val(res.password)
                    $("#modal-edit [name='email']").val(res.email)
                }
            });
        })
    })
</script>