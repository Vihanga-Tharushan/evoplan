(function(){
    'use strict';
    
    // Color palette matching design
    const COLORS = {
        blue: '#3147ab',
        green: '#119f3e',
        purple: '#4B006E',
        coral: '#20ae8a',
        amber: '#ea8807',
        red: '#ed1d1d',
        gray: '#e7e250',
        darkBlue: '#1a3a7a',
        teal: '#0891b2',
        pink: '#ec4899',
        orange: '#f97316',
        lime: '#84cc16',
        indigo: '#6366f1',
        rose: '#f43f5e',
        cyan: '#06b6d4'
    };

    let charts = {
        issuesTrend: null,
        category: null,
        status: null,
        trend: null,
        replacement: null,
        eventsTrend: null
    };

    function qs(id){ return document.getElementById(id); }

    // Fetch data from API endpoints using existing IssueC controller methods
    async function fetchDashboardData(){
        const today = new Date();
        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
        const endOfToday = today.toISOString().split('T')[0];

        try {
            console.log('Fetching dashboard data...');
            // Using the endpoints already defined in IssueC.php
            const [metricsRes, trendRes, categoryRes, statusRes, topProvidersRes] = await Promise.all([
                fetch(URLROOT_PATH + `/IssueC/apiDashboardMetrics?start=${startOfMonth}&end=${endOfToday}`).then(r => r.json()),
                fetch(URLROOT_PATH + '/IssueC/apiIssuesTrend?months=6').then(r => r.json()),
                fetch(URLROOT_PATH + '/IssueC/apiIssuesByCategory').then(r => r.json()),
                fetch(URLROOT_PATH + `/IssueC/apiComplaintStatus?start=${startOfMonth}&end=${endOfToday}`).then(r => r.json()),
                fetch(URLROOT_PATH + '/IssueC/apiTopProviders?limit=5').then(r => r.json())
            ]);
            console.log('Data fetched successfully:', {metricsRes, trendRes, categoryRes, statusRes, topProvidersRes});


            const metrics = metricsRes.success ? metricsRes.data : {};
            const issuesTrendRaw = trendRes.success ? trendRes.data : [];
            const categoryRaw = categoryRes.success ? categoryRes.data : [];
            const statusRaw = statusRes.success ? statusRes.data : [];
            const topProvidersRaw = topProvidersRes.success ? topProvidersRes.data : [];

            return {
                metrics: {
                    open_issues: metrics.open_issues || 0,
                    resolved_count: metrics.resolved_count || 0,
                    pending_replacements: metrics.pending_replacements || 0,
                    events_count: metrics.events_count || metrics.avg_resolution_days || 0
                },
                prevMetrics: metrics.previous || null,
                issuesTrend: {
                    labels: issuesTrendRaw.map(item => item.label),
                    raised: issuesTrendRaw.map(item => item.raised),
                    resolved: issuesTrendRaw.map(item => item.resolved)
                },
                category: {
                    labels: categoryRaw.map(item => item.category || 'Other'),
                    values: categoryRaw.map(item => parseInt(item.cnt)),
                    colors: categoryRaw.map((_, i) => {
                        const pal = [COLORS.purple, COLORS.amber, COLORS.red, COLORS.coral, COLORS.teal, COLORS.pink, COLORS.orange, COLORS.lime, COLORS.indigo, COLORS.rose, COLORS.cyan, COLORS.green];
                        return pal[i % pal.length];
                    })
                },
                status: {
                    labels: statusRaw.map(item => item.status),
                    values: statusRaw.map(item => parseInt(item.cnt))
                },
                eventsTrend: {
                    labels: issuesTrendRaw.map(item => item.label),
                    values: issuesTrendRaw.map(item => item.events || 0)
                },
                topProviders: topProvidersRaw.map(p => ({
                    provider_name: p.provider_name || 'Unknown',
                    cnt: p.cnt || 0
                }))
            };
        } catch(err) {
            console.error('Dashboard data fetch error:', err);
            return null;
        }
    }

    function updateTimestamp(){
        const now = new Date();
        const timeString = now.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
        const el = qs('lastUpdate');
        if(el) el.textContent = timeString;
    }

    function renderLegend(container, items){
        if(!container) return;
        container.innerHTML = items.map(i => 
            `<div class="legend-item"><span class="legend-color" style="background:${i.color}"></span><span>${i.label}</span>${i.value ? `<span class="legend-value" style="margin-left:auto;font-weight:600;">${i.value}</span>` : ''}</div>`
        ).join('');
    }

    function createBarChart(ctx, labels, dataset1, dataset2, label1, label2){
        const datasets = [{ label: label1, data: dataset1, backgroundColor: COLORS.blue }];
        if(dataset2 && label2) datasets.push({ label: label2, data: dataset2, backgroundColor: COLORS.green });
        
        return new Chart(ctx, {
            type: 'bar',
            data: { labels, datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { 
                    y: { 
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        },
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    }

    function createDonutChart(ctx, labels, data, colors){
        return new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{ data: data, backgroundColor: colors }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });
    }

    async function refresh(){
        updateTimestamp();
        const data = await fetchDashboardData();
        if(!data) return;

        // Issues Trend
        if(charts.issuesTrend) charts.issuesTrend.destroy();
        charts.issuesTrend = createBarChart(
            qs('issuesTrendChart').getContext('2d'),
            data.issuesTrend.labels,
            data.issuesTrend.raised,
            data.issuesTrend.resolved,
            'Raised', 'Resolved'
        );
        renderLegend(qs('issuesTrendLegend'), [
            {label: 'Raised', color: COLORS.blue},
            {label: 'Resolved', color: COLORS.green}
        ]);

        // Category
        if(charts.category) charts.category.destroy();
        charts.category = createDonutChart(
            qs('categoryChart').getContext('2d'),
            data.category.labels,
            data.category.values,
            data.category.colors
        );
        renderLegend(qs('categoryLegend'), data.category.labels.map((l,i)=>({label:l, color:data.category.colors[i], value:data.category.values[i]})));

        // Status
        const statusColors = data.status.labels.map(s =>
            s === 'RESOLVED' ? COLORS.green :
            s === 'SEND' ? COLORS.gray :
            s === 'PENDING' ? COLORS.amber :
            s === 'ESCALATED' ? COLORS.red :
            s === 'IN_PROGRESS' ? COLORS.blue :
            COLORS.purple
        );
        if(charts.status) charts.status.destroy();
        charts.status = createDonutChart(
            qs('statusChart').getContext('2d'),
            data.status.labels,
            data.status.values,
            statusColors
        );
        renderLegend(qs('statusLegend'), data.status.labels.map((l,i)=>({label:l, color:statusColors[i], value:data.status.values[i]})));

        // Events
        if(charts.eventsTrend) charts.eventsTrend.destroy();
        charts.eventsTrend = createBarChart(
            qs('eventsTrendChart').getContext('2d'),
            data.eventsTrend.labels,
            data.eventsTrend.values,
            null,
            'Events Supervised',
            null
        );
    }

    function loadCoordinatorName(){
        fetch(URLROOT_PATH + '/IssueC/getCoordinatorData')
            .then(r => r.json())
            .then(res => {
                if(res.success && res.data) {
                    const el = document.querySelector('.header-content h1');
                    if(el) el.textContent = `Hello, ${res.data.ic_name}!`;
                }
            });
    }

    function initialize(){
        loadCoordinatorName();
        refresh();
    }

    document.addEventListener('DOMContentLoaded', initialize);
})();