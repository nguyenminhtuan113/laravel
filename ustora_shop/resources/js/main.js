

import '../assets/js/plugin/webfont/webfont.min.js';
WebFont.load({
    google: { families: ["Public Sans:300,400,500,600,700"] },
    custom: {
        families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
    },
    active: function () {
        sessionStorage.fonts = true;
    },
});
import '../assets/js/core/jquery-3.7.1.min.js';
import '../assets/js/core/popper.min.js';
import '../assets/js/core/bootstrap.min.js';
import '../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js';
import '../assets/js/plugin/chart.js/chart.min.js';
import '../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js';
import '../assets/js/plugin/chart-circle/circles.min.js';
import '../assets/js/plugin/datatables/datatables.min.js';
import '../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js';
import '../assets/js/plugin/jsvectormap/jsvectormap.min.js';
import '../assets/js/plugin/jsvectormap/world.js';
import '../assets/js/plugin/sweetalert/sweetalert.min.js';
import '../assets/js/kaiadmin.min.js';