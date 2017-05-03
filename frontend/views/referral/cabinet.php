<?php
/*  @var $referral Referral */
/*  @var $banner SocialBanner */

?>
<?php $this->pageTitle = 'Личный кабинет';?>

<h2>Личный кабинет</h2>
<hr/>

<h3>Личные данные</h3>
<dl class="dl-horizontal">
    <dt><?php echo $referral->getAttributeLabel('id'); ?></dt>
    <dd><?php echo $referral->id; ?></dd>
    <dt><?php echo $referral->getAttributeLabel('name'); ?></dt>
    <dd><?php echo $referral->name; ?></dd>
    <dt><?php echo $referral->getAttributeLabel('phone'); ?></dt>
    <dd><?php echo $referral->phone; ?></dd>
    <dt><?php echo $referral->getAttributeLabel('email'); ?></dt>
    <dd><?php echo $referral->email; ?></dd>
</dl>

<h3>Статистика</h3>
<dl class="dl-horizontal">
    <dt><?php echo $referral->getAttributeLabel('url'); ?></dt>
    <dd><?php echo ReferralListener::getUrl($referral->id); ?></dd>
    <dt><?php echo $referral->getAttributeLabel('visit'); ?></dt>
    <dd><?php echo $referral->visit; ?></dd>
    <dt><?php echo $referral->getAttributeLabel('unique_visit'); ?></dt>
    <dd><?php echo $referral->unique_visit; ?></dd>
    <dt><?php echo $referral->getAttributeLabel('buy'); ?></dt>
    <dd><?php echo $referral->buy; ?></dd>
</dl>

