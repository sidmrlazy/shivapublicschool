<?php require('components/db.php');
$query = "SELECT * FROM `notice`";
$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);
if ($count > 0) {  ?>
    <div class="container home-section-4">
        <div class="common-header">
            <div class="common-header-data">
                <h2><span>Notice</span> Board</h2>
                <p>Get a glimpse of all the notices shared by Shiva Public School</p>
            </div>
            <a href="#" class="common-header-btn">View All Notices</a>
        </div>

        <div class="section-4-container">
            <ul class="section-4-list">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $notice_detail = $row['notice_detail'];
                    $notice_file = "admin/notice/doc/" . $row['notice_file'];
                    $notice_upload_date = $row['notice_upload_date'];

                ?>
                    <li class="section-4-row">
                        <div>
                            <p class="section-4-data-label">Date</p>
                            <p class="section-4-date"><?php echo date("d-M-Y", strtotime($notice_upload_date)) ?></p>
                        </div>

                        <div class="section-4-data">
                            <p class="section-4-response"><?php echo $notice_detail ?></p>
                        </div>

                        <div class="section-4-btn">
                            <a target="_blank" rel="noopener noreferrer" href="<?php echo $notice_file ?>">Download</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>