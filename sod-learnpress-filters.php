<?php
/*
Plugin Name: School of Data LearnPress Filters
Plugin URI: https://schoolofdata.org/
Description: Tiny plugin created by Jer Clarke to filter default behavior of LearnPress courses and quizzes. Specifically: 1) Filter all courses to enable the PRICES > "There is no enrollment requirement" setting, so that courses can be taken without logging in. 2) Filter all quizzes to set "Retake" to "-1", so that users can re-take a quiz if they want to rather than being locked out. If this plugin is disabled, please review the settings on each Course and Quiz to ensure they are whatever is desired.
Version: 1.0
Requires at least: 5.8
Requires PHP: 7.2
Author: Jer Clarke for School of Data
Author URI: https://jerclarke.org/
License: GPLv2 or later
Text Domain: sod-learnpress-filters
*/

/**
 * Filter _lp_no_required_enroll postmeta to make all courses have "Pricing > There is no requirement to enroll"
 * 
 * TODO: Put this on Github and document the location in the header.
 * 
 * On the SoD site all courses are free and the intended workflow is for visitors to take the course without
 * signing in, avoiding the complications of creating WP user accounts, etc.
 * 
 * The setting to make a course free to take without signup is a checkbox in the "Course Settings" metabox in the 
 * "Pricing" tab: "There is no enrollment requirement". Otherwise all students are required to sign in.
 * 
 * This filter forces that checkbox to always be ticked, and thus forces every course to be open without enrollment. 
 * 
 * Note that this filter results in the setting being saved on every post, so if the filter is disabled, any
 * course that has been saved in the editor will have this value permanently saved, though courses that haven't
 * been edited will revert to the default (enrollment is required).
 *
 * @param mixed $value
 * @param int $object_id
 * @param string $meta_key
 * @param bool $single
 * @return mixed
 */
function sod_filter_lp_no_required_enroll_postmeta_to_always_return_true( $value, $object_id, $meta_key, $single ) {

	if ( '_lp_no_required_enroll' !== $meta_key ) {
		return $value;
	}

	// return $value;
	return 'yes';
}
add_filter( 'get_post_metadata', 'sod_filter_lp_no_required_enroll_postmeta_to_always_return_true', 10, 4 );

/**
 * Filter _lp_retake_count postmeta to make all quizzes allow unlimited "retakes"
 * 
 * On SoD, where all courses are open, there's no reason to block users from retaking a quiz, and it makes more sense 
 * if all quizzes can be retaken indefinitely.
 * 
 * The relevant setting is a checkbox in the "Quiz Settings" metabox of the quiz editor: "Retake". Setting this
 * value to -1 means "unlimited retakes"
 * 
 * This filter forces the setting to always return "-1" so all quizzes allow unlimited retakes.
 * 
 * Note that this filter results in the setting being saved on every post, so if the filter is disabled, any
 * quiz that has been saved in the editor will have this value permanently saved, though quizzes that haven't
 * been edited will revert to the default (only one take allowed).
 *
 * @param mixed $value
 * @param int $object_id
 * @param string $meta_key
 * @param bool $single
 * @return mixed
 */
function sod_filter_lp_retake_count_postmeta_to_always_return_unlimited( $value, $object_id, $meta_key, $single ) {

	if ( '_lp_retake_count' !== $meta_key ) {
		return $value;
	}

	// return $value;
	return '-1';
}
add_filter( 'get_post_metadata', 'sod_filter_lp_retake_count_postmeta_to_always_return_unlimited', 10, 4 );


