<?php
/* @var $this yii\web\View */


use yii\helpers\Html;

?>



<form class="col-sm-4" method="POST">
    <div class="item panel panel-default" style="padding: 10px; background: ">
    <div class="form-group">
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <label class="control-label">Сумма</label>
        <div>
            <?php $sumPicker = Yii::$app->request->post('uahsum'); ?>
            <?php $codePicker = Yii::$app->request->post('select_code'); ?>
            <?php if (isset($sumPicker) && !empty($sumPicker)) : ?>
                <div class="clearfix">
                    <div class="input-group">
                        <?= Html::input('raw', 'uahsum', $sumPicker, ['class'=> 'form-control', 'placeholder' => 'Ввидите сумму', 'pattern' => '(^\d+(?:[.]\d{1,100}|$)$)','required'=> true ]) ?>
                        <div class="input-group-btn">
                            <select name="select_code" style="height: 34px;" class="btn btn-default dropdown-toggle" title="">
                        <?php if ($codePicker == 'UAH') : ?>
                                <option value="UAH" selected>UAH</option>
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                                <option value="RUB">RUB</option>
                        <?php elseif ($codePicker == 'EUR') : ?>
                                <option value="UAH">UAH</option>
                                <option value="EUR" selected>EUR</option>
                                <option value="USD">USD</option>
                                <option value="RUB">RUB</option>
                        <?php elseif ($codePicker == 'USD') : ?>
                                <option value="UAH">UAH</option>
                                <option value="EUR">EUR</option>
                                <option value="USD" selected>USD</option>
                                <option value="RUB">RUB</option>
                        <?php elseif ($codePicker == 'RUB') : ?>
                                <option value="UAH">UAH</option>
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                                <option value="RUB" selected>RUB</option>
                        <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>

            <?php else : ?>
                <div class="clearfix">
                    <div class="input-group">
                        <?= Html::input('raw', 'uahsum', null, ['class'=> 'form-control', 'placeholder' => 'Ввидите сумму', 'pattern' => '(^\d+(?:[.]\d{1,100}|$)$)', 'max' => '30', 'required'=> true]) ?>
                        <div class="input-group-btn">
                            <select name="select_code" style="height: 34px;" class="btn btn-default dropdown-toggle" title="">
                                <option value="UAH" selected>UAH</option>
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                                <option value="RUB">RUB</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label">Дата</label>
        <div class="">
            <?= Html::input('raw', 'conversion_date', null, ['class'=> 'form-control', 'id' => 'datepicker', 'pattern' => '(^(((\d\d)(([02468][048])|([13579][26]))-02-29)|(((\d\d)(\d\d)))-((((0\d)|(1[0-2]))-((0\d)|(1\d)|(2[0-8])))|((((0[13578])|(1[02]))-31)|(((0[1,3-9])|(1[0-2]))-(29|30)))))$)']) ?>

        </div>
    </div>
        <label style="margin-bottom: 20px;" class="control-label">Доступная валюта для выбора</label>
        <br />
        <?php
        /**
         * EUR checkbox
         */
        $checkCheckbox = Yii::$app->request->post('valcode');
        if (!empty($checkCheckbox)): ?>
            <?php if (in_array('EUR', $checkCheckbox)) : ?>
    <div class="form-group">
        <div class="col-sm-offset-1">
            <div class="material-switch">
                <input id="someSwitchOptionSuccess" name="valcode[]" type="checkbox" value="EUR" checked/>
                <label for="someSwitchOptionSuccess" class="label-success"></label>
                <span style="padding:5px;"><b>EUR</b></span>
            </div>
        </div>
    </div>
        <?php else : ?>
        <div class="form-group">
            <div class="col-sm-offset-1">
                <div class="material-switch">
                    <input id="someSwitchOptionSuccess" name="valcode[]" type="checkbox" value="EUR"/>
                    <label for="someSwitchOptionSuccess" class="label-success"></label>
                    <span style="padding:5px;"><b>EUR</b></span>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php else : ?>
    <div class="form-group">
        <div class="col-sm-offset-1">
            <div class="material-switch">
                <input id="someSwitchOptionSuccess" name="valcode[]" type="checkbox" value="EUR" />
                <label for="someSwitchOptionSuccess" class="label-success"></label>
                <span style="padding:5px;"><b>EUR</b></span>
            </div>
        </div>
    </div>
   <?php endif; ?>

    <?php
    /**
     * USD checkbox
     */
    if (!empty($checkCheckbox)): ?>
        <?php if (in_array('USD', $checkCheckbox)) { ?>
            <div class="form-group">
                <div class="col-sm-offset-1 ">
                    <div class="material-switch">
                        <input id="someSwitchOptionSuccess2" name="valcode[]" type="checkbox" value="USD" checked/>
                        <label for="someSwitchOptionSuccess2" class="label-success"></label>
                        <span style="padding:5px;"><b>USD</b></span>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="form-group">
                <div class="col-sm-offset-1 ">
                    <div class="material-switch">
                        <input id="someSwitchOptionSuccess2" name="valcode[]" type="checkbox" value="USD" />
                        <label for="someSwitchOptionSuccess2" class="label-success"></label>
                        <span style="padding:5px;"><b>USD</b></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php else : ?>
        <div class="form-group">
            <div class="col-sm-offset-1 ">
                <div class="material-switch">
                    <input id="someSwitchOptionSuccess2" name="valcode[]" type="checkbox" value="USD" />
                    <label for="someSwitchOptionSuccess2" class="label-success"></label>
                    <span style="padding:5px;"><b>USD</b></span>
                </div>
            </div>
        </div>
<?php endif; ?>

        <?php
        /**
         * RUB checkbox
         */
        if (!empty($checkCheckbox)): ?>
            <?php if (in_array('RUB', $checkCheckbox)) { ?>
                <div class="form-group">
                    <div class="col-sm-offset-1 ">
                        <div class="material-switch">
                            <input id="someSwitchOptionSuccess3" name="valcode[]" type="checkbox" value="RUB" checked/>
                            <label for="someSwitchOptionSuccess3" class="label-success"></label>
                            <span style="padding:5px;"><b>RUB</b></span>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="form-group">
                    <div class="col-sm-offset-1 ">
                        <div class="material-switch">
                            <input id="someSwitchOptionSuccess3" name="valcode[]" type="checkbox" value="RUB" />
                            <label for="someSwitchOptionSuccess3" class="label-success"></label>
                            <span style="padding:5px;"><b>RUB</b></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php else: ?>
            <div class="form-group">
                <div class="col-sm-offset-1 ">
                    <div class="material-switch">
                        <input id="someSwitchOptionSuccess3" name="valcode[]" type="checkbox" value="RUB" />
                        <label for="someSwitchOptionSuccess3" class="label-success"></label>
                        <span style="padding:5px;"><b>RUB</b></span>
                    </div>
                </div>
            </div>
    <?php endif; ?>

        <?php
        /**
         * UAH checkbox
         */
        if (!empty($checkCheckbox)): ?>
        <?php if (in_array('UAH', $checkCheckbox)) { ?>
            <div class="form-group">
                <div class="col-sm-offset-1 ">
                    <div class="material-switch">
                        <input id="someSwitchOptionSuccess4" name="valcode[]" type="checkbox" value="UAH" checked/>
                        <label for="someSwitchOptionSuccess4" class="label-success"></label>
                        <span style="padding:5px;"><b>UAH</b></span>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="form-group">
                <div class="col-sm-offset-1 ">
                    <div class="material-switch">
                        <input id="someSwitchOptionSuccess4" name="valcode[]" type="checkbox" value="UAH"  />
                        <label for="someSwitchOptionSuccess4" class="label-success"></label>
                        <span style="padding:5px;"><b>UAH</b></span>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php else: ?>
            <div class="form-group">
                <div class="col-sm-offset-1 ">
                    <div class="material-switch">
                        <input id="someSwitchOptionSuccess4" name="valcode[]" type="checkbox" value="UAH" />
                        <label for="someSwitchOptionSuccess4" class="label-success"></label>
                        <span style="padding:5px;"><b>UAH</b></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <div class="form-group">
        <div class="col-sm-offset-1">
            <button type="submit" class="btn btn-primary">Посчитать</button>
        </div>
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
        <th>Выбранная дата</th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($postValueFromLink as $ValueFromLinkForAll) {
        foreach ($postChooseValue as $ChooseValueRate) {
        $resultSum = $sumPicker / $ValueFromLinkForAll[0]['rate'] * $ChooseValueRate[0]['rate'];
        $rate = $ValueFromLinkForAll[0]['rate'] / $ChooseValueRate[0]['rate'];
        $finalSum = round((sprintf("%f",$resultSum)), 3);?>
        <tr>
            <td><?= $sumPicker .' '. $ChooseValueRate[0]['cc']?></td>
            <td><?= $finalSum ?></td>
            <td><?= $ValueFromLinkForAll[0]['txt'] ?></td>
            <td><?= round($rate, 10) ?></td>
            <td><?= $ValueFromLinkForAll[0]['cc'] ?></td>
            <td><?= $ValueFromLinkForAll[0]['exchangedate'] ?></td>
        </tr>

 <?php  }
        } ?>

    </tbody>
    </table>

<?php } else {

    /*if($er[0] == 'no code') {
    echo "<p class=\"bg-warning\" style=\"padding: 15px;\">Выберете валюту</p>";
    }*/

} ?>






