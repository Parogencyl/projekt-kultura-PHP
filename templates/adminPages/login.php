<?php
    $error = '';
    if($params['error']){
       if($params['error'] === 'emptyForm'){
           $error = "Dane zostały niepoprawnie przesłane";
        } else if($params['error'] == 'wrongData'){
            $error = "Podane dane są niepoprawne";
       }
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Administracja</div>

                <div class="card-body">

                    <form method="POST" action="/projekt-kultura/admin.php/?page=login">
                    
                    <?php if($error != ''): ?>
                            <div class="alert alert-danger alert-block col-12 my-3">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong> <?php echo $error ?> </strong>
                            </div>
                        <?php endif; ?>
                    
                    <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"> Email </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required
                                    autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Hasło</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Zaloguj
                                </button>

                                <a class="btn btn-link" href="/projekt-kultura/admin.php/?page=forgetPassword">
                                    Nie pamiętam hasła
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>