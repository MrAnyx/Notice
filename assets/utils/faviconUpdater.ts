const addNotificationFavicon = () => {
    document.querySelector<HTMLLinkElement>("link[rel='icon']").href = "/images/Notice-favicon-notification.svg";
};

const removeNotificationFavicon = () => {
    document.querySelector<HTMLLinkElement>("link[rel='icon']").href = "/images/Notice-favicon.svg";
};

export { addNotificationFavicon, removeNotificationFavicon };
