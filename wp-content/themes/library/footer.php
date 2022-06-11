<?php wp_footer(); ?>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> <?php global $version;
        echo $version; ?>
    </div>
    <strong>Copyright © 2017-<?php echo date("Y"); ?> <a
                href="https://alfoundation.my/thebrary">theBrary</a>.</strong><?php _e('All
  rights reserved.', 'library-management-system'); ?>
</footer>
</div>
</body>
</html>

<?php if (!check_if_running_local() && strpos(get_home_url(), "www.library-management.com") !== false) {
    if (function_exists('show_floating_popup')) {
        show_floating_popup();
    }
} ?>

