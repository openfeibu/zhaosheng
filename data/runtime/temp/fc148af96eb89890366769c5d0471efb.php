<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:66:"D:\UPUPW_K2.1_64\htdocs\zhaosheng/app/home/view/default/\list.html";i:1490542020;s:72:"D:\UPUPW_K2.1_64\htdocs\zhaosheng/app/home/view/default/public\head.html";i:1490541958;s:76:"D:\UPUPW_K2.1_64\htdocs\zhaosheng/app/home/view/default/public\function.html";i:1489327654;s:74:"D:\UPUPW_K2.1_64\htdocs\zhaosheng/app/home/view/default/public\config.html";i:1489327654;s:70:"D:\UPUPW_K2.1_64\htdocs\zhaosheng/app/home/view/default/ajax_list.html";i:1490540414;s:74:"D:\UPUPW_K2.1_64\htdocs\zhaosheng/app/home/view/default/public\footer.html";i:1490885736;}*/ ?>
<?php 
/*这里只是一个模板函数库演示*/
function helloworld(){
	echo "hello YFCMF!";
}
 
//模板多语言
use think\Lang;

$lang_cn=array(
'positive'=>'客户评价',
'partner'=>'合作伙伴',
'see'=>'查看',
'recent news'=>'最近新闻',
'service items'=>'服务项目',
'successful case'=>'成功案例',
'successful case text'=>'以下案例均由雨飞工作室开发，部分设计灵感及素材来源于网络,如果您不希望贵司的案例显示在这里，请与我们联系。更多的成功案例正在整理中，请大家继续关注。如您有需要,随时可以联系我们……',
'index one'=>'我们的理念',
'index one text'=>'以客为尊、卓越服务、力争第一！',
'index two'=>'我们的目标',
'index two text'=>'平凡创造奇迹，业绩突破梦想！',
'index three'=>'我们的管理',
'index three text'=>'没有完美的个人，只有完美的团队！',
'about us'=>'关于我们',
'current location'=>'当前位置',
'home'=>'首页',
'team introduction'=>'团队介绍',
'our advantage'=>'我们的优势',
'our advantage one'=>'深厚的技术力量',
'our advantage two'=>'丰富的行业经验',
'our advantage three'=>'高效的作业流程',
'our advantage four'=>'完善的服务体系',
'our advantage five'=>'众多的成功案例',
'phone'=>'电话',
'email'=>'邮箱',
'address'=>'地址',
'homepage'=>'官网',
'personal center'=>'个人中心',
'sign out'=>'退出',
'login'=>'登录',
'weibo login'=>'微博登录',
'qq login'=>'QQ登录',
'register'=>'注册',
'scan QR code'=>'扫描二维码',
'scan'=>'扫一扫',
'contact us'=>'联系我们',
'link'=>'友情链接',
'search'=>'搜索',
'result'=>'条结果',
'search result'=>'搜索结果',
'news copyright'=>'注：本文转载自%s，转载目的在于传递更多信息，并不代表本网赞同其观点和对其真实性负责。如有侵权行为，请联系我们，我们会及时删除。',
'last news'=>'上一篇',
'next news'=>'下一篇',
'our location'=>'我们的位置',
'online message'=>'在线留言',
'username'=>'姓名',
'content'=>'内容',
'captcha'=>'验证码',
'click to get'=>'点击获取',
'send message'=>'发送留言',
'contact information'=>'联系方式',
'working hours'=>'工作时间',
'Monday ~ Friday'=>'周一~周五',
'Saturday'=>'周六',
'Sunday'=>'周日',
'rest'=>'休息',
'work flow'=>'工作流程',
'design'=>'协商设计',
'development phase'=>'开发阶段',
'test and acceptance'=>'测试验收',
'flow one'=>'1 双方协商网站建设内容，修改补充，达成共识 </br>2 我方制定《网站建设方案》 </br>3 双方确定建站细节及价格</br>4 双方签订《网站建设协议》</br>5 客户支付预付款(30%)</br>6 客户根据第一阶段调研表提供网站相关第一步内容资料完成样稿设计</br>',
'flow two'=>'1 我方根据《网站建设方案》完成网站样稿 </br>2 客户支付预付款(40%) </br>3 首页、频道首页、基本页、网站架构图 </br>4 客户审核确认样稿 </br>5 为客户注册域名</br>6 同时进行第二阶段调研	</br>',
'flow three'=>'1 我方完成全部网站制作 </br>2 我方完成网站测试，双方协商完善 </br>3 网站本地测试通过，客户确认 </br>4 客户验收网站，网站开通 </br>5 客户签发《网站建设验收合格确认书》 </br>6 客户支付余款，网站开通 	</br>',
'center'=>'个人中心',
'modify information'=>'修改资料',
'modify pwd'=>'修改密码',
'bind account'=>'绑定账号',
'my favorites'=>'我的收藏',
'my comments'=>'我的评论',
'hot articles'=>'热门文章',
'recent articles'=>'最近发布',
'recent comments'=>'最新评论',
'ads contribution'=>'广告赞助',
'error'=>'抱歉，出现错误了！',
'reason'=>'无法访问页面的原因：',
'automatically'=>'页面自动',
'jump'=>'跳转',
'wait second'=>'等待时间：',
'comments'=>'评论',
'send comments'=>'发表评论',
'need login to comment'=>'您需要登录后才可以评论',
'register immediately'=>'立即注册',
'anonymous'=>'匿名人',
'just'=>'刚刚',
'reply'=>'回复',
'cancel'=>'取消',
'ok'=>'确定',
'user login'=>'用户登录',
'username or email'=>'手机号/邮箱/用户名',
'remember'=>'记住登录',
'forget password'=>'忘记密码',
'nickname'=>'昵称',
'without filled'=>'未填写',
'score coin'=>'积分(金币)',
'last login'=>'最后登录',
'sex'=>'性别',
'ProMonkey'=>'程序猿',
'ProMM'=>'程序媛',
'secrecy'=>'保密',
'personal website'=>'个人网站',
'signature'=>'签名',
'news title'=>'原文标题',
'comment content'=>'评论内容',
'comment time'=>'评论时间',
'account activation'=>'账号激活',
'account not activated'=>'账号未激活',
'resend active email'=>'重发激活邮件?',
'resend now'=>'现在就重发吧！',
'bound qq'=>'已绑定腾讯QQ账号',
'bind new qq'=>'绑定腾讯QQ账号',
'bound sina weibo'=>'已绑定新浪微博账号',
'bind new sina weibo'=>'绑定新浪微博账号',
'member avatar'=>'会员头像',
'program loading'=>'程序加载中',
'pic effect'=>'截图效果',
'save capture'=>'保存截图',
'reselection'=>'重新选择',
'turn R'=>'右转',
'turn L'=>'左转',
'original'=>'原图',
'Skin effect'=>'美肤效果',
'Sketch effect'=>'素描效果',
'Enhancement effect'=>'自然增强',
'Purple effect'=>'紫调效果',
'Soft focus'=>'柔焦效果',
'Retro effect'=>'复古效果',
'Black-white effect'=>'黑白效果',
'Imitation LOMO'=>'仿lomo',
'Bright white effect'=>'亮白增强',
'Grey-white effect'=>'灰白效果',
'Grey effect'=>'灰色效果',
'Warm autumn effect'=>'暖秋效果',
'Wood carving effect'=>'木雕效果',
'Rough effect'=>'粗糙效果',
);
$lang_en=array(
'positive'=>'Customer evaluation',
'partner'=>'Partner',
'see'=>'See',
'recent news'=>'Recent news',
'service items'=>'Service Items',
'successful case'=>'Successful case',
'successful case text'=>'The following cases were developed by the rain fly studio, part of the design inspiration and material from the network, if you do not want to see your case here, please contact us. More successful case is finishing, please continue to pay attention to. If you have any need, you can contact us at any time......',
'index one'=>'Our philosophy',
'index one text'=>'Customer oriented, excellent service, and strive for the first!',
'index two'=>'Our goal',
'index two text'=>'Extraordinary to create a miracle, the results of a breakthrough in the dream!',
'index three'=>'Our management',
'index three text'=>'There is no perfect person, but only the perfect team!',
'about us'=>'About us',
'current location'=>'Current location',
'home'=>'Home',
'team introduction'=>'Team Introduction',
'our advantage'=>'Our advantage',
'our advantage one'=>'Deep technical strength',
'our advantage two'=>'Rich experience',
'our advantage three'=>'Efficient operation process',
'our advantage four'=>'Perfect service system',
'our advantage five'=>'Many successful cases',
'phone'=>'Phone',
'email'=>'Email',
'address'=>'Add',
'homepage'=>'Homepage',
'personal center'=>'Personal Center',
'sign out'=>'Sign out',
'login'=>'Login',
'weibo login'=>'Weibo login',
'qq login'=>'QQ login',
'register'=>'Register',
'scan QR code'=>'Scan QR code',
'scan'=>'Scan',
'contact us'=>'Contact us',
'link'=>'Friendship link',
'search'=>'Search',
'result'=>'News',
'search result'=>'Search result',
'news copyright'=>'Note: This article is reproduced from %s, reproduced in the purpose of passing more information, does not mean that this network agrees with its view and responsible for its authenticity. If there is infringement, please contact us, we will promptly delete.',
'last news'=>'Last news',
'next news'=>'Next news',
'our location'=>'Our location',
'online message'=>'Online Message',
'username'=>'Username',
'content'=>'Content',
'captcha'=>'Captcha',
'click to get'=>'Click to get',
'send message'=>'Send message',
'contact information'=>'Contact information',
'working hours'=>'Working hours',
'Monday ~ Friday'=>'Monday ~ Friday',
'Saturday'=>'Saturday',
'Sunday'=>'Sunday',
'rest'=>'Rest',
'work flow'=>'Work flow',
'design'=>'Design',
'development phase'=>'Development phase',
'test and acceptance'=>'Test and acceptance',
'flow one'=>'1 negotiation website content, modify and supplement, we set out to reach a consensus </br>2 website construction scheme </br>3 station to determine both the details and price </br>4 the two sides signed the "agreement on the construction site" </br>5 customer payment (30%) </br>6 customers according to the first phase of research provide website related information to complete the first step of sample design </br>',
'flow two'=>'1 according to our "website construction plan" to complete the site </br>2 sample customer payment in advance (40%) </br>3 home page, channel home page, basic page, website structure figure </br>4 customer verification sample </br>5 for customers to register the domain name </br>6 and second stage </br>',
'flow three'=>'1 we completed our website </br>2 to complete the site test, improve the </br>3 site local consultation between the two sides through testing, the customer to confirm customer acceptance of </br>4 website, the website customer </br>5 issued "website construction acceptance confirmation" </br>6 customers pay the balance, the net station opened </br>',
'center'=>'Center',
'modify information'=>'Modify info',
'modify pwd'=>'Modify password',
'bind account'=>'Bind account',
'my favorites'=>'My favorites',
'my comments'=>'My comments',
'hot articles'=>'Hot news',
'recent articles'=>'Last news',
'recent comments'=>'CMT',
'ads contribution'=>'Ads Contribution',
'error'=>'Error!',
'reason'=>'Reason:',
'automatically'=>'Automatically',
'jump'=>'Jump',
'wait second'=>'Wait second:',
'comments'=>'Comments',
'send comments'=>'Send comments',
'need login to comment'=>'You need to log in before you can comment',
'register immediately'=>'Register immediately',
'anonymous'=>'Anonymous',
'just'=>'Just',
'reply'=>'Reply',
'cancel'=>'Cancel',
'ok'=>'OK',
'user login'=>'User login',
'username or email'=>'phone/email/username',
'remember'=>'Remember',
'forget password'=>'Forget password',
'nickname'=>'Nickname',
'without filled'=>'Without filled',
'score coin'=>'score(coin)',
'last login'=>'Last login',
'sex'=>'Sex',
'ProMonkey'=>'ProMonkey',
'ProMM'=>'ProMM',
'secrecy'=>'Secrecy',
'personal website'=>'Website',
'signature'=>'Signature',
'news title'=>'News title',
'comment content'=>'Comment content',
'comment time'=>'Comment time',
'account activation'=>'Account activation',
'account not activated'=>'Account is not activated',
'resend active email'=>'Resend active email?',
'resend now'=>'Resend email now!',
'bound qq'=>'Have bound qq',
'bind new qq'=>'Bind new qq',
'bound sina weibo'=>'Have bound sina weibo',
'bind new sina weibo'=>'Bind new sina weibo',
'member avatar'=>'Member avatar',
'program loading'=>'Program loading',
'pic effect'=>'Picture effect',
'save capture'=>'Save capture',
'reselection'=>'Re-select',
'turn R'=>'R',
'turn L'=>'L',
'original'=>'Original',
'Skin effect'=>'Skin',
'Sketch effect'=>'Sketch',
'Enhancement effect'=>'Enhance',
'Purple effect'=>'Purple',
'Soft focus'=>'Soft',
'Retro effect'=>'Retro',
'Black-white effect'=>'Black-W',
'Imitation LOMO'=>'LOMO',
'Bright white effect'=>'Bright-W',
'Grey-white effect'=>'G-W',
'Grey effect'=>'Grey',
'Warm autumn effect'=>'Warm',
'Wood carving effect'=>'Wood',
'Rough effect'=>'Rough',
);
Lang::set($lang_cn,null,'zh-cn');
Lang::set($lang_en,null,'en-us');
//以下为模板栏目设置
$home_adtype_id="1";//首页幻灯片(广告位置)id
$link_footer="1";//页脚友链类型id
//根据语言选择
switch ($lang) {
	case 'en-us':
		$portal_index_lastnews="12";//首页最近新闻分类cid
		$positive_cid="13";//客户好评分类cid
		$client_cid="13";//客户分类cid
		$lastportfolios_cid="10";//最近案例分类cid
		$services_cid="9";//服务项目cid
		$about_id="8";//公司简介单页面菜单id
		$portal_hot_articles="12,10";//右侧边栏热门文章分类cid,多个cid中间英文逗号分隔
		$portal_last_post="12,10";//右侧边栏最近发布文章分类cid,多个cid中间英文逗号分隔
	break;
	//其它语言
	case 'zh-cn':
	default:
		$portal_index_lastnews="5";//首页最近新闻分类cid
		$positive_cid="6";//客户好评分类cid
		$client_cid="6";//客户分类cid
		$lastportfolios_cid="3";//最近案例分类cid
		$services_cid="2";//服务项目cid
		$about_id="1";//公司简介单页面菜单id
		$portal_hot_articles="5,3";//右侧边栏热门文章分类cid,多个cid中间英文逗号分隔
		$portal_last_post="5,3";//右侧边栏最近发布文章分类cid,多个cid中间英文逗号分隔
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="default"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <title><?php echo (isset($menu['menu_seo_title']) && ($menu['menu_seo_title'] !== '')?$menu['menu_seo_title']:$site_seo_title); ?> <?php echo $site_name; ?></title>
    <meta name="keywords" content="<?php echo (isset($menu['menu_seo_key']) && ($menu['menu_seo_key'] !== '')?$menu['menu_seo_key']:$site_seo_keywords); ?>" />
    <meta name="description" content="<?php echo (isset($menu['menu_seo_des']) && ($menu['menu_seo_des'] !== '')?$menu['menu_seo_des']:$site_seo_description); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $yf_theme_path; ?>public/css/css.css">
    <script type="text/javascript" src="<?php echo $yf_theme_path; ?>public/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $yf_theme_path; ?>public/js/main.js"></script>
</head>
<body>
    <!-- 头部 S -->
    <div class="header">

    </div>
    <!-- 头部 E -->
    <!-- 导航 -->
    <div class="nav">
      <?php echo get_menu("main","","<a href='\$href' class='sf-with-ul'>\$menu_name</a>","<a href='#' class='sf-with-ul'>\$menu_name<span class='sf-sub-indicator'>&nbsp;<i class='fa fa-angle-down'></i></span></a>","","","w1000","6","");?>

    </div>

    <!-- 主体内容 S -->
    <div class="main w1000">
        <div class="fb-source">
            <ul>
                <li>
                    <a href="__ROOT__/">首页</a>
                    <span >\</span>
                </li>
                <li>
                    <a><?php echo $menu['menu_name']; ?></a>
                    <span >\</span>
                </li>

            </ul>
        </div>
        <!-- 通知公告 -->
        <div class="fb-list" id="news_list">
            <ul class="fb-list-ul">
		<?php if(is_array($lists['news']) || $lists['news'] instanceof \think\Collection || $lists['news'] instanceof \think\Paginator): $i = 0; $__LIST__ = $lists['news'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<li><a href="<?php echo url('home/News/index',array('id'=>$vo['n_id'])); ?>"><p><?php echo $vo['news_title']; ?></p><span><?php echo date("Y-m-d",$vo['news_time']); ?></span></a></li>
		<?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<div class="fb-page">
		<?php echo $page_html; ?>
</div>

        </div>
        <!-- 通知公告 -->

    </div>
    <!-- 主体内容 E -->

<!-- footer S -->
<footer class="printHide">
    <p>学院微博：@广东农工商学院发布@广东农工商职业技术学院</p>
    <p>粤垦路校区地址：广州市天河区粤垦路198号 增城校区地址：广州增城市中新镇风光路393号</p>
    <p class="copy">版权所有：广东农工商职业技术学院 备案号：4401060500008</p>
</footer>
<!-- footer E -->
</body>

<script>
    $(function(){
        var time = null,index=0;
        $(".banner ol li").on("click",function(){
            var i = $(this).index();
            $('.banner ul li').eq(i).fadeIn().siblings("li").fadeOut();
            $(this).addClass("active").siblings("li").removeClass("active");
            i = index;
        })
        run();
        function run (){
            time = setInterval(function(){
                i = ++index > $(".banner ol li").length-1 ? 0 : index;
                 $('.banner ul li').eq(i).fadeIn().siblings("li").fadeOut();
                 $(".banner ol li").eq(i).addClass("active").siblings("li").removeClass("active");
                i = index;
            },1000)
        }
        $(".banner").hover(function(){
            clearInterval(time);
        },function(){
            run();
        });
        var se_i =  $(".fb-seamless-con li").length;
        var se_t = null;
        var se_long = 0;
        $(".fb-seamless-con ul").append($(".fb-seamless-con ul").html());
        se_run();
        function se_run(){
            se_t = setInterval(function(){
                se_long += 1;
                $(".fb-seamless-con ul").css("left",-se_long);
                if(se_long >= se_i*195){
                    $(".fb-seamless-con ul").css("left",0);
                    se_long = 0;
                }
            },20)
        }
        $(".fb-seamless-con").hover(function(){
            clearInterval(se_t);
        },function(){
            se_run();
        })
    })
    function mbar(sobj){
        var docurl =sobj.options[sobj.selectedIndex].value;
        if (docurl != "") {
           open(docurl,'_blank');
           sobj.selectedIndex=0;
           sobj.blur();
        }
    }
</script>
<script>
    $('.nowtime').html(new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay()));
   setInterval(function(){
    $('.nowtime').html(new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay()));
   },1000);
   $(".personal_table input").blur(function(){
    var value  = $(this).val();
    var name = $(this).attr('name');
    $.post("<?php echo url('home/center/update_info'); ?>",{'name':name,'value':value},function(data){
        console.log(data);
     });
   });
</script>
<script>
function preview(oper)
{
if (oper < 10)
{
bdhtml=window.document.body.innerHTML;//获取当前页的html代码
sprnstr="<!--startprint"+oper+"-->";//设置打印开始区域
eprnstr="<!--endprint"+oper+"-->";//设置打印结束区域
prnhtml=bdhtml.substring(bdhtml.indexOf(sprnstr)+18); //从开始代码向后取html
prnhtmlprnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));//从结束代码向前取html
window.document.body.innerHTML=prnhtml;
window.print();
window.document.body.innerHTML=bdhtml;
} else {
window.print();
}
}
$(".pro_img").on('click','.img_close',function (e) {
        new upField($(this)).del();
    })

$("body").on('change','.upload',function (e) {
    var field=new upField($(this));
    var maxSize=500; //kb
    var name=$(this).attr('name');
    var pic = $(this).prop('files');
    var fordata=new FormData();
    fordata.append('imgFile',pic[0]); //添加字段



   if(pic[0].size/1024>maxSize) {
        field.addErr('图片不能超过'+maxSize+'kb')
        return false;
   }

    $.ajax({
        url:"<?php echo url('home/center/avatar'); ?>",
        //url:'http://183.71.200.186:8084/upload_json.asp',
        type:'POST',
        dataType:'json',
        data:fordata,
        processData: false,
        contentType: false,
        error: function(){
            field.addErr('未知错误')
        },


        success: function(data){
            if(data.error==0){
                // field.add(e.url,name);
                $("#studentPicture_herf_show").attr("src",data.url)
            }else{

                field.addErr(e.message);
            }
        }
    })

})

function upField(doc){
    var self=this;
    this.waitTime=3000;  //错误信息 显示时长
    this.doc=doc;

    this.addErr = function (message) {
        var error=this.doc.parent(".img").find('.error');
        error.html(message).show();
        setTimeout(function () {
            error.html('').hide();
        },3000)
    };

    this.add=function (img,name) {
          var template='<div class="img_close" name="'+name+'"></div>';
          template+='<img src="'+img+'" alt="">';
          this.doc.parent(".img").html(template);
          //添加input
          var input='<input name='+name+' type="hidden" value='+img+' class="up-item">';
          $("#myform").append(input);


    };
    this.del = function () {
            var img=this.doc.parent(".img");
            var name=img.find(".img_close").attr('name');
            var template='<input name="'+name+'" type="file" id="'+name+'" class="upload">';
            template+='<span>+</span>';
            template+='<div class="error"></div> ';
            img.html(template);
            $(".up-item[name="+name+"]")[0]&&$(".up-item[name="+name+"]").remove();
    };


}



</script>
</html>

