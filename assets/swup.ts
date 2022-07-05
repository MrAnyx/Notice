import Swup from "swup";
import * as feather from "feather-icons";

import "@/styles/vendor/_swup.scss";

const swup = new Swup({
    containers: ["#page-content", "#sidebar"],
});

feather.replace();

swup.on("contentReplaced", () => {
    feather.replace();
});
