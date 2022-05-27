import "./styles/layout/header.scss";
import "./styles/components/NotificationDropdown.scss";
import "./styles/components/ProfileDropdown.scss";

import "tippy.js/dist/tippy.css";
import "./styles/vendor/_tippy.scss";
import "tippy.js/animations/shift-away.css";

import tippy from "tippy.js";

tippy(document.querySelector("#notification-icon"), {
    content: "<notification-dropdown></notification-dropdown>",
    allowHTML: true,
    trigger: "click",
    placement: "bottom",
    theme: "custom",
    arrow: false,
    animation: "shift-away",
    interactive: true,
    offset: [-100, 15],
    onShow() {
        const notificationIcon = document.querySelector("notification-icon");
        notificationIcon.enableNotificationCheck();
        notificationIcon.update();
    },
    onHide() {
        const notificationIcon = document.querySelector("notification-icon");
        notificationIcon.disableNotificationCheck();
        notificationIcon.update();
    },
});

tippy(document.querySelector("#profile-image-container"), {
    content: "<profile-dropdown></profile-dropdown>",
    allowHTML: true,
    trigger: "click",
    placement: "bottom",
    theme: "custom",
    arrow: false,
    animation: "shift-away",
    interactive: true,
    offset: [-55, 5],
});
