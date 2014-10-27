<h2><?php p($l->t('Password Policy Enforcement')); ?></h2>

<ul style="margin-left: 20px;">
    <li><?php p($l->t('At least %d characters in length', $_['minlength'])); ?></li>
    <?php if(OC_Password_Policy::getMixedCase()){ ?>
    <li> <?php p($l->t('Must contain UPPER and lower case characters')); ?></li>
    <?php } ?>
    <?php if(OC_Password_Policy::getNumbers()){ ?>
    <li> <?php p($l->t('Must contain numbers')); ?></li>
    <?php } ?>

    <?php if(OC_Password_Policy::getSpecialChars()){ ?>
    <li> <?php p($l->t('Special characters: %s', $_['specialcharlist'])); ?></li>
    <?php }?>

</ul>
