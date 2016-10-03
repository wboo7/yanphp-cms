<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\libs\Yanphp;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php Yanphp::registerMainHeader(); ?>
    <?php $this->head() ?>
</head>
<body class="layout-body">
<?php $this->beginBody() ?>

<?= $content;?>

<?php $this->endBody() ?>
<?php Yanphp::registerMainFooter(); ?>

</body>
</html>
<?php $this->endPage() ?>
