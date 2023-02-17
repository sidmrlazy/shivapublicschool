<div class="section-7-container">
    <div class="container">
        <div class="common-header">
            <div class="common-header-data">
                <h2><span>Connect</span> with us</h2>
                <p>Fill the form below to connect with us</p>
            </div>
            <!-- <a href="#" class="common-header-btn">View All Notices</a> -->
        </div>
        <?php
        require('components/db.php');
        if (isset($_POST['submit'])) {
            $contact_name = mysqli_real_escape_string($connection, $_POST['contact_name']);
            $contact_email = mysqli_real_escape_string($connection, $_POST['contact_email']);
            $contact_number = mysqli_real_escape_string($connection, $_POST['contact_number']);
            $contact_details = mysqli_real_escape_string($connection, $_POST['contact_details']);

            if (empty($contact_number)) { ?>

        <div class="alert alert-danger w-50" role="alert">
            Contact Number cannot be empty!
        </div>

        <?php
            } else {
                $query = "INSERT INTO `contact`(
                    `contact_name`,
                    `contact_email`,
                    `contact_number`,
                    `contact_details`
                )
                VALUES(
                    '$contact_name',
                    '$contact_email',
                    '$contact_number',
                    '$contact_details'
                )";
                $result = mysqli_query($connection, $query);
                if (!$result) { ?>
        <div class="alert alert-danger w-50" role="alert">
            Oops! There was some problem. Please try again.
        </div>
        <?php } else { ?>
        <div class="alert alert-success w-50" role="alert">
            <?php
                        $school_email = "shivapublicschoolmarketing@gmail.com";
                        $email_subject = "Website Visitor!";
                        $email_body = "Full Name: " . $contact_name . "<br>";
                        $email_body .= "Contact Number: " . $contact_number . "<br>";
                        $email_body .= "Email Address: " . $contact_email . "<br><br>";
                        $email_body .= "Details: " . $contact_details . "<br>";

                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        mail(
                            $school_email,
                            $email_subject,
                            $email_body,
                            $headers
                        );
                        ?>
            Form Submitted! We will contact you shortly!
        </div>
        <?php
                }
            }
        }
        ?>
        <div class="section-7-row">

            <form action="" method="POST" class="col-md-6 section-7-form">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="contact_name" id="contactName"
                        placeholder="Full Name">
                    <label for="contactName">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="contact_email" id="contactEmail"
                        placeholder="abc@xyz.com">
                    <label for="contactEmail">E-Mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="contact_number" id="contactNumber"
                        placeholder="+919876543210">
                    <label for="contactNumber">Contact number</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" name="contact_details" placeholder="Leave a comment here"
                        id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">How can we help?</label>
                </div>

                <button type="submit" name="submit" class="section-7-btn">Submit</button>
            </form>
            <div class="col-md-6 section-7-lottie">
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_7wwm6az7.json"
                    background="transparent" speed="1" loop autoplay></lottie-player>
            </div>
        </div>
    </div>
</div>