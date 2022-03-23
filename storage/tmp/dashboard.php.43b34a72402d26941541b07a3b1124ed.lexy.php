<div>
    <ul class="uk-breadcrumb">
        <li class="uk-active"><span><?php echo $app("i18n")->get('Dashboard'); ?></span></li>
    </ul>
</div>

<div id="dashboard">

    <div class="uk-margin">
        <?php $app->trigger('admin.dashboard.top'); ?>
    </div>

    <div class="uk-grid uk-margin" data-uk-grid-margin>
        <div class="uk-width-medium-1-2" data-area="main">
            <div class="uk-sortable uk-grid uk-grid-gutter uk-grid-width-1-1" data-uk-sortable="{group:'dashboard',animation:false}">
                <?php foreach ($areas['main'] as $widget) { ?>
                <div data-widget="<?php echo  $widget['name'] ; ?>">
                    <?php echo  $widget['content'] ; ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="uk-width-medium-1-4" data-area="aside-left">
            <div class="uk-sortable uk-grid uk-grid-gutter uk-grid-width-medium-1-1" data-uk-sortable="{group:'dashboard',animation:false}">
                <?php foreach ($areas['aside-left'] as $widget) { ?>
                <div data-widget="<?php echo  $widget['name'] ; ?>">
                    <?php echo  $widget['content'] ; ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="uk-width-medium-1-4" data-area="aside-right">
            <div class="uk-sortable uk-grid uk-grid-gutter uk-grid-width-medium-1-1" data-uk-sortable="{group:'dashboard',animation:false}">
                <?php foreach ($areas['aside-right'] as $widget) { ?>
                <div data-widget="<?php echo  $widget['name'] ; ?>">
                    <?php echo  $widget['content'] ; ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="uk-margin">
        <?php $app->trigger('admin.dashboard.bottom'); ?>
    </div>

</div>

<style>

    #dashboard .uk-grid.uk-sortable {
        min-height: 30vh;
    }

</style>

<script>

    App.$(function($){

        var data, dashboard = App.$('#dashboard').on('stop.uk.sortable', function(){

            data = {};

            dashboard.find('[data-area]').each(function(){
                var $a      = $(this),
                    area    = $a.data('area'),
                    widgets = $a.find('[data-widget]');

                widgets.each(function(prio){
                    data[this.getAttribute('data-widget')] = {
                        area: area,
                        prio: prio + 1
                    };
                });
            });

            App.request('/cockpit/savedashboard',{widgets:data}).then(function(){

            });
        });
    });

</script>
