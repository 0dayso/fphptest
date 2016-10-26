<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title></title>
    <script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js"></script>
</head>

<body>
    <form action="/test/alipay" method="post">
        <ul>
            <li>金额：<input type="text" name="original_money" value=""></li>
            <li>
                订单状态：
                <select name="order_status">
                    <?php foreach (\Model_Order::$_maps['status'] as $key => $value) { ?>
                        <option value="<?php echo $key;?>"><?php echo $value;?></option>
                    <?php } ?>                    
                </select>
            </li>
            <li>
                支付类型：
                <select name="payment_type">
                    <option value="alipay">支付宝</option>
                    <option value="tenpay">微支付</option>
                </select>
            </li>
            <li>
                订单类型：
                <select name="order_type">
                    <option value="SELL">销售单</option>                   
                </select>
            </li>
            <li>购买人ID：<input type="text" name="user_id" value=""></li>
            <li>卖家ID：<input type="text" name="from_id" value=""></li>
            <li><button type="submit">创建订单并支付</button></li>
        </ul>
    </form>
</body>
</html>