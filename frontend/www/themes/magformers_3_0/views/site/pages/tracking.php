<?php

$params = array(
    'method' => 'getTrackerStatuses',
    'params' => array(
        'number' => '1013204920',
        'type' => 'cdek'
    )
);

$opts = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'X-Api-Key: 90855745b5eb548aca500ac338dcb73b91cd8f5b',
        'content' => json_encode($params),
        'timeout' => 60,
        'ignore_errors' => true
    )
);

$context = stream_context_create($opts);
$content = file_get_contents('https://moyaposylka.ru/apps/tracker/v2', false, $context);

$result = json_decode($content, true);

var_export($result);

$data = $result['result'];
?>

<h2>Номер отправления: <?php echo $data['number'] ?></h2>
<div>Достаку осуществляет: <?php echo $data['type']['readable'] ?></div>

<div>
    <?php if($data['trackTime']):?>
        Дней в пути <span class="badge badge-primary"><?php echo $data['trackTime'] ?></span>.
    <?php endif; ?>

    <?php if($data['weight']):?>
        Вес посылки: <span class="badge"><?php echo $data['weight'] ?></span> кг.
    <?php endif; ?>

    <?php if($data['destination']['address']):?>
        Адресовано:
        <?php if($data['destination']['zipCode']):?>
            <?php echo $data['destination']['zipCode'] ?>,
        <?php endif; ?>
        <?php echo $data['destination']['address'] ?>
    <?php endif; ?>
    Последнее обновление: <?php echo SHtml::toHumanDate($data['lastUpdatedAt']) ?>.
</div>
<table class="table table-striped">
    <?php foreach($data['statuses'] as $status):?>
        <tr>
            <td class="col-xs-2"><?php echo SHtml::toHumanDate($status['date']) ?></td>
            <td class="col-xs-4"><?php echo $status['place']; echo $status['zipCode'] ? ', '.$status['zipCode'] : '' ?></td>
            <td class="col-xs-6"><?php echo $status['operation']['name']; echo isset($status['attribute']) ? ' / '.$status['attribute']['name'] : ''?></td>
        </tr>
    <?php endforeach ?>
</table>