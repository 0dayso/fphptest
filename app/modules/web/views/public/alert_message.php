<link href="/statics/plugs/layer/skin/layer.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/statics/plugs/layer/layer.js"></script>
<script type="text/javascript"> 
    function showResultMessage(title, text, status){
        var ico_num = 1;
        if(status == 'success' || status == 'succ'){
           ico_num =10;
        }else if(status == 'error' || status == 'err'){
            ico_num =2;
        }
        layer.msg(title);
    }
</script>

<?php $msg = \Session::get_flash('msg'); ?>
<?php if($msg){ ?>
<script type="text/javascript"> 
<?php
    $error_item = '';
    if(isset($msg["data"]) && $msg["data"]){
        foreach($msg["data"] as $key => $value){
            $error_item .= "{$key}{$value}<br>";
        }
    } 
?>
showResultMessage(<?php echo "'{$msg['msg']}', '{$error_item}'," . ($msg["status"] == "succ" ? "'success'" : "'error'");?>);
</script>
<?php } ?>
