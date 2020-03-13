module.exports = {
    theme: {
        screens: {
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px"
        },
        borderWidth: {
            default: "1px",
            "0": "0",
            "2": "2px",
            "4": "4px"
        },
        extend: {
            colors: {
                davygrayn: "#B9BDBD",
                primary: "var(--bg-background-primary)",
                ivory: "#fffff0",
                lightyellow: "#FFFBDF",
                junglegreen: "var(--bg-background-junglegreen)",
                darkergreen: "var(--bg-background-darkergreen)"
            },
            spacing: {
                "96": "24rem",
                "128": "32rem"
            }
        }
    }
};
