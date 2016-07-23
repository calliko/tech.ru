<?ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function __autoload($ClassName){include_once 'classes/'.$ClassName.'.php';}//ЗАгрузка класов из папки
 $session = new Session();
$ses=$session->start();
if(!empty($_SESSION['id'])){
    echo "<html><head><meta http-equiv='Refresh' content='0; URL=../dashboard.php'></head></html>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CУ для СЦ | Компьюти</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="css/my_style.css" rel="stylesheet" type="text/css" />
        <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?=$config['home'];?>/img/favicon.ico">
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">

<div class="login-box">
    <div class="login-logo"><img src="img/logo.png"></div>
    <div class="login-box-body">
        <p class="login-box-msg">Войти, чтобы начать сеанс</p>
        <form action="controllers/login.controller.php" method="post">
            <div class="form-group has-feedback">
                <input type="login"  name="login" class="form-control" placeholder="Логин" required/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password"  name="password"  class="form-control" placeholder="Пароль"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember_me"> Запомнить меня
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
                </div><!-- /.col -->
            </div>
        </form>

      <?/*  <a href="#">Напомнить пароль</a><br>
        <a href="register.html" class="text-center">Регистрация</a>*/?>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/app.min.js" type="text/javascript"></script>
<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
    </body>
</html>