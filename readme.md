Radio Taxonomy
==============

Replace a taxonomy meta box with radio buttons, similar to post formats.

## Usage

Install and activate the plugin.

Then tell Radio Taxonomy that you want an alternate meta box while registering a
new taxonomy.

    register_taxonomy('some_tax', 'post', array(
        // other args ...
        // only works on non-hierarchical taxonomies.
        'hierarchical'          => false,
        'radio_taxonomy'        => true,
    ));
