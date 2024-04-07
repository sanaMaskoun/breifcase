'use strict';

$(document).ready(function () {
    if ($('#apexcharts-area').length > 0) {
        $.ajax({
            url: '/admin/profits',
            method: 'GET',
            success: function (data) {
                var options = {
                    chart: {
                        height: 350,
                        type: "line",
                        toolbar: { show: false },
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: "smooth" },
                    series: [
                        { name: "Profits", color: '#9b3d00', data: data },
                    ],
                    xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], }
                };
                var chart = new ApexCharts(document.querySelector("#apexcharts-area"), options);
                chart.render();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});

$(document).ready(function () {
    if ($('#apexcharts-area-lawyer').length > 0) {
        $.ajax({
            url: '/lawyer/profits',
            method: 'GET',
            success: function (data) {
                var options = {
                    chart: {
                        height: 350,
                        type: "line",
                        toolbar: { show: false },
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: "smooth" },
                    series: [
                        { name: "Profits", color: '#9b3d00', data: data },
                    ],
                    xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], }
                };
                var chart = new ApexCharts(document.querySelector("#apexcharts-area-lawyer"), options);
                chart.render();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});




$(document).ready(function () {
    if ($('#bar').length > 0) {
        $.ajax({
            url: '/admin/numberOfSubscribers',
            method: 'GET',
            success: function (data) {
                var monthlyLawyers = data[0];
                var monthlyClients = data[1];

                var optionsBar = {
                    chart: { type: 'bar', height: 350, width: '100%', stacked: false, toolbar: { show: false } },
                    dataLabels: { enabled: false },
                    plotOptions: { bar: { columnWidth: '55%', endingShape: 'rounded' } },
                    stroke: { show: true, width: 2, colors: ['transparent'] },
                    series: [
                        { name: "Clients", color: '#d8801e', data: monthlyClients },
                        { name: "Lawyers", color: '#9b3d00', data: monthlyLawyers }
                    ],
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    xaxis: {
                        labels: { show: true },
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                    },
                    yaxis: {
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: { style: { colors: '#777' } }
                    },
                    title: { text: '', align: 'left', style: { fontSize: '18px' } }
                };

                var chartBar = new ApexCharts(document.querySelector('#bar'), optionsBar);
                chartBar.render();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});

$(document).ready(function () {
    if ($('#bar-lawyer').length > 0) {
        $.ajax({
            url: '/lawyer/numberOfClients',
            method: 'GET',
            success: function (data) {
                var monthlyClients = data;

                var optionsBar = {
                    chart: {
                        type: 'bar',
                        height: 350,
                        width: '100%',
                        stacked: false,
                        toolbar: { show: false }
                    },
                    dataLabels: { enabled: false },
                    plotOptions: { bar: { columnWidth: '55%', endingShape: 'rounded' } },
                    stroke: { show: true, width: 2, colors: ['transparent'] },
                    series: [{ name: "Clients", color: '#d8801e', data: monthlyClients }],
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    xaxis: {
                        labels: { show: true },
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                    },
                    yaxis: {
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: { style: { colors: '#777' } }
                    },
                    title: { text: '', align: 'left', style: { fontSize: '18px' } }
                };

                var chartBar = new ApexCharts(document.querySelector('#bar-lawyer'), optionsBar);
                chartBar.render();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});

