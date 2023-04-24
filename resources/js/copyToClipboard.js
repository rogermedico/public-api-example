document.getElementById('copy-clipboard').addEventListener('click', function () {
    const token = document.getElementById('token').innerText;

    if (!navigator.clipboard) {
        return;
    }

    navigator.clipboard.writeText(token)
});
