import "./styles/layout/header.scss";

import "tippy.js/dist/tippy.css";
import "./styles/vendor/_tippy.scss";
import "tippy.js/animations/shift-away.css";

import tippy from "tippy.js";

tippy(document.querySelector("#notification-icon"), {
    content: "<notification-dropdown></notification-dropdown>",
    allowHTML: true,
    trigger: "click",
    placement: "bottom",
    theme: "notification",
    arrow: false,
    animation: "shift-away",
    showOnCreate: true,
    interactive: true,
    offset: [-100, 10],
});
