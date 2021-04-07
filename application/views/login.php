<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-12 col-md-9">
        <?php
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-danger">' . $this->session->flashdata('message') . '</div>';
        }
        ?>
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
                            <form class="user" method="post" action="<?= base_url('index.php/auth/login'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" aria-describedby="emailHelp" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
