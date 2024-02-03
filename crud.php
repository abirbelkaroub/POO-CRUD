<?php
session_start();

class crud
{

    private $connect;
    function __construct()
    {
        try {
            $this->connect = new mysqli("127.0.0.1", "root", "", "oop_crud");
        } catch (Exception $e) {
            echo "Not connected" . $e->getMessage();
        }
    }

    function insert($data)
    {

        $first_name = mysqli_real_escape_string($this->connect, $data['first_name']);
        $last_name = mysqli_real_escape_string($this->connect, $data['last_name']);
        $mobile = mysqli_real_escape_string($this->connect, $data['mobile']);
        $email = mysqli_real_escape_string($this->connect, $data['email']);
        $address = mysqli_real_escape_string($this->connect, $data['address']);

        // validation
        if ($first_name == "" || $last_name == "" || $email == "" || $mobile == "" || $address == "") {
            $_SESSION['message'] = "Please Fill All The Fields";
            $_SESSION['type'] = "danger";
        } else {
            $query = "insert into user (first_name, last_name, email, mobile, address) values ('$first_name', '$last_name', '$email', '$mobile', '$address')";
            if ($this->connect->query($query)) {
                $_SESSION['message'] = "Successfully Inserted";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "An issue during Inserting data! this last hasn't been inserted";
                $_SESSION['type'] = "danger";
            }
        }
        header('location:index.php');
    }
    // displaying 
    function fetch_all()
    {
        $data = NULL;
        $query = " select * from user order by id desc";
        if ($sql = $this->connect->query($query)) {
            while ($row = $sql->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function edit($editid)
    {
        $data = null;
        $query = "select * from user where id=$editid";
        if ($sql = $this->connect->query($query)) {
            while ($row = $sql->fetch_assoc()) {
                $data = $row;
            }
        }
        return $data;
    }

    function update($data)
    { {

            $id = mysqli_real_escape_string($this->connect, $data['id']);
            $first_name = mysqli_real_escape_string($this->connect, $data['first_name']);
            $last_name = mysqli_real_escape_string($this->connect, $data['last_name']);
            $mobile = mysqli_real_escape_string($this->connect, $data['mobile']);
            $email = mysqli_real_escape_string($this->connect, $data['email']);
            $address = mysqli_real_escape_string($this->connect, $data['address']);

            // validation
            if ($id == "" || $first_name == "" || $last_name == "" || $email == "" || $mobile == "" || $address == "") {
                $_SESSION['message'] = "Please Fill All The Fields";
                $_SESSION['type'] = "danger";
            } else {
                $query = "update user set first_name='$first_name', last_name='$last_name', email='$email', mobile='$mobile', address='$address' where id='$id'";
                if ($this->connect->query($query)) {
                    $_SESSION['message'] = "Successfully Updated";
                    $_SESSION['type'] = "success";
                } else {
                    $_SESSION['message'] = "An issue during Updating data! this last hasn't been Updated";
                    $_SESSION['type'] = "danger";
                }
            }
            header('location:index.php');
        }
    }

    function delete($deleteid)
    {
        $query = "delete from user where id=$deleteid";
        if ($this->connect->query($query)) {
            $_SESSION['message'] = "Successfully Deleted";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "An issue during Deleting data! this last hasn't been Deleted";
            $_SESSION['type'] = "danger";
        }
        header('location:index.php');
    }
}
