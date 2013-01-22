<?php
/**
 * Radio Taxonomy
 *
 * @category    WordPress
 * @package     RadioTaxonomy
 * @author      Christopher Davis <chris@pmg.co>
 * @copyright   2013 Performance Media Group
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

!defined('ABSPATH') && exit;

class RadioTaxonomy
{
    private static $ins = null;

    public static function instance()
    {
        if (is_null(self::$ins)) {
            self::$ins = new self;
        }

        return self::$ins;
    }

    public function init()
    {
        add_action('add_meta_boxes', array(self::instance(), 'boxes'));
    }

    public function boxes($type)
    {
        // xxx assume we're only dealing with post types.
        // Taxonomies can be use with users, etc, but... this is easier.
        if (!post_type_exists($type)) {
            return;
        }

        $taxes = get_object_taxonomies($type, 'object');

        foreach ($taxes as $tax => $obj) {
            if (is_taxonomy_hierarchical($tax)) {
                continue;
            }

            if (!isset($obj->radio_taxonomy) || !$obj->radio_taxonomy) {
                continue;
            }

            remove_meta_box("tagsdiv-{$tax}", $type, 'side');

            add_meta_box(
                "tagsdiv-{$tax}-radio",
                $obj->labels->singular_name,
                array($this, 'box_cb'),
                $type,
                'side',
                'core',
                array('taxonomy' => $tax)
            );
        }
    }

    public function box_cb($post, $box)
    {
        $tax = isset($box['args']['taxonomy']) ? $box['args']['taxonomy'] : 'post_tag';

        $terms = get_terms($tax, array('hide_empty' => false));

        $has = $this->get_term($post->ID, $tax);

        if (!$terms) {
            $terms = array();
        }

        printf(
            '<p><label for="tax_input[%1$s][]">'
            . '<input type="radio" id="tax_input[%1$s][]" name="tax_input[%1$s]"'
            . ' value="" %2$s /> %3$s</label></p>',
            esc_attr($tax),
            !$has ? 'checked="checked"' : '',
            esc_html__('None', 'radio-taxonomy')
        );

        foreach ($terms as $t) {
            printf(
                '<p><label for="tax_input[%1$s][%2$s]">'
                . ' <input type="radio" id="tax_input[%1$s][%2$s]"'
                . ' name="tax_input[%1$s]" value="%2$s" %3$s /> %4$s</label></p>',
                esc_attr($tax),
                esc_attr($t->slug),
                $has == $t->term_id ? 'checked="checked"' : '',
                esc_html($t->name)
            );
        }
    }

    private function get_term($obj_id, $tax)
    {
        $terms = get_the_terms($obj_id, $tax);

        if (!$terms || is_wp_error($terms)) {
            return false;
        }

        return array_pop($terms)->term_id;
    }
}
