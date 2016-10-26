<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>微信安全支付</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .btn{
            width:210px; 
            height:30px; 
            background-color:#FE6714; 
            border:0px #FE6714 solid; 
            cursor: pointer;  
            color:white;  
            font-size:16px; 
            padding: 10px 20px;
            text-decoration: none;
        }
    </style>
    <script type="text/javascript">

        //调用微信JS api 支付
        function jsApiCall()
        {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                <?php echo htmlspecialchars_decode($params); ?>,
                function(res){
                    if(res.err_msg == 'get_brand_wcpay_request:ok'){
                        window.location.href = '<?php echo \Input::get('to_url', false) ? urldecode(\Input::get('to_url')) : '/'; ?>';
                    }else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
                        alert('您取消了支付!');
                        window.close();
                    }
                }
            );
        }

        function callpay()
        {
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        }

        function to_url(){
            window.location.href = 'http://mall.evxin.com/services/gateway/pay/wxpay?wechat_open_id=omRMNt6mZyVqHkccpnUDkXxTeikY&account_id=1';
        }

    </script>
</head>
<body onload="javascript:callpay();">
    <div style="margin: 20px;">
        页面跳转中...
        <br>
        如您不能跳转，请点击
        <a class="btn" href="javascript:callpay()">支付</a>
    </div>
</body>
</html>