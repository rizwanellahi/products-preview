<?php function my_acf_admin_head()
{ ?>
    <style type="text/css">
        #item-availability .acf-true-false .acf-switch.-on {
            background-color: red;
        }
    </style>

<?php }

add_action('acf/input/admin_head', 'my_acf_admin_head');