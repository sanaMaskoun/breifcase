
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
            scales: {
                x: {
                    ticks: {
                        color: "black",
                        font: {
                            weight: "800",
                        },
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: "black",
                        font: {
                            weight: "800",
                        },
                    },
                },
            },
            plugins: {
                legend: {
                    labels: {
                        color: "black",
                    },
                },
            },
        },
    });
});
