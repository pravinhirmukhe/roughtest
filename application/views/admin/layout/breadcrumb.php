<div class="banner">
    <h2>
        <?php
        foreach ($bc as $b) {
            if ($b['link'] != '#') {
                echo '<a href="' . $b['link'] . '">' . $b['page'] . '</a><i class="fa fa-angle-right"></i>';
            } else {
                echo '<span>' . $b['page'] . '</span>';
            }
        }
        ?>
    </h2>
</div>
<div style="padding:5px 16px;">
    <?= flash_message(); ?>
</div>

