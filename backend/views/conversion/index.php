<?php
/* @var $this yii\web\View */


use yii\helpers\Html;

?>



<form class="form-horizontal" method="POST">
    <div class="form-group">
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <label for="inputEmail3" class="col-sm-1 control-label">Сумма в Гривне</label>
        <div class="col-sm-5">
            <?php $sumPicker = Yii::$app->request->post('uahsum'); ?>
            <?php if (isset($sumPicker) && !empty($sumPicker)) : ?>
    <?= Html::input('raw', 'uahsum', $sumPicker, ['class'=> 'form-control', 'placeholder' => 'Ввидите сумму', 'pattern' => '(^\d+(?:[.]\d{1,2}|$)$)','required'=> true ]) ?>
            <?php else : ?>
    <?= Html::input('raw', 'uahsum', null, ['class'=> 'form-control', 'placeholder' => 'Ввидите сумму', 'pattern' => '(^\d+(?:[.]\d{1,2}|$)$)', 'max' => '30', 'required'=> true]) ?>
            <?php endif; ?>
        </div>
    </div>


    <div class="form-group">
        <label for="inputPassword3" class="col-sm-1 control-label">Дата</label>
        <div class="col-sm-3">
            <?= Html::input('raw', 'conversion_date', null, ['class'=> 'form-control', 'id' => 'datepicker', 'pattern' => '(^(((\d\d)(([02468][048])|([13579][26]))-02-29)|(((\d\d)(\d\d)))-((((0\d)|(1[0-2]))-((0\d)|(1\d)|(2[0-8])))|((((0[13578])|(1[02]))-31)|(((0[1,3-9])|(1[0-2]))-(29|30)))))$)']) ?>

        </div>
    </div>
<?php
$checkCheckbox = Yii::$app->request->post('valcode');
if (!empty($checkCheckbox)): ?>
    <?php if (in_array('EUR', $checkCheckbox)) : ?>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="EUR" checked> EUR </label></div>
        </div>
    </div>
<?php else : ?>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="EUR"> EUR </label></div>
        </div>
    </div>
    <?php endif; ?>
<?php else : ?>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="EUR"> EUR </label></div>
        </div>
    </div>
   <?php endif; ?>
    <?php if (!empty($checkCheckbox)): ?>
        <?php if (in_array('USD', $checkCheckbox)) { ?>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="USD" checked> USD</label></div>
        </div>
    </div>
            <?php } else { ?>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-5">
                    <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="USD"> USD</label></div>
                </div>
            </div>
        <?php } ?>
    <?php else : ?>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-5">
            <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="USD"> USD</label></div>
        </div>
    </div>
<?php endif; ?>
        <?php if (!empty($checkCheckbox)): ?>
            <?php if (in_array('RUB', $checkCheckbox)) { ?>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="RUB" checked> RUB</label></div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-5">
                        <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="RUB"> RUB</label></div>
                    </div>
                </div>
            <?php } ?>
        <?php else: ?>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-5">
            <div class="checkbox"><label><input type="checkbox" name="valcode[]" value="RUB"> RUB</label></div>
        </div>
    </div>
    <?php endif; ?>


    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-5">
            <button type="submit" class="btn btn-default">Посчитать</button>
        </div>
    </div>
</form>

<?php if (isset($postValueFromLink) && !empty($postValueFromLink) && $postValueFromLink !== null) { ?>

    <table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Указанная сумма</th>
        <th>Результат конвертации</th>
        <th>Наименование валюты</th>
        <th>Курс валюты</th>
        <th>Трехбуквенный код страны</th>
        <th>Выбраная дата</th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($postValueFromLink as $ValueFromLinkForAll) {
        $resultSum = $sumPicker / $ValueFromLinkForAll[0]['rate'];
        $fainalSum = sprintf("%f",$resultSum);?>
        <tr>
            <td><?= $sumPicker ?></td>
            <td><?= $fainalSum ?></td>
            <td><?= $ValueFromLinkForAll[0]['txt'] ?></td>
            <td><?= $ValueFromLinkForAll[0]['rate'] ?></td>
            <td><?= $ValueFromLinkForAll[0]['cc'] ?></td>
            <td><?= $ValueFromLinkForAll[0]['exchangedate'] ?></td>
        </tr>

 <?php   } ?>

    </tbody>
    </table>

<?php } else {

    /*if($er[0] == 'no code') {
    echo "<p class=\"bg-warning\" style=\"padding: 15px;\">Выберете валюту</p>";
    }*/

} ?>






