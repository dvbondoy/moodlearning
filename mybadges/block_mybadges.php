<?php
// defined('MOODLE_INTERNAL') || die();

class block_mybadges extends block_base {
    public function init() {
        $this->title = get_string('mybadges', 'block_mybadges');
    }

    public function get_content() {
        global $USER, $CFG, $DB;

        if ($this->content !== null) {
            return $this->content;
        }

        $badges = badge_get_user_badges($USER->id);
        //$badges = core_badges_get_user_badges($USER->id);
        

        if (empty($badges)) {
            $this->content = new stdClass;
            $this->content->text = get_string('nobadges', 'block_mybadges');
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = '<ul>';

        foreach ($badges as $badge) {
            $badgeurl = new moodle_url($CFG->wwwroot.'/badges/view.php?badgeid='.$badge->id);
            $this->content->text .= '<li><a href="'.$badgeurl.'">'.$badge->name.'</a></li>';
        }

        $this->content->text .= '</ul>';
        $this->content->footer = '';

        return $this->content;
    }
}
