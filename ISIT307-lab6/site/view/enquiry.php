<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php
function ifsetor(&$variable, $default = null)
{
    if (isset($variable)) {
        $tmp = $variable;
    } else {
        $tmp = $default;
    }
    return $tmp;
}
?>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> Enquiry </h3>
    </div>

    <div class="col-sm-offset-2 col-sm-8">
        <?php
        if (isset($data['message'])) {
            ?>
            <div class="bg-primary message">
                <?php echo $data['message']; ?>
            </div>
            <?php
        }
        ?>
        <form action="index.php?a=enquiry&c=index" method="POST">
            <div class="form-group">
                <label for="email">Your email</label>
                <input class="form-control" id="email" name="email" type="email" placeholder="Your email" <?php echo ifsetor($data["email"]) ?>/>
                <div class="error">
                    <?php echo ifsetor($data["email_error"]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" value = "<?php echo ifsetor($data["subject"]) ?>"/>
                <div class="error">
                    <?php echo ifsetor($data["subject_error"]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="subject">Detail</label>
                <textarea class="form-control" id="detail" name="detail" rows="10" placeholder="Detail"><?php echo ifsetor($data["detail"]) ?></textarea>
                <div class="error">
                    <?php echo ifsetor($data["detail_error"]); ?>
                </div>
            </div>
            <button type = "submit" class = "btn btn-primary" id = "submit">Submit</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function () {

        var email_error = true;
        $("input[name='email']").on("keyup blur",function () {
            var email = $(this).val().trim();
            if (email.length == 0) {
                $(this).next().text("Email must not be empty");
                email_error = true;
            }
            else {
                var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!pattern.test(email)) {
                    $(this).next().text("Invalid email");
                    email_error = true;
                }
                else {
                    $(this).next().text("");
                    email_error = false;
                }
            }
            canSubmit();
        });

        var subject_error = true;
        $("input[name='subject']").on("keyup blur", function () {
            var subject = $(this).val().trim();
            if (subject.length == 0) {
                $(this).next().text("Subject must not be empty");
                subject_error = true;
            }
            else {
                $(this).next().text("");
                subject_error = false;
            }
            canSubmit();
        });

        var detail_error = true;
        $("textarea[name='detail']").on("keyup blur",function () {
            var detail = $(this).val().trim();
            if (detail.length == 0) {
                $(this).parent().find(".error").text("Detail must not be empty");
                detail_error = true;
            }
            else {
                $(this).parent().find(".error").text("")
                detail_error = false;
            }
            canSubmit();
        });

        function canSubmit(){
            if (!detail_error && !subject_error && !email_error)
            {
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#submit").prop("disabled", true);
            }
        }

        canSubmit();

    });
</script>
</body>
</html>