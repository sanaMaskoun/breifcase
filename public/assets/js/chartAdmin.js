document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("myChartAdmin").getContext("2d");
    const numClients = window.numClients;
    const numLawyers = window.numLawyers;
    const numCompanies = window.numCompanies;

    const myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            datasets: [
                {
                    label: "Clients",
                    data: numClients,
                    borderColor: "rgb(133, 73, 4)",
                    borderWidth: 3,
                    pointBackgroundColor: "rgb(133, 73, 4)",
                    pointBorderColor: "rgb(133, 73, 4)",
                    pointHoverBackgroundColor: "rgb(133, 73, 4)",
                    pointHoverBorderColor: "rgb(133, 73, 4)",
                },
                {
                    label: "Lawyers",
                    data: numLawyers,
                    borderColor: "rgba(240, 169, 15, 0.767)",
                    borderWidth: 3,
                    pointBackgroundColor: "rgba(240, 169, 15, 0.767)",
                    pointBorderColor: "rgba(240, 169, 15, 0.767)",
                    pointHoverBackgroundColor: "rgba(240, 169, 15, 0.767)",
                    pointHoverBorderColor: "rgba(240, 169, 15, 0.767)",
                },
                {
                    label: "Translation companies",
                    data: numCompanies,
                    borderColor: "white",
                    borderWidth: 3,
                    pointBackgroundColor: "white",
                    pointBorderColor: "white",
                    pointHoverBackgroundColor: "white",
                    pointHoverBorderColor: "white",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // لتحسين العرض على الشاشات الصغيرة
            scales: {
                x: {
                    ticks: {
                        color: "black",
                        font: {
                            weight: "800",
                            size: 10, // تعديل حجم الخط للشاشات الصغيرة
                        },
                        maxRotation: 45, // تدوير التسميات لتحسين العرض
                        minRotation: 45,
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: "black",
                        font: {
                            weight: "800",
                            size: 10, // تعديل حجم الخط للشاشات الصغيرة
                        },
                    },
                },
            },
            plugins: {
                legend: {
                    labels: {
                        color: "black",
                        font: {
                            size: 12, // تعديل حجم الخط في وسيلة الإيضاح
                        },
                    },
                },
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10,
                },
            },
        },
    });
});
