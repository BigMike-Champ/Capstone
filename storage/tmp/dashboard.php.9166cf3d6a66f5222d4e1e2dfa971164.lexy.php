<div>

    <div class="uk-panel-box uk-panel-card">

        <div class="uk-panel-box-header uk-flex">
            <strong class="uk-panel-box-header-title uk-flex-item-1">
                <?php echo $app("i18n")->get('Collections'); ?>

                <?php if ($app->module("cockpit")->hasaccess('collections', 'create')) { ?>
                <a href="<?php $app->route('/collections/collection'); ?>" class="uk-icon-plus uk-margin-small-left" title="<?php echo $app("i18n")->get('Create Collection'); ?>" data-uk-tooltip></a>
                <?php } ?>
            </strong>
            <?php if (count($collections)) { ?>
            <span class="uk-badge uk-flex uk-flex-middle"><span><?php echo  count($collections) ; ?></span></span>
            <?php } ?>
        </div>

        <?php if (count($collections)) { ?>

            <div class="uk-margin">

                <ul class="uk-list uk-list-space uk-margin-top">
                    <?php foreach (array_slice($collections, 0, count($collections) > 5 ? 5: count($collections)) as $col) { ?>
                    <li>
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-flex-item-1">
                                <a href="<?php $app->route('/collections/entries/'.$col['name']); ?>">

                                    <img class="uk-margin-small-right uk-svg-adjust" src="<?php echo $app->pathToUrl(isset($col['icon']) && $col['icon'] ? 'assets:app/media/icons/'.$col['icon']:'collections:icon.svg'); ?>" width="18px" alt="icon" data-uk-svg>

                                    <?php echo  @$col['label'] ? $col['label'] : $col['name'] ; ?>
                                </a>
                            </div>
                            <div>
                                <?php if ($app->module('collections')->hasaccess($col['name'], 'entries_create')) { ?>
                                <a class="uk-text-muted" href="<?php $app->route('/collections/entry'); ?>/<?php echo  $col['name'] ; ?>" title="<?php echo $app("i18n")->get('Add entry'); ?>" data-uk-tooltip="pos:'right'">
                                    <img src="<?php echo $app->pathToUrl('assets:app/media/icons/plus-circle.svg'); ?>" width="1.2em" data-uk-svg />
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>

            </div>

            <div class="uk-panel-box-footer">
                <a href="<?php $app->route('/collections'); ?>"><?php echo $app("i18n")->get('See all'); ?></a>
            </div>

        <?php } else { ?>

            <div class="uk-margin uk-text-center uk-text-muted">

                <p>
                    <img src="<?php echo $app->pathToUrl('collections:icon.svg'); ?>" width="30" height="30" alt="Collections" data-uk-svg />
                </p>

                <?php echo $app("i18n")->get('No collections'); ?>.

                <?php if ($app->module("cockpit")->hasaccess('collections', 'create')) { ?>
                <a href="<?php $app->route('/collections/collection'); ?>"><?php echo $app("i18n")->get('Create a collection'); ?></a>.
                <?php } ?>
            </div>

        <?php } ?>

    </div>

</div>
