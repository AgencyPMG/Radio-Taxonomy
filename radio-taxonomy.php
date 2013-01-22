<?php
/**
 * Plugin Name: Radio Taxonomy
 * Plugin URI: https://github.com/AgencyPMG/Radio-Taxonomy
 * Description: Replace non-hierachical taxonomies with radio buttons, ala Post Formats.
 * Version: 1.0
 * Text Domain: radio-taxonomy
 * Author: Christopher Davis
 * Author URI: http://pmg.co/people/chris
 * License: GPL-2.0+
 *
 * Copyright 2013 Performance Media Group <http://pmg.co>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category    WordPress
 * @package     RadioTaxonomy
 * @author      Christopher Davis <chris@pmg.co>
 * @copyright   2013 Performance Media Group
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

!defined('ABSPATH') && exit;

require_once plugin_dir_path(__FILE__) . 'inc/RadioTaxonomy.php';

RadioTaxonomy::init();
