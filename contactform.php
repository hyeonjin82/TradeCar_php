<?php
$page_title = "Contact Us";
include_once "header.php";
// Define variables and set to empty values
$userNameErr = $emailErr = $messageErr = $humanErr = "";
$userName = $email = $message = $human = $result = "";

$from = "Jin's car trader";
$to = 'jintrader@gmail.com';
$subject = 'Message from Contact Demo ';

$body = "From: $userName\n E-Mail: $email\n Message:\n $message";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $userNameErr = "* Name is required";
    } else {
        $userName = test_input($_POST["username"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "* Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["message"])) {
        $messageErr = '* Please enter your message';
    } else {
        $message = test_input($_POST["message"]);
    }
//Check if simple anti-bot test is correct
    if ($human !== 5) {
        $humanErr = '* Your anti-spam is incorrect';
    }
// If there are no errors, send the email
    if (!$userNameErr && !$emailErr && !$messageErr && !$humanErr) {
        if (mail($to, $subject, $body, $from)) {
            $result = '<div class="alert alert-success">Thank You! I will be in touch</div>';
        } else {
            $result = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-2">
            <p>Contact us using the form below </p>
            <p>Tell us what you think of the site, or just say hello ~ ^^ </p>
            <form class="form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="First & Last Name" value="">
                        <span class="error"> <?php echo $userNameErr; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
                        <span class="error"> <?php echo $emailErr; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message" class="col-lg-2 control-label">Message</label>
                    <div class="col-lg-3">
                        <textarea class="form-control" rows="4" name="message"></textarea>
                        <span class="error">*<?php echo $messageErr; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="human" class="col-lg-2 control-label">2 + 3 = ?</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                        <span class="error"> <?php echo $humanErr; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3 col-lg-offset-2">
                        <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3 col-lg-offset-2">
                        <?php echo $result; ?>	
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

