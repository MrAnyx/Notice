import "@/styles/layout/header.scss";
import "@/styles/components/NotificationDropdown.scss";
import "@/styles/components/ProfileDropdown.scss";
import "@/styles/components/NotificationIcon.scss";

import "tippy.js/dist/tippy.css";
import "@/styles/vendor/_tippy.scss";
import "tippy.js/animations/shift-away.css";

import tippy from "tippy.js";
import NotificationIcon from "@/components/lit/NotificationIcon";

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
        const notificationIcon = document.querySelector<NotificationIcon>("notification-icon");
        notificationIcon.enableNotificationCheck();
    },
    onHide() {
        const notificationIcon = document.querySelector<NotificationIcon>("notification-icon");
        notificationIcon.disableNotificationCheck();
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
