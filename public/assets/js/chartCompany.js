document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("myChartCompany").getContext("2d");
    const clientsData = window.clientsData;

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
                    label: "clients",
                    data: clientsData,
                    borderColor: "rgba(240, 169, 15, 0.767)",
                    borderWidth: 3,
                    pointBackgroundColor: "rgba(240, 169, 15, 0.767)",
                    pointBorderColor: "rgba(240, 169, 15, 0.767)",
                    pointHoverBackgroundColor: "rgba(240, 169, 15, 0.767)",
                    pointHoverBorderColor: "rgba(240, 169, 15, 0.767)",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Adjust this for better mobile viewing
            scales: {
                x: {
                    ticks: {
                        color: "black",
                        font: {
                            weight: "800",
                            size: 10, // Adjust font size for mobile
                        },
                        maxRotation: 45, // Rotate labels for better spacing
                        minRotation: 45,
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: "black",
                        font: {
                            weight: "800",
                            size: 10, // Adjust font size for mobile
                        },
                    },
                },
            },
            plugins: {
                legend: {
                    labels: {
                        color: "black",
                        font: {
                            size: 12, // Adjust legend font size for better readability
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
