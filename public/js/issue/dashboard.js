(function(){
    'use strict';
    
    // Color palette matching design
    const COLORS = {
        blue: '#1832a5',
        green: '#14d050',
        purple: '#4B006E',
        coral: '#30d8ae',
        amber: '#ea8807',
        red: '#ed1d1d',
        gray: '#efe825'
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
    function isoDate(d){ return d.toISOString().slice(0,10); }

    // Dummy data loader to keep UI visible without backend
    function getDummyData(){
        const today = new Date();
        const labels6 = Array.from({length: 6}).map((_,i) => {
            const d = new Date(today.getFullYear(), today.getMonth() - (5 - i), 1);
            return d.toLocaleString('default', { month:'short' });
        });

        const metrics = {
            open_issues: 8,
            resolved_count: 12,
            pending_replacements: 3,
            events_count: 9,
            avg_resolution_days: 3.4
        };

        const prevMetrics = {
            open_issues: 10,
            resolved_count: 9,
            pending_replacements: 4,
            events_count: 7,
            avg_resolution_days: 4.1
        };

        return {
            metrics,
            prevMetrics,
            issuesTrend: {
                labels: labels6,
                raised: [14, 11, 16, 10, 13, 15],
                resolved: [12, 9, 14, 12, 11, 14]
            },
            category: {
                labels: ['Late Cancellation', 'Quality Issue', 'Payment Dispute', 'No Show', 'Other'],
                values: [6, 5, 3, 2, 4],
                colors: [COLORS.gray, COLORS.amber, COLORS.red, COLORS.coral, COLORS.purple]
            },
            status: {
                labels: ['Resolved', 'In Progress', 'Escalated', 'Pending'],
                values: [12, 6, 3, 5]
            },
            resolutionTrend: {
                labels: labels6,
                values: [4.2, 3.8, 3.5, 3.2, 3.1, 3.4]
            },
            replacementTrend: {
                labels: labels6,
                values: [2, 3, 1, 2, 4, 3]
            },
            eventsTrend: {
                labels: labels6,
                values: [8, 12, 10, 14, 11, 9]
            },
            topProviders: [
                { provider_name: 'Alpha Events', cnt: 12 },
                { provider_name: 'Bright Lights', cnt: 9 },
                { provider_name: 'City Catering', cnt: 7 },
                { provider_name: 'Dream Decor', cnt: 6 },
                { provider_name: 'Elite Music', cnt: 5 }
            ]
        };
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
            `<div class="legend-item"><span class="legend-color" style="background:${i.color}"></span><span>${i.label}</span></div>`
        ).join('');
    }

    function createBarChart(ctx, labels, dataset1, dataset2, label1, label2){
        const datasets = [
            { label: label1, data: dataset1, backgroundColor: COLORS.blue }
        ];
        
        // Add second dataset only if provided
        if(dataset2 && label2) {
            datasets.push({ label: label2, data: dataset2, backgroundColor: COLORS.green });
        }
        
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                scales: { 
                    x: { 
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Months',
                            font: { size: 14, weight: 'bold' }
                        }
                    }, 
                    y: { 
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Issues',
                            font: { size: 14, weight: 'bold' }
                        }
                    } 
                },
                plugins: { 
                    legend: { 
                        display: false
                    } 
                }
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
                plugins: { 
                    legend: { 
                        display: false
                    } 
                }
            }
        });
    }

    function createLineChart(ctx, labels, data, color, title){
        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: data,
                    borderColor: color,
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    tension: 0.25,
                    fill: false,
                    pointBackgroundColor: color,
                    pointBorderColor: color,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { 
                        display: false
                    } 
                },
                scales: { 
                    x: {
                        title: {
                            display: true,
                            text: 'Months',
                            font: { size: 14, weight: 'bold' }
                        }
                    },
                    y: { 
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count',
                            font: { size: 14, weight: 'bold' }
                        }
                    } 
                }
            }
        });
    }

    function updateKPIs(metrics, prevMetrics){
        if(!metrics) return;
        
        qs('kpiOpen').textContent = metrics.open_issues ?? '—';
        qs('kpiResolved').textContent = metrics.resolved_count ?? '—';
        qs('kpiPending').textContent = metrics.pending_replacements ?? '—';
        const eventsVal = metrics.events_count ?? metrics.avg_resolution_days;
        if(eventsVal !== undefined && eventsVal !== null){
            qs('kpiAvgRes').textContent = eventsVal;
        }

        function setDelta(elId, curr, prev){
            const el = qs(elId);
            if(!el || prev === undefined || prev === null){ if(el) el.textContent = ''; return; }
            const diff = curr - prev;
            const sign = diff > 0 ? '+' : '';
            el.textContent = `${sign}${diff}`;
            el.style.color = diff > 0 ? COLORS.red : COLORS.green;
        }

        if(prevMetrics){
            setDelta('kpiOpenDelta', metrics.open_issues, prevMetrics.open_issues);
            setDelta('kpiResolvedDelta', metrics.resolved_count, prevMetrics.resolved_count);
            setDelta('kpiAvgResDelta', metrics.avg_resolution_days ?? 0, prevMetrics.avg_resolution_days ?? 0);
        }
    }

    function refresh(){
        try{
            updateTimestamp();
            const data = getDummyData();

            updateKPIs(data.metrics, data.prevMetrics);

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

            if(charts.category) charts.category.destroy();
            charts.category = createDonutChart(
                qs('categoryChart').getContext('2d'),
                data.category.labels,
                data.category.values,
                data.category.colors
            );
            renderLegend(qs('categoryLegend'), data.category.labels.map((l,i)=>({label:l, color:data.category.colors[i]})));

            const statusColors = data.status.labels.map(s =>
                s === 'Resolved' ? COLORS.green :
                s === 'Escalated' ? COLORS.red :
                s === 'In Progress' ? COLORS.amber :
                COLORS.gray
            );
            if(charts.status) charts.status.destroy();
            charts.status = createDonutChart(
                qs('statusChart').getContext('2d'),
                data.status.labels,
                data.status.values,
                statusColors
            );
            renderLegend(qs('statusLegend'), data.status.labels.map((l,i)=>({label:l, color:statusColors[i]})));

            if(charts.eventsTrend) charts.eventsTrend.destroy();
            charts.eventsTrend = createBarChart(
                qs('eventsTrendChart').getContext('2d'),
                data.eventsTrend.labels,
                data.eventsTrend.values,
                null,
                'Events Supervised',
                null
            );
            renderLegend(qs('eventsLegend'), [{label: 'Events Supervised', color: COLORS.blue}]);

            const list = qs('topProvidersList');
            if(list){
                list.innerHTML = data.topProviders.map(p => 
                    `<li>${p.provider_name} <span class="badge">${p.cnt}</span></li>`
                ).join('');
            }

        } catch(err){
            console.error('Dashboard error:', err);
        }
    }

    function initialize(){
        updateTimestamp();
        refresh();
    }

    document.addEventListener('DOMContentLoaded', initialize);
})();
