<?php
$this->pageTitle = 'Расчет ЗП';
$users = array(
    5=>array(
        'total' => 0,
        'percent' => 0,
        'salary' => 0
    ),
    8=>array(
        'total' => 0,
        'percent' => 0,
        'salary' => 0
    )
);

$userID = !empty($_GET['user_id']) ? $_GET['user_id'] : Yii::app()->user->id;
?>

    <h3><?= User::model()->findByPk($userID)->name?></h3>
    <table class="table">
        <?php
        $sellerForms = SellerForm::model()->findAll(
            array("condition"=>"user_id = $userID AND DATE(date) BETWEEN '2016-02-01' AND '2016-02-29'"))

        ?>
        <?php foreach($sellerForms as $sellerForm): ?>
            <tr>
            <?php
            $total = 0;
            $sales = $sellerForm->sales;
            ?>
            <?php foreach($sales as $sale): ?>
                <?php $total += $sale->product_price*$sale->product_count*(100-$sale->discount)/100; ?>
            <?php endforeach ?>
            <?php
            $salary = 1000;
            $percent = $total*7/100;
            $users[$userID]['total'] += $total;
            $users[$userID]['salary'] += $salary;
            $users[$userID]['percent'] += $percent;
            ?>
                <td><?= date('d.m.Y',strtotime($sellerForm->date)); ?></td>
                <td><?= $salary ?></td>
                <td><?= $total ?></td>
                <td><?= $percent ?></td>
            </tr>
        <?php endforeach ?>
        <tr style="font-weight: bold; border-top: 2px solid #000000">
            <td>&nbsp;</td>
            <td><?= $users[$userID]['salary'] ?></td>
            <td><?= $users[$userID]['total'] ?></td>
            <td><?= $users[$userID]['percent'] ?></td>
        </tr>

        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">ОКЛАД</td>
            <td style="font-weight: bold;"><?=  SHtml::toPrice($users[$userID]['salary']) ?></td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">АВАНС</td>
            <td style="font-weight: bold;">-<?= SHtml::toPrice(6000)?></td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">ПРОЦЕНТ</td>
            <td style="font-weight: bold;"><?= SHtml::toPrice($users[$userID]['percent']) ?></td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">ИТОГО</td>
            <td style="font-weight: bold;"><?= SHtml::toPrice($users[$userID]['salary'] - 6000 + $users[$userID]['percent']) ?></td>
        </tr>
    </table>
