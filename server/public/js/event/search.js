let timeout = null;
document.getElementById("search").addEventListener("keyup", (e) => {
    clearTimeout(timeout);
    const search = e.target.value;
    timeout = setTimeout(() => {
        const url = new URL(window.location.href);
        url.searchParams.set("search", search);
        window.location.href = url.toString();
    }, 750);
});

document.getElementById("mulai").addEventListener("change", (e) => {
    clearTimeout(timeout);
    const search = e.target.value;
    timeout = setTimeout(() => {
        const url = new URL(window.location.href);
        url.searchParams.set("mulai", search);
        window.location.href = url.toString();
    }, 750);
});

document.getElementById("sampai").addEventListener("change", (e) => {
    clearTimeout(timeout);
    const search = e.target.value;
    timeout = setTimeout(() => {
        const url = new URL(window.location.href);
        url.searchParams.set("sampai", search);
        window.location.href = url.toString();
    }, 750);
});