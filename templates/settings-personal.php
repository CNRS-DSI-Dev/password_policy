<?php
script('password_policy', 'settings-personal');
?>

<div id="password" class="section">
    <h2><?php p($l->t('Password Policy Enforcement')); ?></h2>
    <p><?php p($l->t('The following password restrictions are currently in place:')); ?></p>
    <p><?php p($l->t('All passwords are required to be at least %d characters in length', $_['minlength'])); ?></p>
    <ul style="list-style: circle; margin-left: 20px;">
        <?php if($_['mixedcase']) { ?>
        <li> <?php p($l->t('Must contain UPPER and lower case characters')); ?></li>
        <?php } ?>
        <?php if($_['numbers']) { ?>
        <li> <?php p($l->t('Must contain numbers')); ?></li>
        <?php } ?>

        <?php if($_['specialcharacters']) { ?>
        <li> <?php p($l->t('Must contain special characters: %s', $_['specialcharslist'])); ?></li>
        <?php }?>

    </ul>
</div>
