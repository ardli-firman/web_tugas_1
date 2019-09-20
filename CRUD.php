<?php

class CRUD
{
    private $tbl = 'users';
    private $db = '';
    private $username = '';
    private $password = '';
    private $host = '';
    private $conn = '';

    public function __construct()
    {
        $this->db = 'tugas_1';
        $this->username = 'root';
        $this->host = 'localhost';
        $this->conn = @new mysqli($this->host, $this->username, $this->password, $this->db);
        if ($this->conn->connect_error) {
            die('Connect Error: ' . $this->conn->connect_error);
        }
    }

    public function getAll()
    {
        $res = $this->conn->query("SELECT * FROM {$this->tbl}");
        if ($res->num_rows > 0) {
            while ($user = $res->fetch_assoc()) {
                $users[] = $user;
            }
            return $users;
        }
        $this->conn->close();
        return false;
    }

    public function getById($id)
    {
        $res = $this->conn->query("SELECT * FROM {$this->tbl} WHERE id = $id");
        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            return $user;
        }
        return false;
    }

    public function getByUsername($username)
    {
        $res = $this->conn->query("SELECT * FROM {$this->tbl} WHERE username = '$username'");
        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            return $user;
        }
        return false;
    }

    public function insert($data)
    {
        $validasi = $this->_validasi($data);
        if ($validasi == []) {
            $enc_password = md5($data['password']);
            $res = $this->conn->query("INSERT INTO {$this->tbl}(nama,username,password,email) VALUES ('{$data['nama']}','{$data['username']}','{$enc_password}','{$data['email']}')");
            $this->conn->close();
            return $res;
        } else {
            return $validasi;
        }
    }

    public function update($data)
    {
        $user = $this->getById($data['user_id']);

        if ($user['username'] == $data['username']) {
            $username = $data['username'];
            $data['username'] = false;
        } else {
            $username = $data['username'];
        }

        if ($data['password'] == null) {
            $password = $data['password2'];
            $data['password'] = false;
        } else {
            $password = md5($data['password']);
        }

        $validasi = $this->_validasi($data);

        if ($validasi == []) {
            $res = $this->conn->query("UPDATE {$this->tbl} SET nama='{$data['nama']}',username='{$username}',password='{$password}',email='{$data['email']}' WHERE id={$data['user_id']}");
            $this->conn->close();
            return $res;
        } else {
            return $validasi;
        }
    }

    public function delete($id)
    {
        $this->conn->query("DELETE FROM {$this->tbl} WHERE id = {$id}");
        if ($this->conn->affected_rows == 1) {
            return true;
        }
        return false;
    }

    public function _validasi($data)
    {
        $error = [];
        foreach ($data as $key => $value) {
            if ($key != 'tambah' && $key != 'edit') {
                if ($data[$key] === null) {
                    $error['error'][$key] = ['message' => 'harus diisi'];
                }
            }
        }

        if (!empty($error['error'])) {
            return $error;
        }

        if (!preg_match('/^[a-z|A-Z ]*$/', $data['nama'])) {
            $error['error']['nama'] = [
                'message' => 'harus berupa huruf'
            ];
        }

        if (!preg_match('/\S+@\S+\.\S+/', $data['email'])) {
            $error['error']['email'] = [
                'message' => 'tidak valid'
            ];
        }
        if ($data['password'] != false) {
            if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $data['password'])) {
                $error['error']['password'] = [
                    'message' => 'minimal 8 Karakter dengan kombinasi angka'
                ];
            }
        }

        if ($data['username'] != false) {
            $res = $this->getByUsername($data['username']);
            if ($res == true) {
                $error['error']['username'] = [
                    'message' => 'sudah digunakan'
                ];
            }
        }

        return $error;
    }
}
