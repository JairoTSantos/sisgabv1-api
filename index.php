<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <title>SISGAB :: Acácio Favacho</title>
        <link href="www/vendor/bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="www/css/custom.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="vh-100 d-flex align-items-center justify-content-center">                                
                        <div class="card mx-auto" style="width: 35em">
                            <div class="card-body">  
                                <center><h4>Deputado Acácio Favacho</h4></center>
                                <br>
                                <div class="alert alert-danger" id="alerta" role="alert">
                                    Ponto ou senha invalidos!
                                </div>
                                <form id="form_login" >
                                    <input type="text" class="form-control mb-3" name="ponto" id="username" placeholder="Somente números">
                                    <input type="password" class="form-control mb-3" name="senha" id="password" placeholder="Insira sua senha">
                                    <button type="button" id="btn_login" class="btn btn-primary">Entrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="www/vendor/jquery/jquery-3.6.4.min.js"></script>
        <script src="www/app/login.js?t=<?php echo time(); ?>"></script>
        <script src="www/vendor/bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>