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
                primary: "var(--bg-primary)",
                secondary: "var(--bg-secondary)",
                ivory: "#fffff0",
                lightyellow: "#FFFBDF",
                lightblue: "var(--bg-background-lightblue)",
                button: "var(--bg-background-button)",
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