document.addEventListener('DOMContentLoaded', function () {
    const bodyClass = document.body.className;

    if (bodyClass.includes('medicos-create') || bodyClass.includes('medicos-edit')) {
        const crmField = document.getElementById('crm');
        const form = document.querySelector('form');
        if (crmField && form) {
            crmField.addEventListener('blur', function () {
                const crmValue = crmField.value.trim();
                const crmPattern = /^CRM-[A-Z]{2} \d{1,6}$/;

                if (!crmPattern.test(crmValue)) {
                    alert('O CRM deve estar no formato CRM-XX NNNNN.');
                    crmField.focus();
                }
            });

            form.addEventListener('submit', function (event) {
                const crmValue = crmField.value.trim();
                const crmPattern = /^CRM-[A-Z]{2} \d{1,6}$/;

                if (!crmPattern.test(crmValue)) {
                    event.preventDefault();
                    alert('O CRM deve estar no formato CRM-XX NNNNN.');
                }
            });
        } else {
            console.error('Os elementos "crm" ou "form" não foram encontrados no DOM.');
        }
    }
});
