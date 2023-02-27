<div class="container add-notice-section">
    <h2>Add Notice</h2>
    <p>Enter details below to upload notice on the website</p>

    <?php
    require('../components/db.php');
    if (isset($_POST['submit'])) {
        $notice_detail = $_POST['notice_detail'];
        $notice_file =  $_FILES['notice_file']['name'];
        $notice_file_temp = $_FILES['notice_file']['tmp_name'];
        $folder = "notice/doc/" . $notice_file;
        $size = filesize($notice_file_temp);

        if (!move_uploaded_file($notice_file_temp, $folder)) {
            die("<div class='alert  alert-danger' role='alert'>Fail</div>" . mysqli_error($connection));
        } else {
            $insert_query = "INSERT INTO `notice`(
                `notice_detail`,
                `notice_file`
            )
            VALUES(
                '$notice_detail',
                '$notice_file'
            )";
            $insert_result = mysqli_query($connection, $insert_query);

            if ($insert_result) { ?>
    <div class='alert alert-success mb-3 w-50' role='alert'>Notice Uploaded!</div>
    <?php
            }
        }
    }

    ?>

    <form action="" method="POST" class="add-notice-form col-md-6" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <textarea class="form-control" name="notice_detail" placeholder="Leave a comment here"
                id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Notice Details</label>
        </div>

        <div onclick="showUpload()" class="mb-3 add-notice-check-row">
            <p>Do you want to upload a document?</p>
            <div class="form-check add-notice-checkbox">
                <input class="form-check-input" name="notice_file_status" type="checkbox" value="1" id="checkBoxYes">
                <label class="form-check-label" for="flexCheckDefault">Yes</label>
            </div>
        </div>

        <div class="mb-3" style="display:none" id="uploadSection">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" type="file" name="notice_file" id="formFile">
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Add</button>
    </form>


    <div class="add-notice-table table-responsive mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Notice Details</th>
                    <th scope="col">File</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetch_notice = "SELECT * FROM `notice`";
                $fetch_notice_r = mysqli_query($connection, $fetch_notice);
                $fetch_notice_count = mysqli_num_rows($fetch_notice_r);

                if ($fetch_notice_count < 0) { ?>
                <div class='alert alert-success mb-3 w-50' role='alert'>No Notice Found</div>
                <?php } else {

                    if (isset($_POST['delete'])) {
                        $notice_id = $_POST['notice_id'];
                        $delete_q = "DELETE FROM `notice` WHERE `notice_id` = $notice_id";
                        $delete_r = mysqli_query($connection, $delete_q);

                        if ($delete_r) { ?>

                <div class='alert alert-danger mb-3 w-50' role='alert'>Notice Deleted!</div>
                <?php
                        }
                    }

                    while ($row = mysqli_fetch_assoc($fetch_notice_r)) {
                        $notice_id = $row['notice_id'];
                        $notice_detail = $row['notice_detail'];
                        $notice_file = "notice/doc/" . $row['notice_file']; ?>
                <tr>
                    <td>
                        <p><?php echo $notice_detail ?></p>
                    </td>
                    <td><a href="<?php echo $notice_file ?>">Download File</a></td>
                    <form action="" method="POST">
                        <td>
                            <input type="text" name="notice_id" value="<?php echo $notice_id ?>" hidden>
                            <button type="submit" name="delete" class="btn btn-sm btn-warning">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
</div>