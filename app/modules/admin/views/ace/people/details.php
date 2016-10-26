<script src="/statics/manager/default/js/parsley.min.js"></script>
<link rel="stylesheet" href="/statics/admin/default/css/datetimepicker.css" />
<script type="text/javascript" src="/statics/admin/default/js/bootstrap-datetimepicker.min.js"></script>

<form action="/admin/people/<?php echo isset($item) ? "edit/{$item->id}"  : 'create'; ?>" method="post" class="form-horizontal">
<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5><?php echo $tip?>卡</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <label class="control-label">会员卡号</label>
                    <div class="controls">
                        <span><?php echo isset($item) ? $item->no : time(); ?></span>
                        <input type="text" name="no" value="<?php echo isset($item) ? $item->no : time(); ?>" style="display:none;">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">会员积分</label>
                    <div class="controls">
                        <span><?php echo isset($item) ? $item->score : '0'; ?></span>
                        <input type="text" name="score" value="<?php echo isset($item) ? $item->score : '0'; ?>" style="display:none;">
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5><?php echo $tip?>资料</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="control-group">
                    <label class="control-label">真实姓名</label>
                    <div class="controls">
                        <input type="text" name="name" value="<?php echo isset($item) ? $item->name : ''; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">昵称</label>
                    <div class="controls">
                        <input type="text" name="nick" value="<?php echo isset($item) ? $item->nick : ''; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">生日</label>
                    <div class="controls">
                        <div class="input-append date form_datetime" id="start_date">
                            <input style="width: 110px;" name="birthday" type="text" value="2014-05-23 00:00:00" readonly="">
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">QQ号码</label>
                    <div class="controls">
                        <input type="text" name="qq" value="<?php echo isset($item) ? $item->qq : ''; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">微信号码</label>
                    <div class="controls">
                        <?php //echo isset($item) ? (empty($item->weixin->nickname) ? $item->weixin->openid : $item->weixin->nickname) : '<a href="#" class="btn btn-mini btn-success">绑定微信</a>'; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">手机号码</label>
                    <div class="controls">
                        <input type="text" name="phone" value="<?php echo isset($item) ? $item->phone : ''; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">所在地区</label>
                    <div class="controls">
                        <select id="province" name="province">
                            <option value="1">省份</option>
                        </select>
                        <select id="city" name="city">
                            <option value="1">城市</option>
                        </select>
                        <select id="county" name="county">
                            <option value="1">区/县</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">详细地址</label>
                    <div class="controls">
                        <input type="text" name="address" value="<?php echo isset($item) ? $item->address : ''; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">备注</label>
                    <div class="controls">
                        <input type="text" name="remark" value="<?php echo isset($item) ? $item->remark : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
	$(function(){
		$("a[class='btn btn-info']").click(function(){
			$("#remark").show();
			$(this).hide();
		});
        $("#location").click(function(){
            if($(this).val().length < 3){
                map_search();
            }else{
                change_maps();
            }
        });
		$("#location").change(function(){
			var index = $(this).val().indexOf(",");
			if(index > -1){
				$("input[name='x']").val($(this).val().substring(0, index));
				$("input[name='y']").val($(this).val().substring(index + 1));
			}
		});
        $("#location").click(function(){
            if($(this).val().length < 3){
                map_search();
            }else{
                change_maps();
            }
        });
        $("#frmDetail").parsley( { listeners: {
            onFieldValidate: function ( elem ) {
                // if field is not visible, do not apply Parsley validation!
                if ( !$( elem ).is( ':visible' ) ) {
                    return true;
                }

                return false;
            },
            onFormSubmit: function ( isFormValid, event ) {
                if(isFormValid) {
                    
                    return true;
                }
            }
        }});
	});

    function map_search(){
        /*location = new BMap.LocalSearch(map, {
            renderOptions:{map : map}
        });
        location.search($("#address").val());*/
    }

    function change_maps(){
        // 百度地图API功能
        var map = new BMap.Map('map');
        var poi = new BMap.Point($("#location").val());
        map.centerAndZoom(poi, 16);
        map.enableScrollWheelZoom();

        var content = '<div style="margin:0;line-height:20px;padding:2px;">显示内容</div>';

        //创建检索信息窗口对象
        var searchInfoWindow = null;
        searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
                title  : "显示标题",      //标题
                width  : 290,             //宽度
                height : 105,              //高度
                enableAutoPan : true,     //自动平移
                searchTypes   :[
                    BMAPLIB_TAB_TO_HERE,  //到这里去
                    BMAPLIB_TAB_FROM_HERE //从这里出发
                ]
            });
        var marker = new BMap.Marker(poi); //创建marker对象
        marker.enableDragging(); //marker可拖拽
        marker.addEventListener("click", function(e){
            searchInfoWindow.open(marker);
        })
        map.addOverlay(marker); //在地图中添加marker
        searchInfoWindow.open(marker); //在marker上打开检索信息串口
    }
</script>
<script type="text/javascript">
    myRegion = new Array('<?php echo isset($item->province) ? $item->province : '' ?>', '<?php echo isset($item->city) ? $item->city : '' ?>', '<?php echo isset($item->county) ? $item->county : '' ?>');
    $(function(){
        getRegion(0, 'province', myRegion[0]);
        getRegion(myRegion[0], 'city', myRegion[1]);
        getRegion(myRegion[1], 'county', myRegion[2]);

        $("#province").change(function(){
            $("#city option").remove();
            $("#city").append("<option value='-1'>城市</option>");
            if(contains(new Array('10', '11', '30'), $(this).val())){
                $("#city").append("<option value='" + $(this).val() + "'>" +$(this).find("option:selected").text() + "</option>");
                getRegion($(this).val(), 'county', '');
            }else{
                getRegion($(this).val(), 'city', '');
            }           
        });
        $("#city").change(function(){
            $("#county option").remove();
            $("#county").append("<option value='-1'>区县</option>");         
            getRegion($(this).val(), 'county', '');
        });

        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-dd",
            pickTime:false,
            autoclose: true,
            todayBtn: true,
            startDate: '<?php echo date('Y-01-01', time())?>',
            minuteStep: 10
        });
    });

    function getRegion(pid, cmb, defaultValue){
        $.get('/common/region/' + pid,
            function(data, status){
                if(data.status == 'succ'){
                    items = data.data;
                    for (var i = items.length - 1; i >= 0; i--) {
                        if(items[i].region_code == defaultValue){
                            $("#" + cmb).append("<option value='" + items[i].region_code + "' selected='selected'>" + items[i].region_name + "</option>");
                        }else{
                            $("#" + cmb).append("<option value='" + items[i].region_code + "'>" + items[i].region_name + "</option>");
                        }
                        
                    };
                }
            }, 'json');
    }

    function contains(items, item) {
        for (var i = 0; i < items.length; i++) {
            if (items[i] === item) {
                return true;
            }
        }
        return false;
    }
</script>