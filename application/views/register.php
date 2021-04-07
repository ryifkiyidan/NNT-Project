<div class="form-signup">
    <h2 class="form-signup-heading my-3">Register</h2>

    <?php

    if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-danger">' . $this->session->flashdata('message') . '</div>';
    }
    ?>

    <form method="post" action="<?= base_url('index.php/auth/register'); ?>">


        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="iFName">First Name</label>
                    <input name="iFName" type="text" class="form-control input-box" placeholder="First Name" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="iLName">Last Name</label>
                    <input name="iLName" type="text" class="form-control input-box" placeholder="Last Name" required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="iGender">Gender</label>
                    <select name="iGender" class="form-control" required>
                        <option value="" selected disabled>Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="iBDate">Birthday (D/M/Y)</label>
                    <input name="iBDate" type="date" class="form-control input-box" required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control input-box" placeholder="Username" name="username" required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control input-box form-password" placeholder="Password" name="password" required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control input-box form-password" placeholder="Confirm Password" name="confirm_password" required>
                </div>
            </div>
        </div>
        <div class="py-3">
            <input type="checkbox" class="form-checkbox"> Show Password
        </div>

        <button class="btn btn-primary btn-block" type="submit">Register</button>

    </form>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });
    });
</script>
