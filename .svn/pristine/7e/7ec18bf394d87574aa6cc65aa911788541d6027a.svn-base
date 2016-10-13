<html lang="en" ng-app="rough">
    <?php $this->load->view('user/layout/head'); ?>
    <body>
        <span ng-init="loading = 0"></span>
        <div class="ajax_loding" ng-if="loading">
            <img src="<?= ASSETSURL ?>images/Preloader_4.gif" class="ajax-loader">
        </div>
        <?php $this->load->view('user/layout/header'); ?>
        <?php $this->load->view('user/layout/navbar'); ?>
        <?php $this->load->view('user/layout/content', $data); ?>
        <?php $this->load->view('user/layout/footer'); ?>
    </body>
</html>