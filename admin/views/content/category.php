<?php
use common\libs\Yanphp;
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title></title>
    <link rel="stylesheet" href="statics/admin/css/admin_style.css"/>
    <link rel="stylesheet" href="statics/admin/css/jquery.treeview.css"/>
    <script src="statics/admin/js/jquery.js"></script>
    <script src="statics/admin/js/jquery.cookie.js"></script>
    <script src="statics/admin/js/jquery.treeview.js"></script>
    <script>
        $(document).ready(function(){
            $("#browser").treeview();
            $("#browser li").click(function(){
                var id = $(this).attr('id');
                if(id !== '' && id !== undefined)
                {
                    var a = parent.window.document.getElementById('right_frame');
                    a.src = '?r=content/lists&catid='+id;
                }
            });
        });
    </script>
</head>
<body style="height:100%;overflow:hidden;">
<?php echo $categorys; ?>
</body>
</html>