<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
    function checkInfo()
    {
        if($("#cc_staff").val()=='')
          {
              alert('对不起，收件人不能为空！');return false;
          }
        if($("#title_email").val()=='')
         {
              alert('对不起，标题不能为空！');return false;
         }
            showdiv('<img src=<?php echo $base_url;?>img/loading.gif border=0 />&nbsp;&nbsp;'+'正在发送，请稍候……');
    }
    $(function(){
        $("#city").change(function(){

            $("#staff_email").empty();
            $.ajax({
                type:"post",
                data: "cid=" + $(this).val(),
                url:"<?=$this->config->item('base_url')?>index.php/personnel/TrainController/ajaxGetDep/",

                beforeSend: function() {
                    $("#staff_email").empty();
                    $("#staff_email").append('<option value=>读取中……</option>');
                },

                success: function(result)
                {
                    //alert(result);return false;
                    if($("#city").val()=='0' || $("#city").val()=='1000')
                    {
                        $("#staff_email").empty();
                        $("#cc_staff").empty();
                        $("#cc_staff").val(result);
                    }else{
                        $("#staff_email").empty();
                        $("#staff_email").append(result);
                    }
                }
            });
        })
    })
 $(function(){
	$("#staff_email").change(function(){

		str=$('#mail_value').val();
		//alert($("#staff option").size());return false;
		if($(this).val()=='0')
		{
			//alert($("#staff").get(0).options[i].value);return false;

			for(var i=0;i<$("#staff_email option").size();i++)
			{

				if($("#staff_email").get(0).options[i].value !='0')
				{
					staff_str	= $(str).val();
					//alert($("#staff").get(0).options[i].text);return false;
                                        
					if(staff_str.indexOf($("#staff_email").get(0).options[i].text+'-'+$("#staff_email").get(0).options[i].value)<0)
					{
                                            $(str).val(staff_str+$("#staff_email").get(0).options[i].value+';');
                                            //$(str).val(staff_str+$("#staff").get(0).options[i].text+''+$("#staff").get(0).options[i].value+';');
					}
				}
			}
		}else{

			if($("#staff_email option[selected]").length>1)
			{
				return false;
			}

			staff_str	= $(str).val();

			if(staff_str.indexOf($("#staff_email option[selected]").text()+''+$(this).val())<0)
			{
				$(str).val(staff_str+$("#staff_email option[selected]").text()+''+$(this).val()+';');
			}
		}
		return false;
	})

	$("#staff_email").dblclick(function(){

        str=$('#mail_value').val();
		staff_str	= $(str).val();

		if(staff_str.indexOf($("#staff_email option[selected]").text()+''+$(this).val())>=0)
		{
			$(str).val(staff_str.replace($("#staff_email option[selected]").text()+''+$(this).val()+';',''));
			$("#staff").val('');
		}
		return false;
	})

})

    $(function(){
        $("#mail_ca").click(function(){
            $("#cc_staff").val('');
            return false;
        })
        $("#copy_ca").click(function(){
            $("#cp_staff").val('');
            return false;
        })

        $("#cc_staff").focus(function(){
            $('#mail_value').val('#cc_staff');

        })

        $("#cp_staff").focus(function(){
            $('#mail_value').val('#cp_staff');

        })


    })
function showdiv(str)
{
	var msgw,msgh,bordercolor;
	msgw=400;//提示窗口的宽度
	msgh=100;//提示窗口的高度
	bordercolor="#336699";//提示窗口的边框颜色
	titlecolor="#99CCFF";//提示窗口的标题颜色
	var sWidth,sHeight;
	sWidth=document.body.offsetWidth;
	sHeight='400';
	var bgObj=document.createElement("div");
	bgObj.setAttribute('id','bgDiv');
	bgObj.style.position="absolute";
	bgObj.style.top="0";
	bgObj.style.background="";
	bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75";
	bgObj.style.opacity="0.6";
	bgObj.style.left="0";
	bgObj.style.width=sWidth + "px";
	bgObj.style.height=sHeight + "px";
	document.body.appendChild(bgObj);
	var msgObj=document.createElement("div")
	msgObj.setAttribute("id","msgDiv");
	msgObj.setAttribute("align","center");
	msgObj.style.position="absolute";
	msgObj.style.background="white";
	msgObj.style.font="12px/1.6em Verdana, Geneva, Arial, Helvetica, sans-serif";
	msgObj.style.border="1px solid " + bordercolor;
	msgObj.style.width=msgw + "px";
	msgObj.style.height=msgh + "px";
        msgObj.style.top=(document.documentElement.scrollTop + (sHeight-msgh)/2) + "px";
        msgObj.style.left=(sWidth-msgw)/2 + "px";
        var title=document.createElement("h4");
        title.setAttribute("id","msgTitle");
        title.setAttribute("align","right");
        title.style.margin="0";
        title.style.padding="3px";
        title.style.background=bordercolor;
        title.style.filter="progid:DXImageTransform.Microsoft.Alpha(startX=20, startY=20, finishX=100, finishY=100,style=1,opacity=75,finishOpacity=100);";
        title.style.opacity="0.75";
        title.style.border="1px solid " + bordercolor;
        title.style.height="18px";
        title.style.font="12px Verdana, Geneva, Arial, Helvetica, sans-serif";
        title.style.color="white";
        title.style.cursor="pointer";

        document.body.appendChild(msgObj);
        document.getElementById("msgDiv").appendChild(title);
        var txt=document.createElement("p");
        txt.setAttribute("id","msgTxt");
        txt.innerHTML=str;
        document.getElementById("msgDiv").appendChild(txt);

}
</script>
<script charset="utf-8" src="<?php echo $base_url;?>js/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo $base_url;?>js/kindeditor/lang/zh_CN.js"></script>
<script>

        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        KindEditor.options.filterMode = false;
</script>
<div class=spaceborder style="WIDTH: 100%;">
    <table width="100%" height="100%" border="0" bordercolor="#bdebff" cellSpacing=0 cellPadding=0>
        <td valign="top" width="160px">
            <table border="1" bordercolor="#bdebff" cellSpacing=0 cellPadding=4 height="100%">
                <tr>
                    <td class="mail_bg" width="80" height="30" background="<?php echo $base_url;?>img/mail_bg1.gif">
                        <a href="<?php echo site_url("/public/EmailController/emailListView");?>" style="text-decoration:none"><img src="<?php echo $base_url;?>img/mail_wd.png" border="0" />&nbsp;
                            <font style="font-size:16px"><b>收信</b></font>
                        </a>
                    </td>
                    <td class="mail_bg" width="80" background="<?php echo $base_url;?>img/mail_bg1.gif">
                        <a href="<?php echo site_url('/public/EmailController/emailAddView/'); ?>" style="text-decoration:none"><img src="<?php echo $base_url;?>img/mail_xx.png" border="0" />&nbsp;
                            <font style="font-size:16px"><b>写信</b></font>
                        </a>
                    </td>

                </tr>
                <tr>
                    <td class="to_td" colspan="2" height="20"><a href="<?php echo site_url("/public/EmailController/emailListView");?>" style="text-decoration:none; padding-left:20px"><img src="<?php echo $base_url;?>img/mail_inbox.gif" border="0" />&nbsp;
                            收件箱 (<?php echo $emailRecipient;?>)
                        </a></td>
                </tr>
                <tr>
                    <td class="to_td" colspan="2" height="20"><a href="<?php echo site_url("/public/EmailController/emailSentView");?>" style="text-decoration:none; padding-left:20px"><img src="<?php echo $base_url;?>img/mail_sentbox.gif" border="0" />&nbsp;
                            已发送 (<?php echo $emailSent;?>)
                        </a></td>
                </tr>
                <tr>
                    <td class="to_td" colspan="2" height="20"><a href="<?php echo site_url("/public/EmailController/emailDelView");?>" style="text-decoration:none; padding-left:20px"><img src="<?php echo $base_url;?>img/mail_trash.gif" border="0" />&nbsp;
                            已删除 (<?php echo $emailDel;?>)
                        </a></td>
                </tr>
                <tr>
                    <td class="to_td" colspan="2" height="20"><a href="<?php echo site_url("/public/EmailController/emailNreadView");?>" style="text-decoration:none; padding-left:20px; color:red">
                            未读邮件 (<?php echo $emailNoread;?>)
                        </a></td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            </table>
        </td>

        <td>
            <table width="100%" height="100%">
                <tr valign="top" align="center">
                    <td height="30px">
                        <table width="98%" height="100%" cellpadding="0" cellspacing="0">
                            <tr valign="middle">
                                <td style="text-align:left;"><img src="<?php echo $base_url;?>img/mail_xx.png" border="0" />&nbsp;<font style="font-size:16px"><b>转发邮件</b></font></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                

                <tr>
                    <td>
                        <form action="<?php echo site_url('/public/EmailController/emailInsert');?>" method="post" enctype="multipart/form-data" id="mainform" name="mainform" class="form_validation_ttip" novalidate="novalidate" onSubmit="return checkInfo();">
                        <table width="98%" height="100%" border="1" bordercolor="#bdebff" cellSpacing=0 cellPadding=0 style="margin-left:8px;">
                            <tr valign="middle">
                                <td width="10%" style="text-align: right;"><b>选择：</b></td>
                                <td class="altbg2" colspan="3" height="100px;" style="padding-left:5px; padding-top:5px;"><select name="city" id="city" style="width:300px;height:150px;" size="5" multiple >
                                        <option style="color:#F00" value="0">全部</option>
                                        <?php foreach($org as $val) { ?>
                                        <option value="<?php echo $val['sId'];?>" <?php if($sId == $val['sId']):?> selected<?php endif;?> style="<?php if($val['level']==1) {
                                                echo 'font-weight:bold;color:black;';
                                                    } ?>">
                                                        <?php
                                                        for($i=1;$i<$val['level'];$i++) {
                                                            echo "====";
                                                        }
                                                ?><?php echo $val['name'];?></option>
                                         <?php }?>
                                    </select>
                                    <select name="staff_email" id="staff_email" style="width:150px;height:150px;" size="5" multiple></select>
                                </td>
                            </tr>
                            <tr valign="middle">
                                <td width="10%" style="text-align: right;"><b>收件人：</b></td>
                                <td height="100px;" style="padding-left:5px;">
                                    <div class="input">
                                        <textarea name="cc_staff[]" id="cc_staff" cols="66" rows="3" style="width: 300px;"></textarea>
                                        <input type="hidden" value="" id="arr_staff" />
                                        <input type="hidden" value="#cc_staff" id="mail_value" />
                                        <a href="#" id="mail_ca"><span class="forum_edit"><b>清空</b></span></a>
                                        <!--<a href="#" id="add_copy_to"><span class="forum_edit">添加抄送</span></a>-->
                                        <?php
                                            foreach($mail_ca as $value) {
                                                echo $value;
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                           <tr valign="middle">
                               <td width="10%" style="text-align: right;"><b>邮件主题：</b></td>
                               <td height="35px;" style="padding-left:5px;">
                                   <input type="text" name="title_email" id="title_email" value="Fw：<?php echo $arr['title'];?>" style="width: 300px;" />
                               </td>
                           </tr>
                           <tr valign="middle">
                               <td width="10%" style="text-align: right;"><b>附件：</b></td>
                               <td height="35px;" style="padding-left:5px;">
                                   <?php if(!empty($arr['include'])):?>
                                   <a href="<?php echo site_url("/public/FileController/emailLoad/".$arr['include']) ?>">
                                     <img title="有附件" src="<?php echo $base_url;?>img/attachment.gif" border="0" align="absmiddle">
                                     <?php echo $arr['origName'];?> &darr;
                                  </a>
                                   <input type="hidden" value="<?php echo $arr['include'];?>" name="include" id="include"/>
                                   <?php else:?>
                                   无
                                   <?php endif;?>
                               </td>
                           </tr>
                           <tr valign="middle">
                               <td width="10%" style="text-align: right;"><b>邮件内容：</b></td>
                               <td valign="top">
                                   <textarea id="editor_id" name="content" style="width:100%;height:400px;">
                                            您好：<br/><br/><br/><br/><br/><br/><font style="color:#009966">========== 转自
                                                <?php echo $userArray[$arr['from_uid']]."在";?>
                                                    <?php echo date("Y-m-d H:i:s",$arr['post_date'])."的来信：==========<br />";?>
                                                        <?php echo str_replace("&", "&amp;", $arr['content']);?>
                                                            <br />=======================================================<br /><br /></font>
                                                                &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;致<br/>礼！
                                    </textarea>
                                   <!--<script type="text/javascript" src="<?php echo $base_url;?>/js/FCK/fckeditor.js"></script>
                                        <script type="text/javascript">

                                        var sBasePath = '<?php echo $base_url;?>/js/FCK/';
                                        var oFCKeditor = new FCKeditor('content') ;
                                        oFCKeditor.BasePath     = sBasePath ;
                                        oFCKeditor.Height       = 500 ;
                                        oFCKeditor.Value        = '<?php echo "您好："."<br/><br/><br/><br/><br/><br/><font style=color:#009966>========== 转自";?><?php echo $userArray[$arr['from_uid']]."在";?><?php echo date("Y-m-d H:i:s",$arr['post_date'])."的来信：==========<br />";?><?php echo str_replace("\r", "",str_replace("\n", "", $arr['content']));?><?php echo "<br />=======================================================<br /><br /></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."致"."<br/>";?><?php echo "礼！";?>';
                                        oFCKeditor.Create() ;

                                    </script><span style="color:#FF0000"></span>-->
                               </td>
                           </tr>
                           <tr>
                               <td width="10%" style="text-align: right;"><b>短信提醒：</b></td>
                               <td height="35px;" style="padding-left:5px;"><input type="checkbox" value="1" name="email_type" id="email_type">使用系统短信提醒 &nbsp;&nbsp;&nbsp;<input type="checkbox" value="2" name="email_type" id="email_type">使用手机短信提醒 </td>
                           </tr>
                           <tr>
                                <td colspan="10" style="text-align:center;">
                                    <button class="btn btn-gebo" type="submit" style="margin-right: 20px;">
                                                                提交内容
                                    </button>
                                    <button type="reset" class="btn">
                                                                重置
                                    </button>
                                </td>
                            </tr>
                        </table>
                      </form>
                    </td>
                </tr>
            </table>
        </td>
    </table>
</div>
