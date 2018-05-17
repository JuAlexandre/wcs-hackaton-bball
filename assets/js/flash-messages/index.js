export function displayFlashMessages() {
    const alertsData = document.querySelector('[data-alerts]');
    if (alertsData === null) return false;
    const alerts = JSON.parse(alertsData.getAttribute('data-alerts'));
    for (const type in alerts)
        for (const alert of alerts[type])
            toastr[type](alert);
}