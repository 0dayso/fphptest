<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo isset($title) && $title ? $title : ''; ?></title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="/assets/css/jquery.mobile-1.3.2.min.css" rel="stylesheet">-->
    <link href="/assets/third-party/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/assets/js/jquery-1.11.1.min.js"></script>

    <style type="text/css">
    .parsley-errors-list{
        list-style: none;
        color: red;
    }
    </style>

</head>
<body>

<?php echo render('default/public/nav'); ?>

<?php echo isset($content) ? $content : "控制器未返回内容"; ?>

<div class="modal fade" id="changePwdModal" tabindex="-1" role="dialog" aria-labelledby="changePwdModalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="changePwdModalTitle"> 修改密码 </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form role="form" method="post">
                        <div class="form-group">
                            <input type="password" class="form-control" id="oldPwd" name="oldPwd" placeholder="原密码">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="newPwd" name="oldPwd" placeholder="新密码">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confirmPwd" name="oldPwd" placeholder="确认密码">
                        </div>
                        <button type="button" id="btnSubmit" class="btn btn-default">确认修改</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
    $('#btnSubmit').click(function(){
        var msg = '';
        if($('#oldPwd').val().length < 1){
            msg = '原密码不能为空!';
        }else if($('#newPwd').val().length < 1){
            msg = '新密码不能为空!';
        }else if($('#newPwd').val() != $('#confirmPwd').val()){
            msg = '新密码与确认密码不一致！';
        }

        if(msg != ''){
            alert(msg);
            return false;
        }

        $.post('/admin/home/change',
            {
                oldPwd : $('#oldPwd').val(),
                newPwd :$('#newPwd').val()
            }, 
            function(data, status){
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }
                $('#oldPwd').val('');
                $('#newPwd').val('');
                $('#confirmPwd').val('');
                alert('密码修改成功!');
            }, 'json');
    });
});
</script>
</body>
</html>