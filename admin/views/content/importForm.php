<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\libs\KingEditor;

use vova07\imperavi\Widget;

?>


<form action="?r=content/import-data&catid=<?=$catid?>" method="post" role="form">

	<div class="form-group">
		<label for=""><?=Yii::t('app','Data Pool')?></label>
		<?=Html::dropDownList('type','',\common\models\Collect::$types,['class'=>'form-control'])?>
	</div>

    <div class="form-group">
        <label for=""><?=Yii::t('app','Import Data')?></label>
        <input type="text" class="form-control" name="num" id="" placeholder="<?=Yii::t('app','Default {num}',['num'=>20])?>">
    </div>

</form>



