<?php
script('password_policy', 'settings-admin');
?>

<form id="password_policy" class="section">
    <h2><?php p($l->t('Password Policy Enforcement')); ?></h2>
    <ul>
        <li>
            <label for="password_policy_min_length"><?php p($l->t('Minimum Password Length')); ?>) </label>
            <input type="number" id="password_policy_min_length" name="min_length" value="<?php p($_['minlength']); ?>"/></li>
        <li>
            <input type="checkbox" class="checkbox" id="password_policy_mixed_case" name="mixedcase" <?php p($_['mixedcase']); ?> />
            <label for="password_policy_mixed_case"><?php p($l->t('Require Mixed Case')); ?></label>
        </li>
        <li>
            <input type="checkbox" class="checkbox" id="password_policy_numbers" name="numbers" <?php p($_['numbers']); ?>  />
            <label for="password_policy_numbers"><?php p($l->t('Require Numbers')); ?></label>
        </li>
        <li>
            <input type="checkbox" class="checkbox" id="password_policy_special_characters" name="specialcharacters" <?php p($_['specialcharacters']); ?> />
            <label for="password_policy_special_characters"><?php p($l->t('Require Special Characters')); ?></label>
        </li>
        <li>
            <label for="password_policy_special_chars_list"><?php p($l->t('Special Characters List')); ?></label>
            <input style="width: 300px;" type="text" id="password_policy_special_chars_list" name="specialcharslist" value="<?php p($_['specialcharslist']); ?>"/>
        </li>
    </ul>
    <br/>
</form>
