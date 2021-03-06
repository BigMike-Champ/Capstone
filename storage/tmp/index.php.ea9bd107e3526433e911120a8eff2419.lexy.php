<div>
    <ul class="uk-breadcrumb">
        <li class="uk-active"><span><?php echo $app("i18n")->get('Settings'); ?></span></li>
    </ul>
</div>

<div class="uk-grid uk-grid-gutter uk-grid-match uk-grid-width-medium-1-4 uk-text-center">

    <?php if ($app['user']['group']=='admin') { ?>
    <div>
        <div class="uk-panel uk-panel-space uk-panel-box uk-panel-card">
            <img src="<?php echo $app->pathToUrl('assets:app/media/icons/settings.svg'); ?>" width="50" height="50" alt="<?php echo $app("i18n")->get('Settings'); ?>" />

            <div class="uk-text-truncate uk-margin">
                <?php echo $app("i18n")->get('Settings'); ?>
            </div>
            <a class="uk-position-cover" href="<?php $app->route('/settings/edit'); ?>"></a>
        </div>
    </div>
    <?php } ?>

    <?php if ($app->module("cockpit")->hasaccess('cockpit', 'accounts')) { ?>
    <div>
        <div class="uk-panel uk-panel-space uk-panel-box uk-panel-card">

            <img src="<?php echo $app->pathToUrl('assets:app/media/icons/accounts.svg'); ?>" width="50" height="50" alt="<?php echo $app("i18n")->get('Accounts'); ?>" />

            <div class="uk-text-truncate uk-margin">
                <?php echo $app("i18n")->get('Accounts'); ?>
            </div>
            <a class="uk-position-cover" href="<?php $app->route('/accounts/index'); ?>"></a>
        </div>
    </div>
    <?php } ?>

    <?php if ($app->module("cockpit")->hasaccess('cockpit', 'rest')) { ?>
    <div>
        <div class="uk-panel uk-panel-space uk-panel-box uk-panel-card">

            <img src="<?php echo $app->pathToUrl('assets:app/media/icons/api.svg'); ?>" width="50" height="50" alt="<?php echo $app("i18n")->get('API Access'); ?>" />

            <div class="uk-text-truncate uk-margin">
                <?php echo $app("i18n")->get('API Access'); ?>
            </div>
            <a class="uk-position-cover" href="<?php $app->route('/restadmin/index'); ?>"></a>
        </div>
    </div>
    <?php } ?>

    <?php if ($app->module("cockpit")->hasaccess('cockpit', 'webhooks')) { ?>
    <div>
        <div class="uk-panel uk-panel-space uk-panel-box uk-panel-card">

            <img src="<?php echo $app->pathToUrl('assets:app/media/icons/webhooks.svg'); ?>" width="50" height="50" alt="<?php echo $app("i18n")->get('Webhooks'); ?>" />

            <div class="uk-text-truncate uk-margin">
                <?php echo $app("i18n")->get('Webhooks'); ?>
            </div>
            <a class="uk-position-cover" href="<?php $app->route('/webhooks/index'); ?>"></a>
        </div>
    </div>
    <?php } ?>

    <?php if ($app['user']['group']=='admin') { ?>
    <div>
        <div class="uk-panel uk-panel-space uk-panel-box uk-panel-card">
            <img src="<?php echo $app->pathToUrl('assets:app/media/icons/misc/sysupdate.svg'); ?>" width="50" height="50" alt="<?php echo $app("i18n")->get('System Update'); ?>" />

            <div class="uk-text-truncate uk-margin">
                <?php echo $app("i18n")->get('Update System'); ?>
            </div>
            <a class="uk-position-cover" href="<?php $app->route('/settings/update'); ?>"></a>
        </div>
    </div>
    <?php } ?>

    <?php if ($app->module("cockpit")->hasaccess('cockpit', 'info')) { ?>
    <div>
        <div class="uk-panel uk-panel-space uk-panel-box uk-panel-card">

            <img src="<?php echo $app->pathToUrl('assets:app/media/icons/info.svg'); ?>" width="50" height="50" alt="<?php echo $app("i18n")->get('System'); ?>" />

            <div class="uk-text-truncate uk-margin">
                <?php echo $app("i18n")->get('System'); ?>
            </div>
            <a class="uk-position-cover" href="<?php $app->route('/settings/info'); ?>"></a>
        </div>
    </div>
    <?php } ?>

</div>

<?php $app->trigger('cockpit.view.settings'); ?>
