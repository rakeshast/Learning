<?php


// ECD BLOG REDIRECTION 17/04/2023

function ecd_blog_redirection()
{

    if (
        isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
    ) {
        $protocol = 'https://';
    } else {
        $protocol = 'http://';
    }
    $currenturl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $currenturl_relative = wp_make_link_relative($currenturl);

    switch ($currenturl_relative) {

        case '/how-to-reach-professional-goals-with-career-vision-statement':
            $urlto = "https://www.erincondren.com/inspiration-center-how-to-achieve-career-goals-with-a-vision-statement";
            break;

        case '/working-from-home-during-coronavirus':
            $urlto = "https://www.erincondren.com/inspiration-center-how-to-organize-your-wfh-desk";
            break;

        case '/wedding-planning-101':
            $urlto = "https://www.erincondren.com/wedding-planners";
            break;

        case '/we-love-teachers-and-giving-back':
            $urlto = "https://www.erincondren.com/blog";
            break;

        case '/trend-alert-printed-socks':
            $urlto = "https://www.erincondren.com/blog";
            break;

        case '/tips-tricks-for-spring-break-travel':
            $urlto = "https://www.erincondren.com/inspiration-center-top-travel-packing-tips";
            break;
        case '/take-your-dog-to-work-day':
            $urlto = "https://www.erincondren.com/blog";
            break;
        case '/study-tips-for-highschool-and-college-students':
            $urlto = "https://www.erincondren.com/inspiration-center-academic-planner-101";
            break;
        case '/spring-cleaning-101':
            $urlto = "https://www.erincondren.com/inspiration-center-easy-ways-to-declutter-and-destress-every-day";
            break;
        case '/sk8-for-the-schools-a-fundraiser':
            $urlto = "https://www.erincondren.com/ec-gives-back";
            break;
        case '/self-care-sunday-unplug-reduce-your-screen-time':
            $urlto = "https://www.erincondren.com/inspiration-center-best-self-care-tips-and-tools";
            break;
        case '/self-care-health-and-wellness-tips-and-tools':
            $urlto = "https://www.erincondren.com/inspiration-center-best-self-care-tips-and-tools";
            break;
        case '/save-the-date-2016-17-lifeplanner-launch':
            $urlto = "https://www.erincondren.com/lifeplanner-collection";
            break;
        case '/lunch-tote-lovin-for-back-to-school':
            $urlto = "https://www.erincondren.com/back-to-school";
            break;
        case '/labor-day-with-vintage-stars-stripes':
            $urlto = "https://www.erincondren.com/blog";
            break;
        case '/how-to-plan-a-friendsgiving':
            $urlto = "https://www.erincondren.com/inspiration-center-meal-planning-tips-for-beginners";
            break;
        case '/how-to-destress-one-minute-or-less':
            $urlto = "https://www.erincondren.com/inspiration-center-how-to-journal-to-reduce-stress";
            break;
        case '/how-to-decorate-your-planner-with-just-washi-tape':
            $urlto = "https://www.erincondren.com/inspiration-center-how-to-make-your-planner-stick-out-with-washi";
            break;
        case '/how-a-work-journal-can-boost-productivity':
            $urlto = "https://www.erincondren.com/inspiration-center-how-to-stay-organized-at-work-with-the-lifeplanner";
            break;
        case '/gigis-playhouse-erin-condren-dream-collection':
            $urlto = "https://www.erincondren.com/ec-gives-back";
            break;
        case '/geaux-wild-planner-conference':
            $urlto = "https://www.erincondren.com/blog";
            break;
        case '/fridiy-little-tikes-car-for-my-niece':
            $urlto = "https://www.erincondren.com/blog";
            break;
        case '/erin-condren-irvine-store-contest':
            $urlto = "https://www.erincondren.com/blog";
            break;
        case '/best-remote-learning-homeschooling-tips-back-to-school-2020':
            $urlto = "https://www.erincondren.com/inspiration-center-academic-planner-101";
            break;
        case '/best-mothers-day-gifts':
            $urlto = "https://www.erincondren.com/inspiration-center-best-gifts-for-every-occasion";
            break;
        case '/at-home-learning-tips-from-our-team':
            $urlto = "https://www.erincondren.com/inspiration-center-academic-planner-101";
            break;
        case '/2018-resolutions-lifeplanner':
            $urlto = "https://www.erincondren.com/lifeplanner-collection";
            break;
        case '/meal-planning-101':
            $urlto = "https://www.erincondren.com/inspiration-center-meal-planning-tips-for-beginners";
            break;

        default:
            return;
    }

    if ($currenturl != $urlto)
        exit(wp_redirect($urlto));
}
add_action('template_redirect', 'ecd_blog_redirection');
