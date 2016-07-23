<?
include('includes/header.php');
$acc = new Access();
$access = $acc->getAccess(3,$user['role']);//3 доступ в административную панель
if(isset($access['id'])){ ?>

<aside class="right-side"><section class="content-header"><h1> Общая информация</h1>
<ol class="breadcrumb"><li class="active"><i class="fa fa-dashboard"></i> Общая информация</li></ol> </section>
<!-- скрипт всплывающего сообщения после обработки формы после перезагрузки-->
<? include('includes/message.php');?>
<!-- скрипт всплывающего сообщения после обработки формы после перезагрузки-->

<section class="content">
<?if($user['user_status'] != "admin") {echo "У вас нет прав для просмотра <a href='index.php'>вернуться назад</a>"; exit; }?>
<? include('includes/fast_action_panel.php');?><!--панель быстрых действий-->

<div class="row"><div class="col-lg-3 col-xs-6"><div class="small-box bg-aqua"> <div class="inner"><h3>
            <?  $Rashodnik = new Rashodnik();
                $kolich_rashod = $Rashodnik->countRashodnik('normal');
                echo $kolich_rashod[0]; ?></h3><p>Запчасти и расходники</p></div>
    <div class="icon"><i class="fa fa-cogs"></i></div>
    <a href="<?=$config['home'];?>/spares.php" class="small-box-footer">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
    </div></div>

             <div class="col-lg-3 col-xs-6"><div class="small-box bg-green"><div class="inner"><h3>
                             <?
           $Tech = new Tech();
           $kolich_techs = $Tech->countTech('normal');
      echo $kolich_techs[0]; ?></sup></h3><p>Оборудование</p></div>
                <div class="icon"><i class="fa fa-print"></i></div>
                <a href="<?=$config['home'];?>/tech_cat.php?status=normal" class="small-box-footer">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
                </div></div>

              <div class="col-lg-3 col-xs-6"><div class="small-box bg-yellow">
               <div class="inner"><h3><?=$koluser[0];?></h3><p>Клиенты</p></div>
               <div class="icon"><i class="fa fa-user"></i></div>
               <a href="<?=$config['home'];?>/users.php?status=client" class="small-box-footer">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
               </div></div>


               <div class="col-lg-3 col-xs-6"><div class="small-box bg-red">
                <div class="inner"><h3>65</h3><p>Unique Visitors</p></div>
                <div class="icon"><i class="fa fa-truck"></i></div>
                <a href="#" class="small-box-footer">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
                </div></div></div>

<div class="row"><section class="col-lg-7 connectedSortable">
<div class="nav-tabs-custom"><ul class="nav nav-tabs pull-right">
<li class="pull-left header"><i class="fa fa-inbox"></i> Заработано Вами  за <?=$year=date('Y');?> год</li></ul>
<div class="tab-content no-padding"><div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div></div></div>

<script>
  $(function() {
$("#calendar").datepicker();
       var area = new Morris.Area({
       element: 'revenue-chart',
       data: [
 <? $getRemontForYear = new Remont();
    $get = $getRemontForYear->getRemontForYears($user['id']);
    ?>
          ],
          // имя для оси x
          xkey: 'manth',
          xLabels:'month',
          // имена графиков для оси y.
          ykeys: ['value'],
          // Ярлыки для графиков - показываются при наведении на график
          labels: ['Рублей']
      });
  });
</script>
</section>
                       
<section class="col-lg-5 connectedSortable">
<script>
    //прокрутка скрола вниз
    window.onload = function(){
    var block = document.getElementById("chat-box");
    block.scrollTop = 9999; }
    $(document).on('click','.name',function(e){
        var name = $(this).text()+", ";
        $("#message").val(name).focus();
    });
</script>
    
<div class="box box-success"><div class="box-header"><i class="fa fa-comments-o"></i>
<h3 class="box-title">Общий чат</h3><div class="box-tools pull-right"><div class="btn-group" >
<a onclick="window.location.reload()" ><button type="button"  data-toggle="tooltip" title="Обновить ленту" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
<a href="controllers/chat_delete_model.php" onclick='return confirm(\"Вы уверены, что хотите очитстить ленту сообщений?\")' > <button type="button" data-toggle="tooltip" title="Очистить ленту" class="btn btn-default btn-sm"><i class="fa fa-eraser"></i></button></a>
</div></div></div>

<div class="box-body chat " id="chat-box" style="overflow-y:auto;height: 240px">
<? $chats = new Chat();
  $chatz = $chats->getChat();

   foreach ($chatz as $chat)
                     {
 echo" <div class='item'><img src='$config[home]/img/$chat[avatar]' /><p class='message'>
 <small class='text-muted pull-right'><i class='fa fa-clock-o'> $chat[time]</i></small>
 <a  class='name' style='cursor: pointer;'>$chat[user] </a>$chat[message]</p></div>";
       }
                     ?>
</div>
<form id='myform' role="form" action="javascript:send('controllers/chat_add_controller.php','myform','result');" method="post">
<div class="box-footer"><div class="input-group">
<input type="text" class="form-control" id="message" name="message" placeholder="Отправить сообщение..."/>
<div class="input-group-btn">
<button type="submit" class="btn btn-success" onclick="window.location.reload()"><i class="fa fa-plus"></i></button>
</div></div></div></form></div></section>

<div class="col-md-6"><div class="box box-solid"><div class="box-header">
<h3 class="box-title">Последние 20 действий</h3><div class="box-tools pull-right">
<button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
</div></div><div class="box-body"  style="max-height: 200px; overflow: auto;">
<?
$logss = new Log();
$logs = $logss->listLog(20);
$i=0;
    foreach($logs as $log){
        $userlog = new User();
        $uslog = $userlog->getUser($log['user']);

echo ++$i,". ",$log['date']," <a href='user_edit.php?id=",$uslog['id'],"'>",$uslog['user_nicename'],"</a> ",$log['event'],"<br>";


    }
?>
</div></div></div>
<script type="text/javascript"> $(function() { $("[data-mask]").inputmask();  }); </script>
</section></aside>
<?}else echo '<div style="margin-left: 300px">У вас нет доступа в административную панель</div>';?>
<? include('includes/footer.php');?>