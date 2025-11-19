<style>
    [data-theme="light"] body {
        background: white;
        color: black;
    }

    [data-theme="dark"] body {
        background: #111827;
        color: white;
    }

    [data-theme="light"] .card {
        background: #ffffff;
        color: #111827;
    }

    [data-theme="dark"] .card {
        background: #1f2937;
        /* abu gelap */
        color: #f9fafb;
    }

    [data-theme="light"] .list-group-item {
        background: #ffffff;
        color: #111827;
    }

    [data-theme="dark"] .list-group-item {
        background: #374151;
        color: #f9fafb;
    }

    [data-theme="light"] .badge {
        background-color: #2563eb;
        color: #ffffff;
    }

    [data-theme="dark"] .badge {
        background-color: #3b82f6;
        color: #ffffff;
    }

    [data-theme="light"] select option,
    [data-theme="light"] select optgroup {
        background-color: #ffffff;
        color: #111827;
    }

    [data-theme="dark"] select option,
    [data-theme="dark"] select optgroup {
        background-color: #1e293b;
        color: #f1f5f9;
    }

    @stack('style')
</style>