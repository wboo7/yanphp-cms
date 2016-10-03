<?php

use yii\helpers\Html;
use common\libs\Yanphp;
use common\widgets\CategoryContent\Category;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>


    <!--[if lt IE 9]>
    <script src="<?=Yii::getAlias('@web/')?>statics/common/js/html5shiv.min.js"></script>
    <script src="<?=Yii::getAlias('@web/')?>statics/common/js/respond.min.js"></script>
    <![endif]-->


    <?php Yanphp::registerMainHeader(); ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>



<?php $this->endBody() ?>
<?php Yanphp::registerMainFooter(); ?>
<script>
    $(function(){

        $('#category-content').height($('body').height()+12);
    })
</script>

</body>
</html>
<?php $this->endPage() ?>
