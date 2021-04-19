<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <span class="h4 text-gray-900 mb-4">ADMIN PANEL</span>
                                <hr>
                            </div>
                            <form class="user" method="post" action="<?= base_url('index.php/auth/register'); ?>">
                                <?php
                                if ($this->session->tempdata('danger')) {
                                    echo '<div class="alert alert-danger">' . $this->session->tempdata('danger') . '</div>';
                                } else if ($this->session->tempdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->tempdata('success') . '</div>';
                                }
                                ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="repeat_password" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                            </form>
                            <div class="text-center mt-3">
                                <a href="<?= base_url('index.php/auth'); ?>">Already have an account?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>