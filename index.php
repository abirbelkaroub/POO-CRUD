    <?php    include "crud.php";?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Bootstrap demo</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <h2 class="text-center">PHP OOP CRUD Project</h2>
                    <hr style="height: 2px;background-color:#000">
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <?php

                    if (isset($_SESSION['message'])) {
                    ?>
                        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                            <strong>
                                <?php
                                echo  $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                        $crud = new crud();
                        $crud->insert($_POST);
                    }
                    ?>

                    <?php
                    // edit

                    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['editid'])) {
                        $crud = new crud();
                        $row = $crud->edit($_GET['editid']); 
                    }

                    // update

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
                        $crud = new crud();
                        $crud->update($_POST);
                    }


                    // delete

                    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deleteid'])) {
                        $crud = new crud();
                        $crud->delete($_GET['deleteid']);
                    }


                    ?>
                    <form action="" method="post">

                        <!--ID -->
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php if (isset($row['id'])) {
                                                                        echo $row['id'];
                                                                    } ?>" class="form-control">
                        </div>

                        <!-- First Name -->
                        <div class="form-group">
                            <input type="text" name="first_name" value="<?php if (isset($row['first_name'])) {
                                                                            echo $row['first_name'];
                                                                        } ?>" placeholder="Enter Your First Name" class="form-control">
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <input type="text" name="last_name" value="<?php if (isset($row['first_name'])) {
                                                                            echo $row['first_name'];
                                                                        } ?>" placeholder="Enter Your Last Name" class="form-control">
                        </div>

                        <!-- Mobile-->
                        <div class="form-group">
                            <input type="text" name="mobile" value="<?php if (isset($row['mobile'])) {
                                                                        echo $row['mobile'];
                                                                    } ?>" placeholder="Enter Your Mobile Number" class="form-control">
                        </div>

                        <!-- Email-->
                        <div class="form-group">
                            <input type="text" name="email" value="<?php if (isset($row['email'])) {
                                                                        echo $row['email'];
                                                                    } ?>" placeholder="Enter Your Email" class="form-control">
                        </div>

                        <!-- Address-->
                        <div class="form-group">
                            <input type="text" name="address" value="<?php if (isset($row['address'])) {
                                                                            echo $row['address'];
                                                                        } ?>" placeholder="Enter Your Address" class="form-control">
                        </div>

                        <!-- Submit Button -->
                        <?php
                        if (isset($row['id'])) {
                        ?>
                            <div class="form-group">
                                <button name="update" class="btn btn-primary">Update</button>
                            </div>

                        <?php

                        } else {
                        ?>
                            <div class="form-group">
                                <button name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-4">
                <h2 class="text-center">USER RECORDS </h2>
                <hr style="height: 2px;background-color:#000">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-4">
                <table class="table table-bordered">
                    <thead>
                        <th>SL.No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $crud = new crud();
                        $rows = $crud->fetch_all();
                        $i = 1;
                        if (!empty($rows)) {
                            foreach ($rows as $row) {
                        ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>
                                        <a href="index.php?deleteid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product')" class="btn btn-danger">Delete</a>
                                        <a href="index.php?editid=<?php echo $row['id']; ?> " class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    </body>

    </html>