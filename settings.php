<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Settings for assignfeedback PDF plugin
 *
 * @package   assignfeedback_editpdf
 * @copyright 2013 Davo Smith
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Enabled by default.
$settings->add(new admin_setting_configcheckbox('assignfeedback_editpdf/default',
                   new lang_string('default', 'assignfeedback_editpdf'),
                   new lang_string('default_help', 'assignfeedback_editpdf'), 1));

// Stamp files setting.
$name = 'assignfeedback_editpdf/stamps';
$title = get_string('stamps', 'assignfeedback_editpdf');
$description = get_string('stampsdesc', 'assignfeedback_editpdf');

$setting = new admin_setting_configstoredfile($name, $title, $description, 'stamps', 0,
    array('maxfiles' => 8, 'accepted_types' => array('image')));
$settings->add($setting);

// Note that large pdfs are very slow and annotations go missing in big files.
$settings->add(new admin_setting_heading('limitations', get_string('limitations', 'assignfeedback_editpdf'), get_string('largedocs', 'assignfeedback_editpdf')));

// Allow admin to determine up to which pagesize we want to flatten all files.
$settings->add(new admin_setting_configtext('assignfeedback_editpdf/flatten',
                   new lang_string('flatten', 'assignfeedback_editpdf'),
                   new lang_string('flatten_help', 'assignfeedback_editpdf'), 10, PARAM_INT));

$options = array(50 => '50', 60 => '60', 70 => '70', 80 => '80', 90 => '90', 100 => '100');
$settings->add(new admin_setting_configselect(
    'assignfeedback_editpdf_jpegq',
    get_string('jpegq', 'assignfeedback_editpdf'),
    get_string('configjpegq', 'assignfeedback_editpdf'),
    '60',
    $options
));

$options = array(100 => '100', 150 => '150', 200 => '200', 300 => '300');
$settings->add(new admin_setting_configselect(
    'assignfeedback_editpdf_resolution',
    get_string('resolution', 'assignfeedback_editpdf'),
    get_string('configresolution', 'assignfeedback_editpdf'),
    '150',
    $options
));

// Ghostscript setting.
$systempathslink = new moodle_url('/admin/settings.php', array('section' => 'systempaths'));
$systempathlink = html_writer::link($systempathslink, get_string('systempaths', 'admin'));
$settings->add(new admin_setting_heading('pathtogs', get_string('pathtogs', 'admin'),
        get_string('pathtogspathdesc', 'assignfeedback_editpdf', $systempathlink)));

$url = new moodle_url('/mod/assign/feedback/editpdf/testgs.php');
$link = html_writer::link($url, get_string('testgs', 'assignfeedback_editpdf'));
$settings->add(new admin_setting_heading('testgs', '', $link));
