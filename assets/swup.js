import Swup from "swup";
import * as feather from "feather-icons";

import "./styles/vendor/_swup.scss";

const swup = new Swup(); // only this line when included with script tag

feather.replace();

swup.on("contentReplaced", () => {
    feather.replace();
});
