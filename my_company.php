<? include('includes/header.php');
    $acc = new Access();
    $access = $acc->getAccess(3,$user['role']);//3 доступ в административную панель
    if(isset($access['id'])){ ?>

<aside class="right-side">
 <section class="content-header">
  <h1>Моя компания</h1>
<ol class="breadcrumb">
   <li><a href="<?=$config['home'];?>/dashboard.php"><i class="fa fa-dashboard"></i> Общая информация</a></li>
   <li class="active"><i class="fa fa-home"></i> Моя компания</li>
</ol>
</section>

<section class="content">
<?if($user['user_status'] != "admin") {echo "У вас нет прав для просмотра <a href='index.php'>вернуться назад</a>"; exit; }?>
<? include('includes/fast_action_panel.php');?><!--панель быстрых действий-->

         <div class="row">
         <div class="col-md-12">
         <div class="box-tools pull-right">
       </div>

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
    <?  $access = $acc->getAccess(6,$user['role']);//6 управление сотрудниками
    if(isset($access['id'])){ ?>
        <li><a href="#tab_1" data-toggle="tab">Сотрудники</a></li><?}?>
<!-- скрипт всплывающего сообщения после обработки формы после перезагрузки-->
<? include('includes/message.php');?>
<!-- скрипт всплывающего сообщения после обработки формы после перезагрузки-->

<?$right='5'; include('includes/access.php');if(isset($access['id'])){
    echo "<li ><a href='#tab_2' data-toggle='tab'>Роли</a></li>";}?>
    <?$right='7'; include('includes/access.php');if(isset($access['id'])){ ?>
                                    <li class="active"><a href="#tab_3" data-toggle="tab">Настройки</a></li><?}?>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane " id="tab_1">
                                       <div class="row">

<div class="col-xs-12">
    <div class="callout callout-info">
                                        <b>Сотрудники:</b>
                                        <p>Каждый сотрудник имеет свой логин и пароль для входа в систему.</p>
                                        <p>В колонке доступ указывается права и доступ сотрудника к системе.</p>
    </div>
</div>

 <div class="col-xs-12">
      <a  data-toggle="modal" data-target="#new_user"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Добавить сотрудника</button></a><br><br>
                            <div class="box">

                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Сотрудник</th>
                                            <th>Логин</th>
                                            <th>Роль</th>

                                        </tr>

<?
$admuser = new User();
$result = $admuser->getList('admin');

foreach($result as $sotrudnik){

   $id_sotr = $sotrudnik['role'];

    $roles = new Role();
    $result2 = $roles->getRole($id_sotr);

    echo"  <tr><td><a href='{$config['home']}/user_edit.php?id=$sotrudnik[id]'>",$sotrudnik['user_nicename'],"</a></td><td>",$sotrudnik['login'],"</td><td>",$result2['name'],"</td></tr>";
}    ?>
     </table>
     </div></div></div></div></div><!-- /.tab-pane -->



<div class="tab-pane " id="tab_2"><div id="role_edit"></div>
<a data-toggle="modal" data-target="#compose-modal"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Добавить роль</button></a> <br><br>
<div class="box-body table-responsive no-padding"><table style="max-width: 236px" class="table table-hover">
<tr><th>Название</th><th>Действие</th></tr>

   <?
$roles2 = $roles->getRoleStatus('normal');
   foreach ($roles2 as $role) {
       echo "</tr><td>", $role['name'],"</td><td>

     <script>$( function ready() {
    $('#".$role['id']."').click( function(eventObject) {eventObject.preventDefault();$('#role_edit').load( 'controllers/edit_role.php?id=".$role['id']."');});
});//END</script>
       <a style='cursor: pointer;' id='".$role['id']."' onchange='javascript:help();'>Редактирoвать</a></td></tr>";
    }//Это просто пиздец. Сам не знаю как вышло:))
       ?>
   </table></div></div>
    <?
    $access2 = $acc->getAccess(7,$user['role']);//3 Управление настройками компании
    if(isset($access2['id'])){ ?>
<div class="tab-pane active" id="tab_3"><div class="row"><div class="col-xs-12">
<?$options = new Options();
$company_name = $options->getOptions('company_name');
$inn = $options->getOptions('inn');
$ogrn = $options->getOptions('ogrn');
$address = $options->getOptions('address');
$telephone = $options->getOptions('telephone');
$kpp = $options->getOptions('kpp');
$rs = $options->getOptions('rs');
$ks = $options->getOptions('ks');
$bank = $options->getOptions('bank');
$bik = $options->getOptions('bik');
$guarantee = $options->getOptions('guarantee');
$valuta = $options->getOptions('valuta');
?>
<div class="form-group"><form  id='myform1' role="form" action="javascript:send('controllers/option_controller.php','myform1','result');"  method="post">
<div class="input-group input-group-sm">
<span class="input-group-addon" style="width: 140px" data-rel="tooltip" title="Название компании будет отображаться в документах и счетах">Название компании:</span>
<input type="text" name="company_name" class="form-control" value="<?=$company_name['value']; ?>">
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button>
</span></div></form></div>

<div class="form-group"><form  id='myform2' role="form"  action="javascript:send('controllers/option_controller.php','myform2','result');"  method="post">
<div class="input-group input-group-sm">
<span class="input-group-addon" style="width: 140px" data-rel="tooltip" title="Введите ИНН компании, ИП">ИНН:</span>
<input type="text" name="inn" class="form-control" value="<? echo $inn['value']; ?>">
<span class="input-group-btn"><button type="submit" class="btn btn-primary ">Сохранить</button>
</span></div></form></div>

<div class="form-group">
<form  id='myform3' role="form"  action="javascript:send('controllers/option_controller.php','myform3','result');"   method="post">
<div class="input-group input-group-sm">
<span class="input-group-addon" style="width: 140px" data-rel="tooltip" title="Введите ОГРН">ОГРН:</span>
<input type="text" name="ogrn" class="form-control" value="<? echo $ogrn['value']; ?>">
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button>
</span></div></form></div>

<div class="form-group">
<form  id='myform4' role="form"  action="javascript:send('controllers/option_controller.php','myform4','result');"   method="post">
<div class="input-group input-group-sm">
<span class="input-group-addon" style="width: 140px" data-rel="tooltip" title="Индекс, область, населенный пункт, улица, дом">Адрес:</span>
<input type="text" name="address" class="form-control"  placeholder="233346, г. Пышма" value="<? echo $address['value']; ?>">
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button>
</span></div></form></div>

<div class="form-group">
<form id='myform6' role="form" action="javascript:send('controllers/option_controller.php','myform6','result');" method="post">
<div class="input-group input-group-sm">
<span class="input-group-addon" style="width: 140px" data-rel="tooltip">Телефон:</span>
<input type="text" name="telephone" value="<?=$telephone['value'];?>" class="form-control" />
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button></span></div></form></div>

 <div class="form-group">
<form id='myform7' role="form" action="javascript:send('controllers/option_controller.php','myform7','result');" method="post">
<div class="input-group input-group-sm"><span class="input-group-addon" style="width: 140px" data-rel="tooltip">КПП:</span>
<input type="text" name="kpp" value="<?=$kpp['value'];?>" class="form-control" />
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button></span></div></form></div>

<div class="form-group">
<form id='myform8' role="form" action="javascript:send('controllers/option_controller.php','myform8','result');" method="post">
<div class="input-group input-group-sm"><span class="input-group-addon" style="width: 140px" data-rel="tooltip">Расчетный счет:</span>
<input type="text" name="rs" value="<?=$rs['value'];?>" class="form-control" />
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button></span></div></form></div>

<div class="form-group">
<form id='myform9' role="form" action="javascript:send('controllers/option_controller.php','myform9','result');" method="post">
<div class="input-group input-group-sm"><span class="input-group-addon" style="width: 140px" title="Корреспондентский счет" data-rel="tooltip">Корр. счет:</span>
<input type="text" name="ks" value="<?=$ks['value'];?>" class="form-control" />
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button></span></div></form></div>

<div class="form-group">
<form id='myform10' role="form" action="javascript:send('controllers/option_controller.php','myform10','result');" method="post">
<div class="input-group input-group-sm"><span class="input-group-addon" style="width: 140px"  title="Наименование и адрес банка"data-rel="tooltip">Банк:</span>
<input type="text" name="bank" value="<?=$bank['value'];?>" class="form-control" />
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button></span></div></form></div>

<div class="form-group">
<form id='myform11' role="form" action="javascript:send('controllers/option_controller.php','myform11','result');" method="post">
<div class="input-group input-group-sm"><span class="input-group-addon" style="width: 140px"  title="БИК"data-rel="tooltip">БИК:</span>
<input type="text" name="bik" value="<?=$bik['value'];?>" class="form-control" />
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button></span></div></form></div>

<div class="form-group">
<form id='myform12' role="form" action="javascript:send('controllers/option_controller.php','myform12','result');" method="post">
<div class="input-group input-group-sm">
<span class="input-group-addon" style="width: 140px"  title="Гарантия сервисного центра(по умолчанию)" data-rel="tooltip">Гарантия(дней):</span>
<input type="text" name="guarantee" value="<?=$guarantee['value'];?>" class="form-control" />
<span class="input-group-btn"><button type="submit" class="btn btn-primary">Сохранить</button></span></div></form></div>


            </div>
 </div></div><?}?></div></div></div></div>


<!-- Модальное окно нового сотрудника -->
<div class="modal fade" id="new_user" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog"><div class="modal-content"><div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title"><i class="fa fa-user"></i> Новый сотрудник</h4></div>
<form action="controllers/worker_add_controller.php" method="post">
<div class="modal-body"><div class="form-group"><div class="input-group">
<span style="width: 140px"class="input-group-addon">Имя*:</span>
<input name="name" type="text" class="form-control" placeholder="Имя сотрудника"></div></div>

<div class="form-group"><div class="input-group"><span style="width: 140px"class="input-group-addon">Логин*:</span>
<input name="login" type="text" class="form-control" placeholder="login"></div></div>

<div class="form-group"><div class="input-group"><span style="width: 140px"class="input-group-addon">Пароль*:</span>
<input name="password" type="password" class="form-control" placeholder="password"></div></div>

<div class="input-group input-group-sm">
<span class="input-group-addon" style="width: 140px"  title="Роль*" data-rel="tooltip">Роль:</span>
<select class="form-control" name="role" data-placeholder="- Выберите из списка -" onchange="javascript:selectOperation();">
 <?
 echo "<option value=''>- Выберите-</option>\n";
 foreach($roles2 AS $roli){
 echo "<option value='" . $roli['id'] . "'> " . $roli['name'] . "</option>\n";}
 ?>
</select></div></div>
<div class="modal-footer clearfix">
<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Отмена</button>
<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Добавить</button>
 </div></form></div></div></div>
<!-- Модальное окно нового сотрудника -->

<!-- Модальное окно новой роли -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog"><div class="modal-content"><div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title"><i class="fa fa-lock"></i> Новая роль</h4></div>
<form action="controllers/role_add_controllerphp" method="post"><div class="modal-body">
<div class="form-group"><div class="input-group"><span class="input-group-addon">Название*:</span>
<input name="name_role" type="text" class="form-control" placeholder="Название роли"></div></div></div>
<div class="modal-footer clearfix">
<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Отмена</button>
<button type="submit" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Добавить</button>
</div></form></div></div></div>
<!-- Модальное окно новой роли -->

<script type="text/javascript"> $(function() { $("[data-mask]").inputmask();  }); </script>
</section></aside>
    <?}?>
<? include('includes/footer.php');?>