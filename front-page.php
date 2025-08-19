<?php
/**
 * front-page.php
 * Make the home page render the Projects archive UI.
 */
 
// Optionally set a flag if you want slightly different copy on home
set_query_var('is_funnel_front', true);

// If you already have archive-project.php with all the markup, just load it:
get_template_part('archive', 'funnel'); // looks for archive-project.php

// Or, if you want to be 100% certain it loads that file:
$tpl = locate_template('archive-funnel.php', true);