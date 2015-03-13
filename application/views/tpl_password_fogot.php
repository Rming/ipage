<div class="container">
    <div class="brand_box">
    </div>
    <div class="box user_box">
        <form action="" method="post">
        <table cellpadding="5" cellspacing="0" border="0" width="100%">
            <tbody>
			<tr>
                <td class="form_label">电子邮箱</td>
                <td class="form_input">
                	<input type="email" name="email" class="xl"/>
				</td>
            </tr>
            <tr>
            	<td></td>
            	<td class="form_tips"  id="email"></td>
            </tr>
            <tr>
                <td class="form_label">验证码</td>
                <td class="form_input">
                	<input type="text"  name="vcode" class="xs">
                	<span class="form_vcode">
                		<script src="<?=base_url('imgauthcode/show_script')?>"></script>
                	</span>
				</td>
            </tr>
            <tr>
            	<td></td>
            	<td class="form_tips" id="vcode"></td>
            </tr>
            <tr>
                <td ></td>
                <td >
                    <button type="button" class="btn btn-default form_submit" >找回密码</button>
                    <a  class="btn btn-default btn-second"  href="<?=site_url('user/login');?>">返回登陆</a>
                </td>
            </tr>
        </tbody>
        </table>
        </form>
    </div>
</div>

<script type="text/javascript">
    $('.form_submit').click(function(e) {
        var current_form = $(this).parents().find('form');
        $.post(
            window.location.href+'?t=1',
            current_form.serialize(),
            function(data) {

                error_input =  new Array();
                var elements = current_form.children().find('input');
                input_ele_set(elements, data);

                if(data.error_code ==1){
                    if(error_input.length>0){
                        error_input[0].focus();
                    }
                }else{
                    var success = "success~~";
                    $.scojs_message(success, $.scojs_message.TYPE_OK);
                    setTimeout('redirectNext()',2000);
                }
                $('#img_authcode').click();
        });
    });
    var input_ele_set = function(elements , data){
        elements.each(function() {
            var notice_id   = $(this).attr('name');
            var error_data  = data.data[notice_id];
            if(typeof(error_data)=='undefined'){
                $(this).removeClass('error_input');
                $('#'+notice_id).removeClass('error_tips');
                $('#'+notice_id).html('');
            }else{
                $(this).addClass('error_input');
                $('#'+notice_id).addClass('error_tips');
                $('#'+notice_id).html(data.data[notice_id]);
                error_input.push(this);
            }
        });
    }
    var redirectNext = function(){window.location.href = "http://m.baidu.com";}
</script>
<script type="text/javascript">
    $('input').keydown(function(event) {
        var keyCode = event.which;
            if (keyCode == 13){
                $('.form_submit').click();
            }
    });
</script>
