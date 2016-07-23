<?
function __autoload($ClassName){require_once 'classes/'.$ClassName.'.php';}//ЗАгрузка класов из папки
 $session = new Session();
$ses=$session->start();
$master_id = $session->get('id');
//Запись лога в БД
$logs = new Log();
$event = "выход из системы";
$data = $logs->save($master_id, $event);
 echo"
<script>
function timer(){
	var obj=document.getElementById('timer_inp');
	obj.innerHTML--;
	if(obj.innerHTML==0){setTimeout(function(){},500);}
	else{setTimeout(timer,500);}
}
setTimeout(timer,500);
</script>

 <meta http-equiv='Content-Type' content=text/html; charset=utf-8>Доступ на эту страницу разрешен только
 зарегистрированным пользователям. Если вы зарегистрированы, то войдите на сайт под своим логином и паролем<br>
 Через <span id='timer_inp'>5 </span> секунд <a href='index.php'>Страница входа</a>";

unset($_SESSION['password']);
unset($_SESSION['login']);
unset($_SESSION['id']);
exit("<html><head><meta http-equiv='Refresh' content='4; URL=http://$_SERVER[SERVER_NAME]'></head></html>");