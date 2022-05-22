const addNotificationFavicon = () => {
    document.querySelector("link[rel='icon']").href = "/images/Notice-favicon-notification.svg";
};

const removeNotificationFavicon = () => {
    document.querySelector("link[rel='icon']").href = "/images/Notice-favicon.svg";
};

export { addNotificationFavicon, removeNotificationFavicon };
