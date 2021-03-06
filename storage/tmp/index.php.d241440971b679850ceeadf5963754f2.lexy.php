<div>
    <ul class="uk-breadcrumb">
        <li class="uk-active"><span><?php echo $app("i18n")->get('Collections'); ?></span></li>
    </ul>
</div>

<div riot-view>

    <div if="{ ready }">

        <div class="uk-margin uk-clearfix" if="{ App.Utils.count(collections) }">

            <div class="uk-form-icon uk-form uk-text-muted">

                <i class="uk-icon-filter"></i>
                <input class="uk-form-large uk-form-blank" type="text" ref="txtfilter" placeholder="<?php echo $app("i18n")->get('Filter collections...'); ?>" onkeyup="{ updatefilter }">

            </div>

            <?php if ($app->module("cockpit")->hasaccess('collections', 'create')) { ?>
            <div class="uk-float-right">
                <a class="uk-button uk-button-large uk-button-primary uk-width-1-1" href="<?php $app->route('/collections/collection'); ?>"><i class="uk-icon-plus-circle uk-icon-justify"></i>  <?php echo $app("i18n")->get('Collection'); ?></a>
            </div>
            <?php } ?>

        </div>

        <div class="uk-width-medium-1-1 uk-viewport-height-1-3 uk-container-center uk-text-center uk-flex uk-flex-middle uk-flex-center" if="{ !App.Utils.count(collections) }">

            <div class="uk-width-medium-1-3 uk-animation-scale">

                <p>
                    <img src="<?php echo $app->pathToUrl('collections:icon.svg'); ?>" width="80" height="80" alt="Collections" data-uk-svg />
                </p>
                <hr>
                <span class="uk-text-large uk-text-muted"><?php echo $app("i18n")->get('No Collections'); ?>.
                <?php if ($app->module("cockpit")->hasaccess('collections', 'create')) { ?>
                <a href="<?php $app->route('/collections/collection'); ?>"><?php echo $app("i18n")->get('Create a collection'); ?>.</a></span>
                <?php } ?>
            </div>

        </div>


        <div class="uk-grid uk-grid-match uk-grid-gutter uk-grid-width-1-1 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-margin-top">

            <div each="{ meta, collection in collections }" show="{ infilter(meta) }">

                <div class="uk-panel uk-panel-box uk-panel-card">

                    <div class="uk-panel-teaser uk-position-relative">
                        <canvas width="600" height="350"></canvas>
                        <a href="<?php $app->route('/collections/entries'); ?>/{collection}" class="uk-position-cover uk-flex uk-flex-middle uk-flex-center">
                            <div class="uk-width-1-4 uk-svg-adjust" style="color:{ (meta.color) }">
                                <img riot-src="{ meta.icon ? '<?php echo $app->pathToUrl('assets:app/media/icons/'); ?>'+meta.icon : '<?php echo $app->pathToUrl('collections:icon.svg'); ?>'}" alt="icon" data-uk-svg>
                            </div>
                        </a>
                    </div>

                    <div class="uk-grid uk-grid-small">

                        <div data-uk-dropdown="delay:300">

                            <a class="uk-icon-cog" style="color:{ (meta.color) }" href="<?php $app->route('/collections/collection'); ?>/{ collection }" if="{ meta.allowed.edit }"></a>
                            <a class="uk-icon-cog" style="color:{ (meta.color) }" if="{ !meta.allowed.edit }"></a>

                            <div class="uk-dropdown">
                                <ul class="uk-nav uk-nav-dropdown">
                                    <li class="uk-nav-header"><?php echo $app("i18n")->get('Actions'); ?></li>
                                    <li><a href="<?php $app->route('/collections/entries'); ?>/{collection}"><?php echo $app("i18n")->get('Entries'); ?></a></li>
                                    <li><a href="<?php $app->route('/collections/entry'); ?>/{collection}" if="{ meta.allowed.entries_create }"><?php echo $app("i18n")->get('Add entry'); ?></a></li>
                                    <li if="{ meta.allowed.edit || meta.allowed.delete }" class="uk-nav-divider"></li>
                                    <li if="{ meta.allowed.edit }"><a href="<?php $app->route('/collections/collection'); ?>/{ collection }"><?php echo $app("i18n")->get('Edit'); ?></a></li>
                                    <?php if ($app->module("cockpit")->hasaccess('collections', 'delete')) { ?>
                                    <li class="uk-nav-item-danger" if="{ meta.allowed.delete }"><a class="uk-dropdown-close" onclick="{ parent.remove }"><?php echo $app("i18n")->get('Delete'); ?></a></li>
                                    <?php } ?>
                                    <li class="uk-nav-divider" if="{ meta.allowed.edit }"></li>
                                    <li class="uk-text-truncate" if="{ meta.allowed.edit }"><a href="<?php $app->route('/collections/export'); ?>/{ meta.name }" download="{ meta.name }.collection.json"><?php echo $app("i18n")->get('Export entries'); ?></a></li>
                                    <li class="uk-text-truncate" if="{ meta.allowed.edit }"><a href="<?php $app->route('/collections/import/collection'); ?>/{ meta.name }"><?php echo $app("i18n")->get('Import entries'); ?></a></li>
                                </ul>
                            </div>
                        </div>

                        <a class="uk-text-bold uk-flex-item-1 uk-text-center uk-link-muted" href="<?php $app->route('/collections/entries'); ?>/{collection}">{ meta.label || collection }</a>
                        <div>
                            <span class="uk-badge" riot-style="background-color:{ (meta.color) }">{ meta.itemsCount }</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <script type="view/script">

        var $this = this;

        this.ready  = true;
        this.collections = <?php echo  json_encode($collections) ; ?>;

        remove(e, collection) {

            collection = e.item.collection;

            App.ui.confirm("Are you sure?", function() {

                App.callmodule('collections:removeCollection', collection).then(function(data) {

                    App.ui.notify("Collection removed", "success");

                    delete $this.collections[collection];

                    $this.update();
                });
            });
        }

        updatefilter(e) {

        }

        infilter(collection, value, name, label) {

            if (!this.refs.txtfilter.value) {
                return true;
            }

            value = this.refs.txtfilter.value.toLowerCase();
            name  = [collection.name.toLowerCase(), collection.label.toLowerCase()].join(' ');

            return name.indexOf(value) !== -1;
        }

    </script>

</div>
