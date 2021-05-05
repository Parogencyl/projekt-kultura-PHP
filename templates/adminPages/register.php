<?php
    $error = '';
    if(!empty($params['errorPassword'])){
        if($params['errorPassword'] == 'passwordCharacters'){
            $error .= "Hasło powinno zawierać co najmniej 8 znaków, w tym małą, dużą literę oraz cyfrę.<br>";
        } else if($params['errorPassword'] == 'passwordConfirmation'){
            $error .= "Podane hasła są niepoprawne.<br>";
        } else if($params['errorPassword'] == 'notPassword'){
            $error .= "Należy podać hasło.<br>";
        }
    }
    if(!empty($params['errorEmail'])){
        if($params['errorEmail'] == 'emailCharacters'){
            $error .= "Podany email jest nieprawidłowy.<br>";
        } else if($params['errorEmail'] == 'emailTaken'){
            $error .= "Podany email jest już zajęty.<br>";
        }
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rejestracja</div>

                <div class="card-body">

                    <form method="POST" action="/projekt-kultura/admin.php/?page=register">

                        <?php if($error != ''): ?>
                            <div class="alert alert-danger alert-block col-12 my-3">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong> <?php echo $error ?> </strong>
                            </div>
                        <?php endif; ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Imię</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required
                                    autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required
                                    autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Hasło</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Powtórz
                                hasło</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Utwórz konto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>